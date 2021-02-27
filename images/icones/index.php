<?php
/* Cet utilitaire produit toutes les icônes SVG utilisées par les cartes
Le nom du fichier est une suite de majuscules, minuscules ou chiffres :

Icônes
------
Ic : cabane
Id : danger, passage délicat
Ie : point d'eau
Il : lac
Im : manque un mur
Is : sommet
Défaut : forme de bâtiment

Couleurs (des formes de bâtiment)
--------------------------------
Cblack : batiment blanc, toit et murs noirs
Cgreen : batiment vert (gîte)
Cred : batiment rouge (refuge gardé)
C... : autres couleurs CSS
Défaut : cabane ocre

Additifs
--------
B : barrée (une grande croix noire)
E : goute d'eau
F : feu (cheminée et fumée)
K : clé
T0 : caractère 0
Ti : caractère ?

*/

//-------------------------
// Traduction des alias
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
$nom = $_GET['nom'];
if (isset ($alias[$nom]))
	$nom = $alias[$nom];

//-------------------------
// Extraction des arguments
preg_match_all ('/([A-Z])([a-z0-9]*)/', $nom, $match);
foreach ($match[2] AS $k=>$v)
	$arg[$match[1][$k]] = $v;

// Arguments spéciaux
$taille = @$arg['s'] ?: 24;
$couleur_toit = @$arg['C'] ?: 'red';
$couleur_mur = @$arg['C'] ?: '#e08020';
$couleur = @$arg['C'] ?: '#ffeedd';
if ($couleur == 'black')
	$couleur = 'white';
if (@$arg['T'] == 'i') // Pour ne pas avoir un caractère "?" dans l'URL
	$arg['T'] = '?';

//------------------------------------------------
// On commence à enregistrer la sortie du template
ob_start();
?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" height="<?=$taille?>" width="<?=$taille?>">
<?php

if (isset ($arg['F'])) { /* la cheminée vient en premier car elle est masquée par le toit */
?>	<rect x="2" y="2" width="2" height="5" fill="black" />

<?php } if (@$arg['I'] == 'm') /* Manque un mur */ {
?>	<path d="M1 8.2 l7 -7,7 7" stroke-width="2" stroke-linecap="round" stroke="red" fill="none" />
	<path d="M4 8 l8 0" stroke-linecap="round" stroke="red" />
	<path d="M3 11.5 l10 0" stroke-linecap="round" stroke="red" />
	<path d="M3 15 l10 0" stroke-linecap="round" stroke="red" />

<?php } elseif (@$arg['I'] == 'e') /* Point d'eau */ {
?>	<ellipse cx="8" cy="10" rx="4.5" ry="4.5" stroke-width="0.5" stroke="#005e5e" fill="cyan" />
	<ellipse cx="8" cy="10" rx="3" ry="3" stroke-width="0" fill="#005e5e" />
	<ellipse cx="8.7" cy="9.2" rx="3" ry="3" stroke-width="0" fill="cyan" />
	<path d="M4.2 7.6 l3.8 -6.6,3.8 6.6" stroke-width="0.5" stroke="#005e5e" fill="cyan" />

<?php } elseif (@$arg['I'] == 's') /* Sommet */ {
?>	<path d="M0 17.3 l5 -11,2 3,3 -8,6 16" stroke="white" fill="#583E24" />

<?php } elseif (@$arg['I'] == 'd') /* Danger */ {
?>	<path d="M1.2 15.25 l6.88 -11.75,6.8 11.75 Z" stroke-width="1.5" stroke="red" fill="white" />
	<text x="6.2" y="14" font-size="10px" >!</text>

<?php } elseif (@$arg['I'] == 'l') /* Lac */ {
?>	<ellipse cx="5" cy="6" rx="4" ry="3" stroke="#204A87" fill="#204A87" />
	<ellipse cx="9" cy="9" rx="6" ry="3" stroke="#204A87" fill="#204A87" />
	<ellipse cx="7.5" cy="8" rx="6" ry="3" stroke="#204A87" fill="#204A87" />

<?php } else { /* bâtiments */
?>	<path d="M2 7 l0 8.75,12 0,0 -8.75" stroke-width="0.5" stroke="<?=$couleur_mur?>" fill="<?=$couleur?>" />
	<path d="M1 8.2 l7 -7,7 7" stroke-width="2" stroke-linecap="round" stroke="<?=$couleur_toit?>" fill="<?=$couleur?>" />
	<?php if (!isset ($arg['C']) && /* Porte */
		!isset ($arg['E']) &&
		!isset ($arg['T']) &&
		!isset ($arg['K'])) {
	?>	<rect x="6" y="9" width="4" height="7" stroke="none" fill="#e08020" />

	<?php }
	}

if (isset ($arg['K'])) {
?>	<ellipse cx="13.2" cy="5.2" rx="2" ry="2" stroke-width="1.6" stroke="black" fill="none" />
	<path d="M12 6 l-9 9,-1.5 -1.5,2.8 -0.3,0.1 -2.7,1.9 1.8" stroke-width="1.4" stroke="black" fill="none" />

<?php } if (isset ($arg['F'])) { /* Fumée */
?>	<ellipse cx="9.5" cy="3.5" rx="6" ry="3" stroke="black" fill="#444444" />

<?php } if (isset ($arg['E'])) {
?>	<ellipse cx="11" cy="12.75" rx="2.25" ry="2.25" stroke-width="0.5" stroke="#005e5e" fill="cyan" />
	<ellipse cx="11" cy="12.75" rx="1.5" ry="1.5" stroke-width="0" fill="#005e5e" />
	<ellipse cx="11.35" cy="12.8" rx="1.5" ry="1.5" stroke-width="0" fill="cyan" />
	<path d="M9.1 11.55 l1.9 -3.3,1.9 3.3" stroke-width="0.5" stroke="#005e5e" fill="cyan" />

<?php } if (isset ($arg['T'])) {
?>	<text x="5" y="14.5" font-size="12px" ><?=$arg['T']?></text>

<?php } if (isset ($arg['B'])) {
?>	<path d="M0.75 2.5 l14.5 12.75" stroke-width="1.5" stroke-linecap="round" stroke="black" fill="none" />
	<path d="M0.75 15.25 l14.5 -12.75" stroke-width="1.5" stroke-linecap="round" stroke="black" fill="none" />

<?php } ?></svg>
<?php

//--------------------------------------------
// On fini d'enregistrer la sortie du template
$svg =  ob_get_contents();
ob_end_clean();

//--------------------------
// Sortie en format SVG
if ($_GET['ext'] == 'svg') {
	header ('Content-type: image/svg+xml');
//	header ('Cache-Control: max-age=86000');
	echo $svg;
}

//--------------------------
// Traduit le texte SVG en format PNG
if ($_GET['ext'] == 'png') {
	header ('Content-type: image/png');
//	header ('Cache-Control: max-age=86000');

	$image = new Imagick();
	$image->setBackgroundColor(new ImagickPixel('transparent'));
	$image->readImageBlob($svg);
	$image->setImageFormat('png');
	echo $image;
	$image->clear();
	$image->destroy();
}