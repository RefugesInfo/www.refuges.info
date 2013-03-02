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
   La valeur choisie c'est le st_as$valeur de postgis voir : http://postgis.org/docs/reference.html#Geometry_Outputs
$conditions->limite = 5 (un entier donnant le nombre max de polygones retournés)
$conditions->bbox (au format OL : -3.8,39.22,13.77,48.68 soit : ouest,sud,est,nord
$conditions->id_polygone_type = 7 (un entier, l'id de type de polygone)
$conditions->avec_bbox_geometrie=True; -> renvoi un champ bbox contenant chaque polygone au format "ouest,sud,est,nord"

Retour :
Array
(
    [0] => stdClass Object
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
        )

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
  
  $champs_geometry="";
  if ($conditions->avec_bbox_geometrie)
  {
    $box="ST_box2d(geom)";
    $champs_geometry.=",st_xmin($box) as ouest,
                     st_xmax($box) as est,
                     st_ymin($box) as sud,
                     st_ymax($box) as nord";
  }
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
    $champs_geometry.=",st_as$conditions->avec_geometrie(geom) as geometrie_$conditions->avec_geometrie";
  else
    $champs_geometry.="";

    
  $query="SELECT polygone_type.type_polygone,polygone_type.categorie_polygone_type,$champs$champs_geometry
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
    if ($conditions->avec_bbox_geometrie)
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
)
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


/**************************************************
Donne un tableau de massifs non compris dans la zone
//PDO+GIS jmb cette fonction est fait pour le GIS
// TODO: que les zones soient des polygones ...
// fonction a virer vu que c'est des ZONES qu'on veut et pas des MASSIFS (voir en dessous)
*************************************************/
function liste_autres_massifs ($zone_demandee) {
	global $config, $zones, $zone, $pdo;

	
	// Lecture de tous les massifs
	// dont les polygones n'intersectent PAS celui de la zone
	$q_select_mass= "
		SELECT id_polygone,id_polygone_type,article_partitif,nom_polygone,source,message_information_polygone,url_exterieure
		FROM polygones
		WHERE id_polygone_type=".$config['id_massif']."
			AND id_polygone != ".$config['numero_polygone_fictif']."
			AND Disjoint(
				gis,
				(SELECT gis FROM polygones WHERE nom_polygone =  \"" .$zone_demandee."\"  )
				)
	";

	// On envoie la requete
	$r_select_mass = $pdo->query($q_select_mass);
	// Traitement
	// Ajoute les liens vers les massifs qui ne sont pas dans une zone
	// bug en cours mais la resolution passe par des polygones, pas par du PHP.
	while ($polygone = $r_select_mass->fetch()) 
		$r[$polygone->nom_polygone] = lien_polygone ($polygone);
	
	//tableau de tous les massif n'etant pas dans la zone (polygones normalement...)
	return $r;
}
/**************************************************
Donne un tableau de ZONES hormis celle donnée en param
// TODO: que les zones soient des polygones ...
*************************************************/
function liste_autres_zones ($zone_demandee) {
	global $config, $zones, $zone, $pdo;

	//si pas de param, c'est qu'on veut les alpes de chez nous
	if ( !$zone_demandee)
		$zone_demandee = $config['zone_defaut'];
	// faut arreter, ... , les zones c'est un ID eet c'est tout
	$q_select_zone=" SELECT * FROM polygones WHERE id_polygone_type=".$config['id_zone']." AND nom_polygone !=  '$zone_demandee'" ;
	// On envoie la requete
	try {
		$r_select_zone = $pdo->query($q_select_zone);
	} catch( Exception $e ){
		echo 'Erreur de requete liste_autres_zones : ', $e->getMessage();
	}

	// Traitement
	// Ajoute les liens vers les massifs qui ne sont pas dans une zone
	// bug en cours mais la resolution passe par des polygones, pas par du PHP.
	while ($polygone = $r_select_zone->fetch()) 
		$z[$polygone->nom_polygone] = lien_polygone ($polygone->nom_polygone);

	//tableau de tous les ZONES autre que la notre
	return $z;
}

/*************************************************
Ces fonctions s'occupent de supprimer un polygone de la base
C'est à utiliser avec forte méfiance car des id de liaison
entre les points de la base et ce polygone peuvent exister, un recalcul 
des points qui appartiennent à un polygone devra être refait

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

/*****************************************************
LISTE POLYGONES DANS POLYGONE
INPUT id_polygone du parent
INPUT type_polygone de(s) fils recherchés ( ou tous )
OUTPUT tableau de pointeurs de id_polygones, avec WKT
***  jmb    **********************************************/
//utile pour les zones qui contiennent des massifs
function liste_polys_dans_poly( $idpere, $typefils = NULL )
{
	global $pdo;
	$q = " SELECT id_polygone, id_polygone_type, article_partitif, nom_polygone, source, message_information_polygone, url_exterieure, AsWKT(gis) AS gis_wkt
			FROM polygones AS fils
			WHERE Intersects(
								(SELECT gis FROM polygones WHERE id_polygone=$idpere),
								fils.gis
							)
			";
	if (is_numeric( $typefils ) )
		$q .= "AND fils.id_polygone_type = $typefils";

	$res = $pdo->query($q) ;
	while( $fils[] = $res->fetch() ) ;

	return $fils ;
}

?>
