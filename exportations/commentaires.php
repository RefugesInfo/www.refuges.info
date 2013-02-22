<?php
//**********************************************************************************************
//* Nom du module:         | commentaire.php                                                   *
//* Date :                 | 22/10/2011                                                        *
//* Créateur :             | Dominique                                                         *
//* Rôle du module :       | Exporte les données des commentaires (pour usage dans Chemineur)  *
//*                        | Format barbare et purement proriètaire Chemineur                  *
//*------------------------|-------------------------------------------------------------------*
//* Modifications(date Nom)| Elements modifiés, ajoutés ou supprimés                           *
//*------------------------|-------------------------------------------------------------------*
//**********************************************************************************************

require_once ("../modeles/config.php");
require_once ("fonctions_bdd.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_polygones.php");

$q_commentaires= "SELECT * FROM commentaires";
$r_commentaires= mysql_query($q_commentaires) or die("mauvaise requete: $q_commentaires");
while ($commentaire = mysql_fetch_object($r_commentaires))
  foreach ($commentaire AS $k => $v)
    echo "§§$k=$v";
  echo "§§<br>\n";

?>
