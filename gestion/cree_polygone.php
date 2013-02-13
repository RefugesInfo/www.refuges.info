<?php // Création d'un nouveau polygone

// Contient le code PHP de la page
// Le code html est dans /vues/*.html
// Le code javascript est dans /vues/*.js
// Les variables sont passées dans l'objet $modele->...

// 23/07/12 Dominique : Création


//TODO: à factoriser dans une fonction car doublon avec /gestion/import_polygone.php
$query_type_polygone="SELECT * from polygone_type order by ordre_taille";
$resultat=mysql_query($query_type_polygone);
while ($type_polygone=mysql_fetch_object($resultat)) {
	$selected = $modele->infos->id_polygone_type == $type_polygone->id_polygone_type ? "selected=\"selected\"" : "";
	$modele->choix_type.="\t<option value=\"$type_polygone->id_polygone_type\" $selected>$type_polygone->type_polygone</option>\n";
}

// On affiche le tout
$modele->type = 'cree_polygone';
include ($config['document_root']."gestion/vues/$modele->type.html");
?>
