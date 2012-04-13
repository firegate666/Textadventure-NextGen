<?php

class Utils {

	/**
	 * create an image
	 * 
	 * @param boolean $boolean
	 * @param string $tooltip
	 * @param string $true_icon
	 * @param string $false_icon
	 * @uses CHtml::image()
	 * @return string img tag
	 */
	public static function bool2icon($boolean, $tooltip = '', $true_icon = 'success', $false_icon = 'error')
	{
		$baseurl = Yii::app()->request->baseUrl;
		$iconpath = 'public/images/icons/';
		$icon = $boolean ? $true_icon : $false_icon;
		$ext = '.png';
		return CHtml::image($baseurl . $iconpath . $icon . $ext, $tooltip, array('title' => $tooltip));		
	}
}
