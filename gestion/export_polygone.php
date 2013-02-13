<?php
//**********************************************************************************************
//* Nom du module:         | import_polygone.php                                               *
//* Date :                 | 03/03/09                                                          *
//* Créateur :             | sly                                                               *
//* Rôle du module :       | Importer un polygne GPS dans la base en choisisant son type       *
//*                        | Droits:  admin                                                    *
//*                        |                                                                   *
//*------------------------|-------------------------------------------------------------------*
//* Modifications(date Nom)| Elements modifiés, ajoutés ou supprimés                           *
//*------------------------|-------------------------------------------------------------------*
//* 03/03/09 sly           | création initiale                                                 *

//**********************************************************************************************
/*
Fichier double fonction :
1) le formulaire de saisie du gpx et option du polygone
2) traitement de tout ça
*/

require_once ("../modeles/config.php");
require_once ($config['chemin_modeles']."fonctions_autoconnexion.php");
require_once ($config['chemin_modeles']."fonctions_bdd.php");
require_once ($config['chemin_modeles']."fonctions_exportations.php");

//obligé de couper un peu de sécurité, car ce fichier exporte un xml en direct et doit être appelé sans passer
//par l'index.php
//la sécu reste bonne, car il faut être loggé en admin du site pour arriver à exporter, ça devrait suffire
//if ( (AUTH == 1) AND ($_SESSION['niveau_moderation']>=1) )

if ($_SESSION['niveau_moderation']>=1) 
{

  if ($_POST['valider']!="") // On fait l'export
  {
    if (($xml_gpx=export_polygone_gpx($_POST['id_polygone']))==-1)
      print("J'ai besoin d'un numéro de polygone, j'ai reçu quelque chose d'anormal");
    else
    {
      $query_lequel="Select nom_polygone From polygones where id_polygone=$_POST[id_polygone]";
      $res=mysql_query($query_lequel);
      $polygone=mysql_fetch_object($res);
      
      header('Content-type: application/gpx+xml');
      header('Content-Disposition: attachment; filename="'.$polygone->nom_polygone.'.gpx"');

      print($xml_gpx);
    }
  }
  else
  {
    $query_type_polygone="SELECT nom_polygone,id_polygone from polygones order by nom_polygone";
    $resultat=mysql_query($query_type_polygone);
    while ($polygone=mysql_fetch_object($resultat))
    {
      $choix.="\t<option value=\"$polygone->id_polygone\">$polygone->nom_polygone</option>\n";
    }
    
    // On est obligé de poster vers soit même sinon l'index ajoute des trucs qui empêche l'export du GPX, je pourrais reprendre et refaire l'index.php, mais pour l'instant
    // j'ai le flemme 19/04/2010 sly
    print('<p>
Exporter un polygone venant de la base :</p>

<form method="POST" action="/gestion/export_polygone.php">

	Quel polygone exporter ?
	<select name="id_polygone">
	'.$choix.'
	</select>
	<br/>
	<input type="submit" name="valider" value="Exporter ce polygone">
</form>');


  }
}
?>