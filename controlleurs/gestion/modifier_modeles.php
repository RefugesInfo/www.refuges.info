<?php
/***
Contrôleur qui prépare la vue pour les pages de modification des modeles
***/

// Ajout au template de la liste des types de points
$query="
	SELECT id_point, nom_type
	FROM points
	NATURAL JOIN point_type
	WHERE modele=1
	ORDER BY importance DESC";
$res = $pdo->query($query);
while ($mod = $res->fetch())
	$vue->types_points[$mod->id_point] = $mod->nom_type;

?>
