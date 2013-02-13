<?php
/**********************************************************************************************
Rôle :        
Ecran de gestion du calcul d'appartenance des points (refuges,etc
à un ou plusieurs polygones.)
Droits: admin & supermodérateur.
Accès par : "./gestion/?page=calcul_appartenance_polygone"

On peut résumer sa fonction en disant qu'il précalcule les champs de la table appartenance_polygone pour chaque point de la base
le faire en temps réél ne fonctionne pas car il faut au moins une Minute par 1000 points ! (c'est même plutôt 1s par point en 2010)
Imaginez un peu le temps d'une recherche : "tous les refuges de belledonne" alors que là avec précalcul c'est très rapide
désormais on ne calcul plus que massif mais aussi Tous polygones TRES TRES long, optimisation en cours de recherche
Ou séparation en plusieurs étapes 95 s au dernier bench, je n'ai pas d'autres idées performance je pourrais rajouter du pré-calcul pour les tableaux polygones
Mais c'est relou car une fonction existe déjà  
31/10/08	sly 

c'est sacrément amélioré grace aux idées de dominique, le temps pris a été divisé par 50 voir code dans fonctions_polygones.php
20/11/10    sly
***********************************************************************************************/

//vérification des autorisations

if ( (AUTH ==1) AND ($_SESSION['niveau_moderation']>=1) )
{
require_once ($config['chemin_modeles']."fonctions_polygones.php");

$bench=array();
$test_conformite="";

// function de mesure de benchmarks
function p($checkpoint,$entree_sortie=2)
{
  //return 1;
  global $bench;
  if ($bench[$checkpoint]['passages']=="")
  {
    $bench[$checkpoint]['passages']=0;
    $bench[$checkpoint]['total']=0;
  }
  
    if ($entree_sortie==1)
      $bench[$checkpoint]['avant']=microtime(true);
    else
    {
          $bench[$checkpoint]['total']+=(microtime(true)-$bench[$checkpoint]['avant']);
	  $bench[$checkpoint]['passages']++;
    }

}

$t_start=microtime(true);


print("<p>Calcul d'Appartenance Polygones</p>");

// Flûte, ce calcul mortel d'apparenance ne tient plus dans la limite des 120s on peut faire en plusieurs coups
// ouf, ça s'est bien amélioré avec les nouvelles idées de dominique
// sauf que l'on rajoute toujours plus de polygone et toujours plus de points, on en est à 60s en 12/2011
$query="SELECT id_point FROM points WHERE modele!=1 order by id_point";
$resultat_liste=mysql_query($query);
$nbpoints=mysql_num_rows($resultat_liste);

print("<p>$nbpoints points à recalculer début=0s</p>");
$bilan=array();

$query_polygones= "SELECT *
	FROM polygones WHERE id_polygone!=0";

$resultat_liste_polygones=mysql_query($query_polygones);
$nb_polygones=mysql_num_rows($resultat_liste_polygones);

print("<h4>$nb_polygones polygones à considérer</h4>");

$i=0;
$cache_polygones=array();
while ($point=mysql_fetch_object($resultat_liste))
{
	$i++;
	print(".");flush();
	
	if ($i==50)
	{$i=0;print("jusqu'a id=$point->id_point fait ".(microtime(true)-$t)."s\n<br>");}
	
	p("mettre à jour",1);
	mettre_a_jour_appartenance_point($point->id_point);
	p("mettre à jour");
}

print("<br />Durée totale: ".($tot=microtime(true)-$t_start)."s");
foreach ($bench as $clef => $value)
  print("<br />Temps passé à $clef = ".(100*$value['total']/$tot)." %");
print("<br /> L'état actuel, dans la base est :<br />");
$query_bilan="SELECT *,count(*) as nombre FROM polygones,appartenance_polygone 
		WHERE appartenance_polygone.id_polygone=polygones.id_polygone 
group by polygones.id_polygone 
ORDER by nombre desc";
$res=mysql_query($query_bilan);
while ($poly=mysql_fetch_object($res));
	print("$poly->nom_polygone ($poly->id_polygone) : $poly->nombre points<br />");

}

?>
