<?php
/**********************************************************************************************
Fonctions de gestion des polygones de notre base.
liens vers eux, récupération, calculs de bbox, pré-calcul spatial
gestion : modification/suppression/création
06/11/10 Dominique bornes_polygone
13/03/13 jmb PDO chamboulement PDO+ pour ajout et PDO-
**********************************************************************************************/

require_once ('config.php');
require_once ("fonctions_bdd.php");
require_once ('fonctions_mise_en_forme_texte.php');

/***********************************************************************************
Cette fonction permet d'aller chercher un ou plusieurs polygones
$conditions->ids_polygones = 5 ou 4,7,8
$conditions->avec_geometrie=gml/kml/svg/text/... (ou not set si on la veut pas)
   FIXME : un code spécial "gmlol" va bidouiller car notre version de OL ne peut gérer les multipolygones
   La valeur choisie c'est le st_as$valeur de postgis voir : http://postgis.org/docs/reference.html#Geometry_Outputs
   la géométrie retournée sera sous $retour->geometrie_<paramètre en entrée> comme : $retour->geometrie_gmlol
$conditions->limite = 5 (un entier donnant le nombre max de polygones retournés)
$conditions->bbox (au format OL : -3.8,39.22,13.77,48.68 soit : ouest,sud,est,nord
$conditions->id_polygone_type = 7 (un entier, l'id de type de polygone)

Retour :
Array
(
    [0] => stdClass Object
        (
            [site_web] =>   --> une URL pointant sur des infos concernant le polygone
            [url_exterieure] => --> une URL pointant sur des infos concernant les restrictions liées à la présence dans ce polygone
            [message_information_polygone] => --> texte indiquant les restrictions liées à la présence dans ce polygone
            [source] => --> si provenance extérieure
            [nom_polygone] => Chartreuse
            [article_partitif] => de la
            [id_polygone_type] => 1
            [id_polygone] => 2
            [geometrie_gml] => <gml:MultiPolygon srsName="EPSG:4326"><gml:polygonMember><gml:Polygon><gml:outerBoundaryIs><gml:LinearRing><gml:coordinates>5.72,45.18 5.92,45.289999999999999 6.04,45.479999999999997 5.88,45.579999999999998 5.77,45.420000000000002 5.75,45.380000000000003 5.7,45.390000000000001 5.6,45.32 5.72,45.18</gml:coordinates></gml:LinearRing></gml:outerBoundaryIs></gml:Polygon></gml:polygonMember></gml:MultiPolygon>
            [nord] => 47.1 --> La latitude du point le plus au nord du polygone
            [ouest] => 2
            [est] => 6
            [sud] => 45
            [bbox] => 2,45,6,47.1 --> une variante groupant ceux d'avant pour un accès plus rapide
        )
    [1] etc.
)
******************************************************************/
function infos_polygones($conditions)
{
  global $pdo,$config;
  $conditions_sql="";
  
  // Conditions sur les ids des polygones
  if (isset($conditions->ids_polygones))
    if (!verifi_multiple_intiers($conditions->ids_polygones))
      return erreur("Le paramètre donnée pour les ids n'est pas valide : $conditions->ids_polygones");
  else
    $conditions_sql.=" AND id_polygone in ($conditions->ids_polygones)";
  
  if (is_numeric($conditions->limite))
    $limite="LIMIT $conditions->limite";

  if (is_numeric($conditions->id_polygone_type))
    $conditions_sql.=" AND polygone_type.id_polygone_type = $conditions->id_polygone_type";
  
  // Ne prenons que les polygones qui intersectent une bbox
  if (isset($conditions->bbox))
  {
    $bbox=explode(",",$conditions->bbox);
    $conditions_sql.=" AND geom && 
    ST_GeomFromText(('LINESTRING($bbox[0] $bbox[1],$bbox[2] $bbox[3])'),4326)";
  }
  
  // Récupération ou non de la géométrie du polygone (un peu l'usine, mais récupérer 30000 points en trop alors qu'on veut
  // juste le nom c'est dommage
  $champs="";
  $colonnes=colonnes_table('polygones');
  foreach ($colonnes as $colonne)
    if ($colonne->column_name!='geom')
      $champs.="polygones.$colonne->column_name,";
  $champs=trim($champs,",");
  
  if ($conditions->avec_geometrie)
  {
    // FIXME : notre OL ne sait pas gérer les multipolygon, on bidouille en ne prenant que le 1
    if ($conditions->avec_geometrie="gmlol")
    $champs_geometry.=",st_asGML(st_geometryn(geom,1)) as geometrie_gmlol";
    else
      $champs_geometry.=",st_as$conditions->avec_geometrie(geom) as geometrie_$conditions->avec_geometrie";
  }
  else
    $champs_geometry.="";

  $box="ST_box2d(geom)";
  $query="SELECT polygone_type.type_polygone,
                 polygone_type.categorie_polygone_type,
                 st_xmin($box) as ouest,
                 st_xmax($box) as est,
                 st_ymin($box) as sud,
                 st_ymax($box) as nord,
                 $champs
                 $champs_geometry
          FROM polygones,polygone_type
          WHERE 
            polygones.id_polygone_type=polygone_type.id_polygone_type
            $conditions_sql
          $limite
  ";
  $res=$pdo->query($query);
  if (!$res)
    return erreur("Requête impossible",$query);
  while ($polygone=$res->fetch())
  {
    $polygone->bbox="$polygone->ouest,$polygone->sud,$polygone->est,$polygone->nord";
    $polygones[]=$polygone;
  }
  return $polygones;
}
/***********************************************************************************
Cette fonction permet d'aller chercher toutes les infos d'un polygone
Retour :
stdClass Object
(
  [site_web] => 
  [url_exterieure] => 
  [message_information_polygone] => 
  [source] => 
  [nom_polygone] => Chartreuse
  [article_partitif] => de la
  [id_polygone_type] => 1
  [id_polygone] => 2
  [geometrie_gml] => <gml:MultiPolygon srsName="EPSG:4326"><gml:polygonMember><gml:Polygon><gml:outerBoundaryIs><gml:LinearRing><gml:coordinates>5.72,45.18 5.92,45.289999999999999 6.04,45.479999999999997 5.88,45.579999999999998 5.77,45.420000000000002 5.75,45.380000000000003 5.7,45.390000000000001 5.6,45.32 5.72,45.18</gml:coordinates></gml:LinearRing></gml:outerBoundaryIs></gml:Polygon></gml:polygonMember></gml:MultiPolygon>
  [nord] => 47.1
  [ouest] => 2
  [est] => 6
  [sud] => 45
  [bbox] => 2,45,6,47.1
)
Si $avec_geometrie vaut gml/kml/svg/text/...  (voir fonction avant) la géométrie est retournée. Ce n'est pas systématique pour des raisons de performances
************************************************************************************/
function infos_polygone($id_polygone,$avec_geometrie=False)
{
  $conditions = new stdClass;
  $conditions->ids_polygones=$id_polygone;
  if (!$avec_geometrie)
    $conditions->avec_geometrie=$avec_geometrie;
  $poly=infos_polygones($conditions);
  return $poly[0];
}


/********************************************
On génére une url vers la carte d'un polygone
si local est False un lien absolu sera généré
*********************************************/
function lien_polygone($polygone,$local=True)
{
  global $config;
  if (!isset($polygone->type_polygone))
    $type_polygone="massif";
  else
    $type_polygone=$polygone->type_polygone;
  if ($local)
    $url_complete="";
  else
    $url_complete="http://".$config['nom_hote'];
 
return "$url_complete/nav/$polygone->id_polygone/".replace_url($type_polygone)."/".replace_url($polygone->nom_polygone)."/";
}


/*************************************************
Ces fonctions s'occupent de supprimer un polygone de la base
FIXME : ne sert actuellement nulle part
*************************************************/

//suppression juste du polygone
function suppression_polygone($id_polygone)
{
	global $pdo;
	if (!is_numeric($id_polygone))
		return -1;
	$query="DELETE FROM polygones WHERE id_polygone=$id_polygone";
	$pdo->exec($query) or die('pb lors suppr polygone '.$id_polygone) ;
	return 0;
}

?>
