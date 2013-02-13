<?php // Edition graphique d'un polygone

// Contient le code PHP de la page
// Le code html est dans /vues/*.html
// Le code javascript est dans /vues/*.js
// Les variables sont passées dans l'objet $modele->...

// 21/07/12 Dominique : Création

require_once("../modeles/fonctions_polygones.php");

// Création d'un nouveau polygone
if ($_POST['creer'] && $_POST['name'] && $_POST['type']) {
	mysql_query ("INSERT INTO polygones set nom_polygone='".$_POST['name']."', id_polygone_type='".$_POST['type']."',article_partitif='".$_POST['article_partitif']."'");
	$new_polygone = mysql_insert_id ();
	$modele->message = 'Le nouveau polygone '.$_POST['name'].' à été crée vide, vous pouvez <u><a href="/gestion/?page=edit_polygone&id_polygone='.$new_polygone.'">l\'éditer</a></u> pour ajouter un contour';
}

// Enregistre les modifs de paramètres
if ($_POST['valider'] && $_POST['name'] && $_POST['type'])
	mysql_query ("UPDATE polygones SET nom_polygone='".$_POST['name']."',id_polygone_type='".$_POST['type']."',article_partitif='".$_POST['article_partitif']."' WHERE id_polygone=$id_polygone");

// Récupère les infos de fonctions_bdd.php
$modele->infos_base = infos_base ();

$modele->id_polygone = $_GET['id_polygone'];
if ($modele->id_polygone > 0)
	$modele->infos = infos_polygone ($modele->id_polygone);

//TODO: à factoriser dans une fonction car doublon avec import_polygone.php
$query_type_polygone="SELECT * from polygone_type order by ordre_taille";
$resultat=mysql_query($query_type_polygone);
while ($type_polygone=mysql_fetch_object($resultat)) {
	$selected = $modele->infos->id_polygone_type == $type_polygone->id_polygone_type ? "selected=\"selected\"" : "";
	$modele->choix_type.="\t<option value=\"$type_polygone->id_polygone_type\" $selected>$type_polygone->type_polygone</option>\n";
}

// Liste ordonnée des polygones de la base
$resultat=mysql_query('SELECT * from polygones JOIN polygone_type USING (id_polygone_type) ORDER BY nom_polygone');
while ($polygone=mysql_fetch_object($resultat))
	$modele->liste_polygones [ucfirst ($polygone->type_polygone)] [ucfirst ($polygone->nom_polygone)] = $polygone;

// On affiche le tout
$modele->type =
	$modele->infos->nom_polygone ?
		'edit_polygone' : // On édite les paramètres de la carte et du polygone
		'edit_polygones'; // On affiche la liste des polygones
include ($config['document_root']."gestion/vues/$modele->type.html");
?>
