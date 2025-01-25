<?php
/*
Ne marchera que à la ligne de commande (à cause du timeout php)

Script d'importation des données osm "qui nous intéressent"
polygones : réserves naturelles, pays, département
points : hôtels, campings, chambres d'hôtes

Principe : la base OSM, c'est ENORME : ~350Go en 1 seul fichier xml, donc aucune chance de faire comme ça, il faut donc ne faire des récupérations
que partielles car seule une très faible part des données osm nous intéressent, la solution : interroger le service Overpass :
http://wiki.openstreetmap.org/wiki/Overpass_API uniquement sur les "zones qui nous intéressent" et uniquement pour les types de données qui nous intéressent

Le "qui nous intéresse" est donné ainsi : on va créer un polygone bidon qui englobe tout ce qui nous intéresse, genre espagne/france/suisse/italie

Ensuite, on spécifie manuellement l'id de ce polygone dans la reqûete where ci après, le truc se débrouille ensuite tout seul pour récupérer ce qui est dans la même bbox

Toutes les opérations longues ou critique sont débutée par un if (false) {
de sorte que si on le lance, rien ne se passe, juste un "dry run", ensuite, on passe à true chaque opération que l'on veut réaliser vraiment

FIXME: question à se poser : ce truc est relativement indépendant de wri, dois-je l'inclure dans les modeles ? sachant que ça ne s'appel pas par le web de toute façon ?
*/
require_once("../../includes/config.php");
require_once("bdd.php");
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
  global $config_wri;

  $ch = curl_init('https://overpass-api.de/api/interpreter');
  
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "data=".$xml_query);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $reponse = curl_exec($ch);
  curl_close($ch);
  return $reponse;
}


$dossier_temporaire="./tmp";

// Récupération des bbox des zones
$box="box2d(geom)";
// FIXME : exclusion manuelle des zones trop grosses
$query_bbox_zone="select nom_polygone,
                     st_xmin($box) as ouest,
                     st_xmax($box) as est,
                     st_ymin($box) as sud,
                     st_ymax($box) as nord
                     from polygones 
                   where 
                       id_polygone in (9989)
                     and 
                       geom is not null limit 20;";
$res=$pdo->query($query_bbox_zone) or die($query_bbox_zone);
while ($bbox=$res->fetch())
  $bboxes[]=$bbox;

$prefix="osm_temporaire";
$params="-d ".$config_wri['base_pgsql']." -H ".$config_wri['serveur_pgsql']." -U ".$config_wri['utilisateur_pgsql']."";

// osm2pgsql n'accepte pas le mot de passe en paramètre, mais dans une variable d'environnement
putenv("PGPASSWORD=".$config_wri['mot_de_passe_pgsql']);

// L'index et l'id_polygone_type dans notre base, les éléments d'après sont les critères OSM qui correspondent à nos types de polygones
//$conditions[12][]="<has-kv k=\"boundary\" v=\"national_park\"/>"; // parc nationnaux
//$conditions[12][]="<has-kv k=\"boundary\" v=\"protected_area\"/>"; // zone de protections variées
//$conditions[12][]="<has-kv k=\"leisure\" v=\"nature_reserve\"/>"; // réserves naturelles
//$conditions_sql[12]="(
//                        boundary='national_park' 
//                        or (boundary='protected_area' and (protect_class in ('1','2','4') or protect_id in ('1','2','4')))
//                        or (leisure='nature_reserve')
//                        )";
//$conditions[10][]="<has-kv k=\"boundary\" v=\"administrative\"/><has-kv k=\"admin_level\" v=\"6\"/>"; // département ou équivalent
//$conditions_sql[10]="(boundary='administrative' and admin_level='6')";
$conditions[17][]="<has-kv k=\"boundary\" v=\"administrative\"/><has-kv k=\"admin_level\" v=\"4\"/>"; // région ou équivalent
$conditions_sql[17]="(boundary='administrative' and admin_level='4')";
//$conditions[6][]="<has-kv k=\"boundary\" v=\"administrative\"/><has-kv k=\"admin_level\" v=\"2\"/>"; // Pays
//$conditions_sql[6]="(boundary='administrative' and admin_level='2')";


foreach ($conditions as $id_polygone_type => $criteres_osm)
{
  // Si on commente, ça fait tout de chez tout, mais ça peut être long
  // selon le type que l'on veut importer (des fois, tout n'est pas à refaire) on peut laisser ce if
  if ($id_polygone_type == 17 ) 
  {
    // suppression des zones protégées de notre base
    $pdo->query("DELETE FROM polygones WHERE id_polygone_type=$id_polygone_type;");
    foreach ($criteres_osm as $condition)
    {
      foreach ($bboxes as $bbox)
      {
      $a_remplacer=array("##sud##" ,"##nord##" ,
      "##est##" ,"##ouest##" ,
      "##conditions_osm##");
      $remplacement=array($bbox->sud, $bbox->nord,
                          $bbox->est, $bbox->ouest,
                          $condition);
                          
      $xml_query=str_replace($a_remplacer,$remplacement,$overpass_query_template);
      print($xml_query);
      print("Téléchargement de $condition sur $bbox->nom_polygone...\n");
      
      if (false) //******** ICI on déclenche l'appel OverPass
      {
        $result=requete_overpass_api($xml_query);
        file_put_contents("$dossier_temporaire/tmp.osm",$result);
      }
      
      
      $command="osm2pgsql -c $params -C 100 -s -S ./default.style -p $prefix -G -l $dossier_temporaire/tmp.osm";
      print ($command);
      
      if (false) //******** ICI on déclenche l'import osm2pgsql
      {
        passthru($command);
      }
      
      if (false) //******** ICI on efface le fichier téléchargé
      {
        unlink("$dossier_temporaire/tmp.osm");
      }
      // copy de celles importées par osm2pgsql
      
      if (false) //******** ICI on insère tous les polygones du id_type_polygone choisi
      {
        $query="INSERT INTO polygones 
                          (id_polygone_type,message_information_polygone,url_exterieure,site_web,nom_polygone,source,geom) 
                            SELECT $id_polygone_type,CONCAT(\"description:restrictions\",\"description:restrictions2\"),\"description:restrictions3\"),\"website:regulation\",website,name,'openstreetmap et contributeurs',ST_Multi(way) 
                          FROM ".$prefix."_polygon 
                          where 
                          name is not null
                          and
                          $conditions_sql[$id_polygone_type]
                          ;";
        $pdo->query($query) or die($query);
      }
      }
      reset($bboxes);
    }
    // Traitements post import des doublons que notre procédure créé en trop (liée à la superposition de nos zones)
    if (false) //******** ICI on enlève des doublons ? 
    {
      $query="delete from polygones 
                  where 
                    id_polygone_type=$id_polygone_type 
                  and 
                    id_polygone not in 
                      (SELECT min(id_polygone) 
                      FROM 
                        polygones 
                      where 
                        id_polygone_type=$id_polygone_type 
                      GROUP BY nom_polygone
                      );";
        $pdo->query($query) or die($query);
     }
  }
}
// suppression des tables "temporaires" de osm2pgsql qui reste du tout dernier import
if (false) //******** ICI on vire les tables osm2pgsql
{
  foreach (array('_line','_roads','_rels','_nodes','_ways','_polygon','_point') as $table)
  $query_post_import[]="DROP table $prefix$table;";

  // On execture la pile de fonction qui ne retournent de toute façon rien
  foreach ($query_post_import as $query)
    $pdo->query($query);
}
?>
