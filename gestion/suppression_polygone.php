<?php
//**********************************************************************************************
//* Nom du module:         | suppression_polygone.php                                          *
//* Date :                 | 03/03/09                                                          *
//* Créateur :             | sly                                                               *
//* Rôle du module :       | Supprimer un polygone de la base                                  *
//*                        | Droits:  admin                                                    *
//*                        |                                                                   *
//*------------------------|-------------------------------------------------------------------*
//* Modifications(date Nom)| Elements modifiés, ajoutés ou supprimés                           *
//*------------------------|-------------------------------------------------------------------*
//* 03/03/09 sly           | création initiale                                                 *
//**********************************************************************************************

require_once ($config['chemin_modeles']."fonctions_polygones.php");

if ( (AUTH == 1) AND ($_SESSION['niveau_moderation']>=1) )
{


// sûrement que mettre ça dans une fonction ou des fonctions serait bien à l'avenir si on planifie de charger des 
// polygones autrement

if ($_POST['valider']!="") // On fait la suppression
{
if (suppression_polygone($_POST['id_polygone'])==-1)
	print("Une erreur est survenue, le numéro de polygone donné est incorrect");
else
	print("<p>Et bien votre polygone a été supprimé</p>");

}
else
{
$query_polygone="SELECT nom_polygone,id_polygone from polygones order by nom_polygone";
$resultat=mysql_query($query_polygone);
while ($polygone=mysql_fetch_object($resultat))
{
	$choix.="\t<option value=\"$polygone->id_polygone\">$polygone->nom_polygone</option>\n";
}

// On est obligé de poster vers soit même sinon l'index ajoute des trucs qui empêche l'export du GPX, je pourrais reprendre et refaire l'index.php, mais pour l'instant
// j'ai le flemme 19/04/2010 sly
print('<p>
Supprimer un polygone venant de la base :</p>

<form method="POST" action="/gestion/?page=suppression_polygone">

	Quel polygone supprimer ?
	<select name="id_polygone">
	'.$choix.'
	</select>
	<br/>
	<input type="submit" name="valider" value="Supprimer ce polygone">
</form>');


}
}
?>