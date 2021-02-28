<?php
/* Cet utilitaire produit toutes les icônes SVG utilisées par les cartes

Les définitions sont dans un tableau $config_wri['definition_icones']
situé dans includes/config.php comportant :

Icônes
------
'icone' => 'eau' point d'eau)
'icone' => 'lac'
'icone' => 'precaire' (manque un mur)
'icone' => 'sommet'
'icone' => 'triangle' (passage délicat)
Défaut : cabane, forme de bâtiment

Couleurs (des formes de bâtiment)
--------------------------------
couleur = 'black' : batiment blanc, toit et murs noirs
couleur = 'green' : batiment vert (gîte)
couleur = 'red' : batiment rouge (refuge gardé)
couleur = '...' : autres couleurs CSS
Défaut : cabane ocre

Attributs
---------
'cle'
'croix' (une grande croix noire)
'eau' (petite goute d'eau
'feu' (cheminée et fumée)
'texte' => 'X' (caractère X)

*/

// On récupère les definitions
// et on les met en forme pour pouvoir les traiter facilement
include_once ('../../includes/config.php');
$def = @$config_wri['definition_icones'] [$_GET ['nom']] ?: [];
$att = array_filter ($def, 'is_int', ARRAY_FILTER_USE_KEY);

// Arguments spéciaux
$taille = @$def['taille'] ?: 24;
$couleur_toit = @$def['couleur'] ?: 'red';
$couleur_mur = @$def['couleur'] ?: '#e08020';
$couleur = @$def['couleur'] ?: '#ffeedd';
if ($couleur == 'black')
	$couleur = 'white';

//------------------------------------------------
// On commence à capturer la sortie du template
ob_start();

// Template SVG
?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" height="<?=$taille?>" width="<?=$taille?>">
<?php

if (@$def['icone'] == 'eau') {
?>	<ellipse cx="8" cy="10" rx="4.5" ry="4.5" stroke-width="0.5" stroke="#005e5e" fill="cyan" />
	<ellipse cx="8" cy="10" rx="3" ry="3" stroke-width="0" fill="#005e5e" />
	<ellipse cx="8.7" cy="9.2" rx="3" ry="3" stroke-width="0" fill="cyan" />
	<path d="M4.2 7.6 l3.8 -6.6,3.8 6.6" stroke-width="0.5" stroke="#005e5e" fill="cyan" />

<?php } elseif (@$def['icone'] == 'lac') {
?>	<ellipse cx="5" cy="6" rx="4" ry="3" stroke="#204A87" fill="#204A87" />
	<ellipse cx="9" cy="9" rx="6" ry="3" stroke="#204A87" fill="#204A87" />
	<ellipse cx="7.5" cy="8" rx="6" ry="3" stroke="#204A87" fill="#204A87" />

<?php } elseif (@$def['icone'] == 'precaire') /* Manque un mur */ {
?>	<path d="M1 8.2 l7 -7,7 7" stroke-width="2" stroke-linecap="round" stroke="red" fill="none" />
	<path d="M4 8 l8 0" stroke-linecap="round" stroke="red" />
	<path d="M3 11.5 l10 0" stroke-linecap="round" stroke="red" />
	<path d="M3 15 l10 0" stroke-linecap="round" stroke="red" />

<?php } elseif (@$def['icone'] == 'sommet') {
?>	<path d="M0 17.3 l5 -11,2 3,3 -8,6 16" stroke="white" fill="#583E24" />

<?php } elseif (@$def['icone'] == 'triangle') {
?>	<path d="M1.2 15.25 l6.88 -11.75,6.8 11.75 Z" stroke-width="1.5" stroke="red" fill="white" />

<?php } else { /* Bâtiments */
?>	<path d="M2 7 l0 8.75,12 0,0 -8.75" stroke-width="0.5" stroke="<?=$couleur_mur?>" fill="<?=$couleur?>" />
	<path d="M1 8.2 l7 -7,7 7" stroke-width="2" stroke-linecap="round" stroke="<?=$couleur_toit?>" fill="<?=$couleur?>" />
	<?php if (!isset ($def['couleur']) && /* Porte */
		!isset ($def['texte']) &&
		!in_array('eau', $att) &&
		!in_array('cle', $att)) {
	?>	<rect x="6" y="9" width="4" height="7" stroke="none" fill="#e08020" />

	<?php }
	}

// Attirubuts
if (in_array('cle', $att)) {
?>	<ellipse cx="13.2" cy="5.2" rx="2" ry="2" stroke-width="1.6" stroke="black" fill="none" />
	<path d="M12 6 l-9 9,-1.5 -1.5,2.8 -0.3,0.1 -2.7,1.9 1.8" stroke-width="1.4" stroke="black" fill="none" />

<?php } if (in_array('croix', $att)) {
?>	<path d="M0.75 2.5 l14.5 12.75" stroke-width="1.5" stroke-linecap="round" stroke="black" fill="none" />
	<path d="M0.75 15.25 l14.5 -12.75" stroke-width="1.5" stroke-linecap="round" stroke="black" fill="none" />

<?php } if (in_array('eau', $att)) {
?>	<ellipse cx="11" cy="12.75" rx="2.25" ry="2.25" stroke-width="0.5" stroke="#005e5e" fill="cyan" />
	<path d="M9.1 11.55 l1.9 -3.3,1.9 3.3" stroke-width="0.5" stroke="#005e5e" fill="cyan" />

<?php } if (in_array('feu', $att)) {
?>	<rect x="2" y="1.5" width="2" height="5" fill="black" />
	<ellipse cx="5.5" cy="2" rx="1" ry="1" stroke="#444444" fill="#888888" />
	<ellipse cx="9" cy="2" rx="1.5" ry="1.5" stroke="#444444" fill="#888888" />
	<ellipse cx="13.5" cy="2.5" rx="2" ry="2" stroke="#444444" fill="#888888" />

<?php } if (isset ($def['texte'])) {
?>	<text x="<?=$def['texte']=='!'?6:5?>" y="14.5" font-size="12px" ><?=$def['texte']?></text>

<?php } ?></svg>
<?php

//--------------------------------------------
// On fini de capturer la sortie du template
$svg =  ob_get_contents();
ob_end_clean();

//---------------------
// Sortie en format SVG
if ($_GET['ext'] == 'svg') {
	header ('Content-type: image/svg+xml');
	header ('Cache-Control: max-age=86000');
	header ('Access-Control-Allow-Origin: *');

	echo $svg;
}

//---------------------
// Sortie en format SVG
if ($_GET['ext'] == 'png') {
	header ('Content-type: image/png');
	header ('Cache-Control: max-age=86000');
	header ('Access-Control-Allow-Origin: *');

	// Fabrique une image PNG à partir du script SVG
	$image = new Imagick();
	$image->setBackgroundColor(new ImagickPixel('transparent'));
	$image->readImageBlob($svg);
	$image->setImageFormat('png32');
	echo $image;
	$image->clear();
	$image->destroy();
}