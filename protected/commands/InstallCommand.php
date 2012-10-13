<?php
Yii::import('application.commands.AbstractCommand');

/**
 * Yiic command to delete assets and cache
 */
class InstallCommand extends AbstractCommand
{

	/**
	 * if confirmation prompt is displayed or not
	 *
	 * @var boolean
	 */
	public $interactive = 1;

	/**
	 * @see CConsoleCommand::init()
	 * @return void
	 */
	public function init()
	{
		parent::init();
		$this->defaultAction = 'help';
	}

	/**
	 * create path in file system
	 *
	 * @param string $path
	 * @param string $path_description
	 * @return void
	 */
	protected function createPath($path, $path_description)
	{
		if (!file_exists($path))
		{
			if (!mkdir($path, 0777)) // suppress errors to avoid program termination
			{
				$this->printf('Could not create "%s" path "%s", check file permissions', $path_description, $path);
			}
		}
		else
		{
			$this->verbose('%s path "%s" already exists', ucfirst($path_description), realpath($path));
		}
	}

	/**
	 * create application runtime paths asset and runtime
	 *
	 * @param string $assetPath
	 * @param string $runtimePath
	 * @return void
	 */
	public function actionRuntimePaths($assetPath = null, $runtimePath = null)
	{
		if ($assetPath === null)
		{
			$assetPath = __DIR__ . '/../../assets/';
		}

		if ($runtimePath === null)
		{
			$runtimePath = __DIR__ . '/../runtime/';
		}

		$this->createPath($assetPath, 'asset');
		$this->createPath($runtimePath, 'runtime');
	}

	public function actionFilePermissions()
	{

	}

	/**
	 * get list of known themes
	 *
	 * @return string[]
	 */
	protected function getThemes()
	{
		$dir = scandir(__DIR__ . '/../../themes');
		foreach ($dir as $key => $file)
		{
			if ($file == '.' || $file == '..')
			{
				unset($dir[$key]);
			}
		}
		return $dir;
	}

	/**
	 * test database connection
	 * 
	 * @param string $system
	 * @param string $host
	 * @param string $name
	 * @param string $user
	 * @param string $pass
	 * @return boolean 
	 */
	protected function validateDbConnection($db_system, $db_host, $db_name, $db_user, $db_pass)
	{
		$this->verbose('Check database connection');
		$conn = new CDbConnection("{$db_system}:host={$db_host};dbname={$db_name}",
			$db_user, $db_pass);
		try
		{
			$conn->init();
		}
		catch (CDbException $ex)
		{
			$this->verbose('Database connection failed');
			return false;
		}
		$this->verbose('Database connection ok');
		return true;
	}

