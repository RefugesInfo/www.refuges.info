<?php
/************************************************************************************
Fichier double fonction :
1) le formulaire de saisie du gpx et option du polygone
2) traitement de tout ça
3)L'importation d'un polygone devrait être dans une fonction ! arghhhh sly 19/04/2010
************************************************************************************/


if ( (AUTH == 1) AND ($_SESSION['niveau_moderation']>=1) )
{
require_once ($config['chemin_modeles']."fonctions_gps.php");
require_once ($config['chemin_modeles']."fonctions_polygones.php");


// sûrement que mettre ça dans une fonction ou des fonctions serait bien à l'avenir si on planifie de charger des 
// polygones autrement

if ($_POST['valider']!="") // On fait l'import
{
	if (!is_numeric($_POST['id_polygone_existant']))
		die("ça devrait par arriver, j'ai reçu un numéro de polygone qui est ni -1 ni numérique\n"); 
	$trace = simplexml_load_file($_FILES["fichier_gpx"]["tmp_name"]);
	// test de sécurité, vérifions que nous n'avons bien qu'une trace dans ce fichier
	$i=0;
	foreach ( $trace->trk as $track )
		$i++;
	if ($i==1) // On dirait que c'est bon coté nombre de track
	{
		// test de sécurité, vérifions que notre trace n'est pas en plusieurs morceaux
		$i=0;
		foreach ( $trace->trk->trkseg as $trackseg )
			$i++;
		if ($i==1) // On dirait que c'est bon coté nombre de morceaux de track
		{
			
			if ($_POST['id_polygone_existant']==-1)
			{
				// Ajoutons d'abord le polygone
				$query_ajout_polygone="INSERT INTO polygones set nom_polygone='$_POST[nom_polygone]',
				id_polygone_type=$_POST[id_polygone_type],article_partitif='$_POST[article_partitif]'";
				mysql_query($query_ajout_polygone);
				$id_polygone=mysql_insert_id();
			}
			else
			{
				$id_polygone=$_POST['id_polygone_existant'];
				suppression_points_polygone($id_polygone);	
			}
			
			$i=1;
			foreach ($trace->trk->trkseg->trkpt as $point)
			{
				//print($point['lat']);
				$point_gps->latitude=$point['lat'];
				$point_gps->longitude=$point['lon'];
				$id_point=modification_ajout_point_gps($point_gps,$_POST['id_polygone_type']);
				if ($id_point==-1)
					print("<strong>Ouîlle ouille ouille ! y'a un point tout louche dans le fichier lat:$point_gps->latitude lon:$point_gps->longitude</strong>");
				
				$query_ajout_point_polygone="INSERT INTO lien_polygone_gps set
				id_polygone=$id_polygone,id_point_gps=$id_point,ordre=$i";
				mysql_query($query_ajout_point_polygone);
				$i++;
			}
			// On demande la mise à jour des pré-calculs dans notre base du polygone qu'on vient de modifier/ajouter
			precalculs_polygones($id_polygone);
		}
		else
			print("<strong>Le fichier fourni dispose d'une trace, mais en $i morceaux : c'est anormal, je ne fais rien</strong>");
			
	}
	else
		print("<strong>Le fichier fourni dispose de $i traces, c'est anormal, je ne fais rien</strong>");
	
	print("<p>Il peut s'être passé pas mal de chose selon la tronche du fichier gpx, mais sans erreur au dessus, je dirais que c'est bon.
		Vous pouvez voir le polygone que vous avez ajouté sur la carte :
		<a href=\"".lien_polygone_lent($id_polygone)."\">Polygone ajouté</a></p>");
}
// quoi qu'il arrive, on affiche ou ré-affiche le formulaire pour le polygone suivant

$query_type_polygone="SELECT * from polygone_type order by ordre_taille";
$resultat=mysql_query($query_type_polygone);
while ($type_polygone=mysql_fetch_object($resultat))
{
	$choix.="\t<option value=\"$type_polygone->id_polygone_type\">$type_polygone->type_polygone</option>\n";
}

$query_polygone="SELECT nom_polygone,id_polygone,type_polygone from polygones,polygone_type where polygone_type.id_polygone_type=polygones.id_polygone_type order by nom_polygone";
$resultat=mysql_query($query_polygone);
while ($polygone=mysql_fetch_object($resultat))
{
	$choix_polygone_existant.="\t<option value=\"$polygone->id_polygone\">$polygone->nom_polygone ($polygone->type_polygone)</option>\n";
}

print('<p>
Ajout d\'un polygone dans la base :</p>

<form method="POST" enctype="multipart/form-data" action="/gestion/?page=import_polygone">
	<p>
	Nom du polygone :<input size="30" type="text" name="nom_polygone">
	<br>
	Article partitif du polygone ("de la", "de l\'", "du") :<input size="30" type="text" name="article_partitif">
	<br>
	Type de polygone :
	<select name="id_polygone_type">
	'.$choix.'
	</select>
	</p>
	<p>
	OU
	</p>
	<p>
	Mise à jour d\'un polygone déjà existant :
	<select name="id_polygone_existant">
	<option value="-1">On reste en mode ajout</option>
	'.$choix_polygone_existant.'
	</select>
	</p>
	<br/>
	Fichier GPX :<input type="file" name="fichier_gpx">
	</p>
	<input type="submit" name="valider" value="Ajouter ce polygone">
</form>');



}
?>
