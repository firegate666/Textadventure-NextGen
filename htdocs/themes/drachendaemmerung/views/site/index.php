<?php $this->pageTitle = Yii::app()->name; ?>

<h1>Willkommen bei <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<blockquote><strong>Heute ist</strong> <?php $this->renderDynamic('nowDate');?></blockquote>

<p>Drachend&aelig;mmerung ist mehr als nur ein Textadventure. Drachend&aelig;mmerung bietet Dir alle Möglicgkeiten selber zum Spielleiter zu werden.
	Erstelle mit ein paar einfachen Handgriffen ein neues Abenteuer und spiele es oder lasse es andere spielen.</p>

<p>Alles was Du dazu benötigst ist Deine Fantasie und Einfallsreichtum und ein wenig Kreativität.</p>

<p>Drachend&aelig;mmerung befindet sich noch in der Entwicklung, nicht alle Funktionen sind bereits ausgereift, dennoch kannst Du schon alles ausprobieren.
	Über <a href="<?=$this->createUrl('contact')?>">Feedback</a> zu Drachend&aelig;mmerung freue ich mich!</p>

<p>Wenn Du mehr über das Projekt erfahren möchtest, Fehler melden möchtest oder einfach nur Deine eigene Ideen zur Weiterentwicklung beisteuern möchtest,
	kannst Du unsere Projektseite im <a href="https://github.com/firegate666/Textadventure-NextGen/wiki" target="_blank">Redmine</a> besuchen</p>
