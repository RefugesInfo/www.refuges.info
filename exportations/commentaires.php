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
require_once ($config['chemin_modeles']."fonctions_bdd.php");
require_once ($config['chemin_modeles']."fonctions_autoconnexion.php");
require_once ($config['chemin_modeles']."fonctions_polygones.php");

$q_commentaires= "SELECT * FROM commentaires";
$r_commentaires= mysql_query($q_commentaires) or die("mauvaise requete: $q_commentaires");
while ($commentaire = mysql_fetch_object($r_commentaires))
//	if ($commentaire->id_point==20)
	//{
	foreach ($commentaire AS $k => $v)
		echo "§§$k=$v";
		/*
		echo "§§id=wric$commentaire->id_commentaire";
		echo "§§point=wri$commentaire->id_point";
		if (@$commentaire->auteur) echo "§§auteur=$commentaire->auteur / http:refuges.info";
		if (@$commentaire->date)
		echo "§§modif=" .
		str_replace ('-', '',
		str_replace (' ', '', 
		str_replace (':', '',
		$commentaire->date
		)));
		if (@$commentaire->texte) echo "§§texte=$commentaire->texte";
		if (@$commentaire->photo_existe) echo "§§image=http://www.refuges.info/photos_points/$commentaire->id_commentaire-originale.jpeg";
		*/
	//}
echo "§§<br>\n";

//------------
mysql_free_result ($r_commentaires); // libère la boucle des massifs
// fermeture cnx mysql
if (is_resource($mysqlink))
    mysql_close($mysqlink);

?>
