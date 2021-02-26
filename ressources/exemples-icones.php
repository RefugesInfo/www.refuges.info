<style>
body {
    background: linear-gradient(45deg, #fff 25%, #aaa 25%, #aaa 50%, #fff 50%, #fff 75%, #aaa 75%);
	background-size: 6px 6px;
}
</style>

<h1>Exemples d'icônes</h1>
<?php
$icones = [
	'ancien-point-d-eau',
	'batiment-en-montagne',
	'batiment-inutilisable',
	'cabane-avec-eau',
	'cabane-avec-moyen-de-chauffage',
	'cabane-avec-moyen-de-chauffage-et-eau-a-proximite',
	'cabane-cle',
	'cabane-eau-a-proximite',
	'cabane-manque-un-mur',
	'cabane-non-gardee',
	'cabane-sans-places-dormir',
	'gite-d-etape',
	'inutilisable',
	'lac',
	'passage-delicat',
	'point-d-eau',
	'refuge-garde',
	'sommet',

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
		<img src="../images/icones-test/<?=$params?>.svg" />
		<a href="../images/icones-test/<?=$params?>.svg">
			/images/icones-test/<?=$params?>.svg</a>
		&nbsp; &nbsp;
		<img src="../images/icones-test/<?=$params?>.png" />
		<a href="../images/icones-test/<?=$params?>.png">
			/images/icones-test/<?=$params?>.png</a>
	</p>
<?php } ?>
