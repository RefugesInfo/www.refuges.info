<?php
/*
Ne marchera que à la ligne de commande (à cause du timeout php)

Script d'importation des données osm qui nous intéressent
polygones : réserves naturelles, pays, département
points : hôtels, campings, chambres d'hôtes

Principe : la base OSM, c'est ENORME : ~350Go en 1 seul fichier xml, donc aucune chance de faire comme ça, il faut donc ne faire des récupérations
que partielles car seule une très faible part des données osm nous intéressent, la solution : interroger le service Overpass :
http://wiki.openstreetmap.org/wiki/Overpass_API uniquement sur les "zones qui nous intéressent" et uniquement pour les types de données qui nous intéressent


FIXME : automatiser le téléchargement des données osm et le limiter aux "zones" qui nous intéressent
FIXME: code le support, avec curl par exemple, du téléchargement depuis l'overpass API
FIXME: question à se poser : ce truc est relativement indépendant de wri, dois-je l'inclure dans les modeles ? sachant que ça ne s'appel pas par le web de toute façon ?
*/
require_once("../../../modeles/config.php");
require_once("fonctions_bdd.php");
$overpass_query_template='<osm-script timeout="1800" element-limit="1073741824">
<union>
<query type="relation">
<bbox-query s="##sud##" n="##nord##" w="##ouest##" e="##est##"/>
  ##conditions_osm##
</query>
  <recurse type="relation-node" into="nodes"/>
  <recurse type="relation-way"/>
  <recurse type="way-node"/>
</union>
<print/>
</osm-script>';

function requete_overpass_api($xml_query)
{
  global $config;

  $ch = curl_init($config['overpass_api']);
  
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "data=".$xml_query);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $reponse = curl_exec($ch);
  curl_close($ch);
  return $reponse;
}


$dossier_temporaire="./tmp";

// Récupération des bbox des zones
$box="st_box2d(geom)";
// FIXME : exclusion manuelle des zones trop grosses
$query_bbox_zone="select nom_polygone,
                     st_xmin($box) as ouest,
                     st_xmax($box) as est,
                     st_ymin($box) as sud,
                     st_ymax($box) as nord
                     from polygones 
                   where 
                       id_polygone_type=11
                     and
                       id_polygone not in (750,460)
                     and 
                       geom is not null limit 20;";
$res=$pdo->query($query_bbox_zone) or die($query_bbox_zone);
while ($bbox=$res->fetch())
  $bboxes[]=$bbox;

$prefix="osm_temporaire";
$params="-d ".$config['base_pgsql']." -H ".$config['serveur_pgsql']." -U ".$config['utilisateur_pgsql']."";

// osm2pgsql n'accepte pas le mot de passe en paramètre, mais dans une variable d'environnement
putenv("PGPASS=".$config['mot_de_passe_pgsql']);
$first_time=true;
$conditions=array("<has-kv k=\"boundary\" v=\"national_park\"/>",
      "<has-kv k=\"boundary\" v=\"protected_area\"/>",
      "<has-kv k=\"leisure\" v=\"nature_reserve\"/>");

      // suppression des zones protégées de notre base
      $pdo->query("DELETE FROM polygones WHERE id_polygone_type=12;");
      $i=0;
foreach ($conditions as $condition)
{
  foreach ($bboxes as $bbox)
  {
    $i++;
    $a_remplacer=array("##sud##" ,"##nord##" ,
    "##est##" ,"##ouest##" ,
    "##conditions_osm##"
    );
    $remplacement=array($bbox->sud, $bbox->nord,
			$bbox->est, $bbox->ouest,
			$condition
			);
    $xml_query=str_replace($a_remplacer,$remplacement,$overpass_query_template);
    //print($xml_query);
    print("Téléchargement de $condition sur $bbox->nom_polygone...\n");
    $result=requete_overpass_api($xml_query);
    
    file_put_contents("$dossier_temporaire/tmp.osm",$result);

    //************************ récupération des réserves naturelles et parc nationnaux
    // hélas un peu obligé de faire appel à ce binaire.
    passthru("osm2pgsql -c $params -C 100 -s -S ./default.style -p $prefix -G -l $dossier_temporaire/tmp.osm");
    $first_time=false;
    unlink("$dossier_temporaire/tmp.osm");
    // copy de celles importées par osm2pgsql
    $pdo->query("INSERT INTO polygones 
			(id_polygone_type,message_information_polygone,url_exterieure,nom_polygone,source,geom) 
			  SELECT 12,CONCAT(\"description:restrictions\",\"description:restrictions2\"),\"url:restrictions\",name,'openstreetmap et contributeurs',ST_Multi(way) 
			FROM ".$prefix."_polygon 
			where 
			name is not null
			and
			(
			boundary='national_park' 
			or (boundary='protected_area' and (protect_class in ('1','2','4','5') or protect_id in ('1','2','4','5')))
			or (leisure='nature_reserve')
			)
			;");
  }
  reset($bboxes);
}
// Traitements post import
//delete from polygones where id_polygone_type=12 and id_polygone not in (SELECT min(id_polygone) FROM polygones where id_polygone_type=12 GROUP BY nom_polygone);
//************************ Import des réserves et parcs nationnaux

// suppression des tables "temporaires" de osm2pgsql
foreach (array('_line','_roads','_rels','_nodes','_ways','_polygon','_point') as $table)
	$query_post_import[]="DROP table $prefix$table;";

// On execture la pile de fonction qui ne retournent de toute façon rien
foreach ($query_post_import as $query)
  $pdo->query($query);

?>