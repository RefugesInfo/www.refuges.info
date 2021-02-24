<?php
// Cet utilitaire produit toutes les icônes SVG utilisées par les cartes
header ( 'Content-type: image/svg+xml' );
header ('Cache-Control: max-age=86000');

$taille = @$_GET['s'] ?: 24;
$icone = @$_GET['icone'] ?: 'cabane';
$couleur = @$_GET['couleur'] ?: '#ffeedd';
$couleur_mur = @$_GET['couleur'] ?: '#e08020';
$couleur_toit = @$_GET['couleur'] ?: 'red';
if ($couleur == 'black')
	$couleur = 'white';
?>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" height="<?=$taille?>" width="<?=$taille?>">

<?php if (isset ($_GET['feu'])) { /* la cheminée vient en premier car elle est masquée par le toit */ ?>
	<rect x="2" y="2" width="2" height="5" fill="black" />
<?php } ?>

<?php if ($icone == 'cabane') { ?>
	<path d="M2 7 l0 8.75,12 0,0 -8.75" stroke-width="0.5" stroke="<?=$couleur_mur?>" fill="<?=$couleur?>" />
	<path d="M1 8.2 l7 -7,7 7" stroke-width="2" stroke-linecap="round" stroke="<?=$couleur_toit?>" fill="<?=$couleur?>" />
	<?php if (!isset ($_GET['cle']) &&
		!isset ($_GET['eau']) &&
		!isset ($_GET['texte']) &&
		!isset ($_GET['couleur'])) { /* Porte */ ?>
		<rect x="6" y="9" width="4" height="7" fill="#e08020" />
	<?php } ?>
<?php } elseif ($icone == 'manque') { ?>
	<path d="M1 8.2 l7 -7,7 7" stroke-width="2" stroke-linecap="round" stroke="red" fill="none" />
	<path d="M4 8 l8 0" stroke-linecap="round" stroke="red" />
	<path d="M3 11.5 l10 0" stroke-linecap="round" stroke="red" />
	<path d="M3 15 l10 0" stroke-linecap="round" stroke="red" />
<?php } elseif ($icone == 'eau') { ?>
	<ellipse cx="8" cy="10" rx="4.5" ry="4.5" stroke-width="0.5" stroke="#005e5e" fill="cyan" />
	<ellipse cx="8" cy="10" rx="3" ry="3" stroke-width="0" fill="#005e5e" />
	<ellipse cx="8.7" cy="9.2" rx="3" ry="3" stroke-width="0" fill="cyan" />
	<path d="M4.2 7.6 l3.8 -6.6,3.8 6.6" stroke-width="0.5" stroke="#005e5e" fill="cyan" />
<?php } elseif ($icone == 'sommet') { ?>
	<path d="M0 17.3 l5 -11,2 3,3 -8,6 16" stroke="white" fill="#583E24" />
<?php } elseif ($icone == 'danger') { ?>
	<path d="M1.2 15.25 l6.88 -11.75,6.8 11.75 Z" stroke-width="1.5" stroke="red" fill="white" />
	<text x="6.2" y="14" font-size="0.7em" >!</text>
<?php } elseif ($icone == 'lac') { ?>
	<ellipse cx="5" cy="6" rx="4" ry="3" stroke="#204A87" fill="#204A87" />
	<ellipse cx="9" cy="9" rx="6" ry="3" stroke="#204A87" fill="#204A87" />
	<ellipse cx="7.5" cy="8" rx="6" ry="3" stroke="#204A87" fill="#204A87" />
<?php } ?>

<?php if (isset ($_GET['cle'])) { ?>
	<ellipse cx="13.2" cy="5.2" rx="2" ry="2" stroke-width="1.6" stroke="black" fill="none" />
	<path d="M12 6 l-9 9,-1.5 -1.5,2.8 -0.3,0.1 -2.7,1.9 1.8" stroke-width="1.4" stroke="black" fill="none" />
<?php } ?>

<?php if (isset ($_GET['feu'])) { /* Fumée */ ?>
	<ellipse cx="9.5" cy="3.5" rx="6" ry="3" stroke="black" fill="#444444" />
<?php } ?>

<?php if (isset ($_GET['eau'])) { ?>
	<ellipse cx="11" cy="12.75" rx="2.25" ry="2.25" stroke-width="0.5" stroke="#005e5e" fill="cyan" />
	<ellipse cx="11" cy="12.75" rx="1.5" ry="1.5" stroke-width="0" fill="#005e5e" />
	<ellipse cx="11.35" cy="12.8" rx="1.5" ry="1.5" stroke-width="0" fill="cyan" />
	<path d="M9.1 11.55 l1.9 -3.3,1.9 3.3" stroke-width="0.5" stroke="#005e5e" fill="cyan" />
<?php } ?>

<?php if (isset ($_GET['texte'])) { ?>
	<text x="4.5" y="14.5" font-size="smaller" ><?=$_GET['texte']?></text>
<?php } ?>

<?php if (isset ($_GET['barre'])) { ?>
	<path d="M0.75 2.5 l14.5 12.75" stroke-width="1.5" stroke-linecap="round" stroke="black" fill="none" />
	<path d="M0.75 15.25 l14.5 -12.75" stroke-width="1.5" stroke-linecap="round" stroke="black" fill="none" />
<?php } ?>
</svg>