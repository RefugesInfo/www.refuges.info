<style>
body {
    background: linear-gradient(45deg, #fff 25%, #aaa 25%, #aaa 50%, #fff 50%, #fff 75%, #aaa 75%);
	background-size: 6px 6px;
}
</style>

<h1>Exemples d'icônes</h1>
<?php

$alias = [
	'ancien-point-d-eau' => 'IeB',
	'batiment-en-montagne' => 'CblackTi',
	'batiment-inutilisable' => 'CblackB',
	'cabane-avec-eau' => 'E',
	'cabane-avec-moyen-de-chauffage' => 'F',
	'cabane-avec-moyen-de-chauffage-et-eau-a-proximite' => 'EF',
	'cabane-cle' => 'K',
	'cabane-eau-a-proximite' => 'E',
	'cabane-manque-un-mur' => 'Im',
	'cabane-non-gardee' => 'Ic',
	'cabane-sans-places-dormir' => 'T0',
	'gite-d-etape' => 'Cblue',
	'inutilisable' => 'CblackB',
	'lac' => 'Il',
	'passage-delicat' => 'Id',
	'point-d-eau' => 'Ie',
	'refuge-garde' => 'Cred',
	'sommet' => 'Is',
];
$icones = array_merge (array_keys ($alias), array_values ($alias));

foreach ($icones AS $nom) { ?>
	<p>
		<img src="../images/icones/<?=$nom?>.svg" />
		<a href="../images/icones/<?=$nom?>.svg">
			/images/icones/<?=$nom?>.svg</a>
		&nbsp; &nbsp;
		<img src="../images/icones/<?=$nom?>.png" />
		<a href="../images/icones/<?=$nom?>.png">
			/images/icones/<?=$nom?>.png</a>
	</p>
<?php } ?>