	/**
	 * prompt for config values and write config
	 *
	 * @return void
	 */
	public function actionSetupConfig()
	{
		$web_config = __DIR__ . '/../config/main_local.php';
		$web_config_template = file_get_contents(__DIR__ . '/../config/main.tmpl.php');

		$console_config = __DIR__ . '/../config/console_local.php';
		$console_config_template = file_get_contents(__DIR__ . '/../config/console.tmpl.php');

		$name = $this->prompt('Application name?');
		$email = $this->prompt('System administration email address?');
		$theme = $this->prompt('Custom theme (' . implode(', ', $this->getThemes()) . ')?');

		$retry_db = true;
		while ($retry_db)
		{
			$db_system = $this->prompt('Database system (pgsql, mysql)?');
			$db_host = $this->prompt('Database host?');
			$db_name = $this->prompt('Database name?');
			$db_user = $this->prompt('Database user?');
			$db_pass = $this->prompt('Database password for ' . $db_user . '?');

			if (!$this->validateDbConnection($db_system, $db_host, $db_name, $db_user, $db_pass))
			{
				$retry = $this->prompt('The connection data you entered is invalid. Retry or keep them (r/k)?', 'r');
				$retry_db = (strtolower($retry) == 'r');
			}
			else
			{
				$retry_db = false;
			}
		}

		// replace variables in config templates
		foreach (array('web_config_template', 'console_config_template') as $template)
		{
			$$template = str_replace(
				array(
					'{{NAME}}', '{{EMAIL}}', '{{THEME}}',
					'{{DB_SYSTEM}}', '{{DB_HOST}}', '{{DB_NAME}}', '{{DB_USER}}', '{{DB_PASS}}',
				),
				array(
					$name, $email, $theme,
					$db_system, $db_host, $db_name, $db_user, $db_pass
				), $$template
			);
		}

		// check existing config file and create backup
		foreach (array('web_config', 'console_config') as $config_file)
		{
			$this->verbose('Test if config file "%s" already exists', $$config_file);
			if (file_exists($$config_file))
			{
				$$config_file = realpath ($$config_file);
				$this->printf('Config file "%s" already exists.', $$config_file);
				$y_n = $this->prompt('Override and backup (y/n)?', 'y');
				if (strtolower($y_n) == 'y')
				{
					$backup_name = $$config_file . '.' . time() . '.bak';
					$this->verbose('Copy "%s" to "%s"', $$config_file, $backup_name);
					copy($$config_file, $backup_name);
				}
			}
		}

		// write data to local config files
		$check_value = null;
		$check = null;
		do
		{
			$check_value = rand(1000, 9999);
			$check = $this->prompt('Please confirm to write config files by entering ' . $check_value);
		}
		while ($check_value != $check);

		$this->verbose('Copy values to config file "%s"', $web_config);
		file_put_contents($web_config, $web_config_template);

		$this->verbose('Copy values to config file "%s"', $console_config);
		file_put_contents($console_config, $console_config_template);
	}

	/**
	 * create a new world and fill it with islands
	 *
	 * @param string $world_name
	 * @param string $db_host
	 * @param string $db_name
	 * @param string $imagePath path to bitmap used as world blueprint
	 * @param string $path_to_java
	 * @param string $path_to_seawars
	 * @return void
	 */
	public function actionCreateWorld($world_name, $db_host, $db_name,
		$imagePath = 'protected/vendors/seawars-server/resources/example.bmp',
		$path_to_java = null, $path_to_seawars = null)
	{
		$world = new World();
		$world->name = $world_name;
		$world->save();

		// validate external program paths

		if (empty($path_to_java))
		{
			$path_to_java = trim(shell_exec('which java'));
			if (empty($path_to_java))
			{
				$this->printf('No path to java found, supply as parameter');
				exit(-1);
			}
			else
			{
				$this->verbose('Set path to java to "%s"', $path_to_java);
			}
		}
		else
		{
			if ((!file_exists($path_to_java)) || (!is_executable($path_to_java)))
			{
				$this->printf('Given path to java "%s" is invalid', $path_to_java);
				exit(-1);
			}
		}

		if (empty($path_to_seawars))
		{
			$path_to_seawars = realpath(__DIR__ . '/../vendors/seawars-server/dist/SeaWars-Server.jar');
			if (empty($path_to_seawars) || !file_exists($path_to_seawars))
			{
				$this->printf('No path to sea wars server found, supply as parameter');
				exit(-1);
			}
			else
			{
				$this->verbose('Set path to sea wars server to "%s"', $path_to_seawars);
			}
		}
		else
		{
			if ((!file_exists($path_to_seawars)) || (!is_executable($path_to_seawars)))
			{
				$this->printf('Given path to sea wars server "%s" is invalid', $path_to_seawars);
				exit(-1);
			}
		}

		// call external world creation script
		// that creates map sections, archipelagos and islands
		$this->printf('Execute seawars-server to generate world data');
		$command = sprintf('%s -jar %s -path %s -dbhost %s -dbname %s -dbuser %s -dbpass %s',
			$path_to_java, $path_to_seawars, escapeshellarg(realpath($imagePath)),
			$db_host, $db_name, Yii::app()->db->username, Yii::app()->db->password
		);
		$this->verbose('Command: %s', $command);
		passthru($command);
	}

}
