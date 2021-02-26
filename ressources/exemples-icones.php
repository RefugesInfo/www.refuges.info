<h1>Exemples d'icônes</h1>
<?php
$icones = [
	'Ic',
	'T0',
	'E',
	'F',
	'EF',
	'K',
	'KE',
	'Im',
	'Cred',
	'Cgreen',
	'Cblue',
	'Ie',
	'IeB',
	'Is',
	'Id',
	'il',
	'CblackTi',
	'CblackB',
];

foreach ($icones AS $params) { ?>
	<p>
		<img src="../images/icones/<?=$params?>.svg" /> &nbsp;
		<a href="../images/icones/<?=$params?>.svg">
			/images/icones/<?=$params?>.svg</a>
	</p>
<?php } ?>
