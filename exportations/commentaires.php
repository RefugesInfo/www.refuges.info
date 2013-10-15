<?php
// Exporte les donnees des commentaires (pour usage dans Chemineur)
// Format barbare et purement proritaire Chemineur

require_once ("../includes/config.php");
require_once ("exportation.php");

$query = "SELECT * FROM commentaires";

if (!($res = $pdo->query ($query))) 
    return erreur("Une erreur sur la requete est survenue",$query);

while ($point = $res->fetch())
	foreach ($point AS $k => $v)
		echo "@@@$k=$v";
echo "@@@<br>\n";
?>
