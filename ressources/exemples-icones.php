<h1>Exemples d'icônes</h1>
<?php
$icones = [
	'cabane',
	'texte=0',
	'eau',
	'feu',
	'eau&feu',
	'cle',
	'icone=manque',
	'couleur=red',
	'couleur=green',
	'couleur=blue',
	'icone=eau',
	'icone=eau&barre',
	'icone=sommet',
	'icone=danger',
	'icone=lac',
	'couleur=black&texte=?',
	'couleur=black&barre=?',
];

foreach ($icones AS $params) { ?>
	<p>
		<img src="../images/icone.svg.php?<?=$params?>" /> &nbsp;
		<a href="../images/icone.svg.php?<?=$params?>">
			/images/icone.svg.php?<?=$params?>
		</a> &nbsp;
		API... type":{,"valeur" = "<?=$params?>"}
	</p>
<?php } ?>
