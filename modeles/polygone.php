<?php
/**********************************************************************************************
Fonctions de gestion des polygones de notre base.
liens vers eux, récupération, calculs de bbox, pré-calcul spatial
gestion : modification/suppression/création
06/11/10 Dominique bornes_polygone
13/03/13 jmb PDO chamboulement PDO+ pour ajout et PDO-
**********************************************************************************************/

require_once ("config.php");
require_once ("bdd.php");
require_once ('mise_en_forme_texte.php');

/***********************************************************************************
Cette fonction permet d'aller chercher un ou plusieurs polygones
$conditions->ids_polygones = 5 ou 4,7,8 -> récupère le/les polygones dont l'id est cette liste
$conditions->non_ids_polygones = 5 ou 4,7,8 -> récupère le/les polygones dont l'id n'est pas dans cette liste
$conditions->avec_geometrie=gml/kml/svg/text/... (ou not set si on la veut pas)
   La valeur choisie c'est le st_as$valeur de postgis voir : http://postgis.org/docs/reference.html#Geometry_Outputs
   la géométrie retournée sera sous $retour->geometrie_<paramètre en entrée> comme : $retour->geometrie_gml
$conditions->intersection = id_poly -> Sélectionne tous les polynomes ayant une intersection avec le polynome id_poly
$conditions->limite = 5 (un entier donnant le nombre max de polygones retournés)
$conditions->bbox (au format OL : -3.8,39.22,13.77,48.68 soit : ouest,sud,est,nord
$conditions->ids_polygone_type = 7 ou 7,8 (les ids de type de polygone)
$conditions->avec_zone_parente=True : renvoi la zone dans laquelle se trouve le polygone (par défaut False)
//FIXME jmb : BBOX ne veut plus rien dire a l'heure du GIS. BBOX + nord/sud/est/ouest ca redonde un peu.
// jmb: ajout du champ "nom_zone" (id plutot?)
//jmb: ajout de condition Ordre, comme infos_points

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
      [id_zone] => 351  // 351 est le poly des Alpes (je crois)
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
    global $config_wri,$pdo;
    $conditions_sql="";
    $champs_en_plus="";
    $table_en_plus="";

    // Conditions sur les ids des polygones
    if (isset($conditions->ids_polygones))
        if (!verif_multiples_entiers($conditions->ids_polygones))
            return erreur("Le paramètre donnée pour les ids n'est pas valide : $conditions->ids_polygones");
        else
            $conditions_sql.=" AND id_polygone IN ($conditions->ids_polygones)";

        // Conditions sur les ids des polygones (qui ne sont pas ceux donnés)
    if (isset($conditions->non_ids_polygones))
        if (!verif_multiples_entiers($conditions->non_ids_polygones))
            return erreur("Le paramètre donnée pour les ids qui ne doivent pas y être n'est pas valide : $conditions->non_ids_polygones");
        else
            $conditions_sql.=" AND id_polygone NOT IN ($conditions->non_ids_polygones)";

    if (is_numeric($conditions->limite))
        $limite="LIMIT $conditions->limite";

    if (!empty($conditions->ordre))
        $ordre_champ="$conditions->ordre";
    else
        $ordre_champ="nom_polygone ASC";
    $ordre="ORDER BY $ordre_champ";

    if (isset($conditions->ids_polygone_type))
        if (!verif_multiples_entiers($conditions->ids_polygone_type))
            return erreur("Le paramètre donnée pour les type de polygones n'est pas valide : $conditions->ids_polygone_type");
        else
            $conditions_sql.=" AND polygone_type.id_polygone_type IN ($conditions->ids_polygone_type)";

    // Ne prenons que les polygones qui intersectent une geometrie (etait: une bbox)
    if (isset($conditions->geometrie))
        $conditions_sql.=" AND ST_Intersects(polygones.geom, {$conditions->geometrie})";

    if ($conditions->avec_geometrie)
        $champs_en_plus.=",st_as$conditions->avec_geometrie(polygones.geom,5) AS geometrie_$conditions->avec_geometrie";

    if ($conditions->intersection) {
        $table_en_plus.=",polygones AS zones ";
        $conditions_sql.=" AND ST_INTERSECTS(polygones.geom, zones.geom) AND zones.id_polygone = ". $conditions->intersection ;
  }
    // jmb: nom de la zone auquel le poly appartient.
    // jmb: le nom aussi si ca peut eviter un appel de plue.
    // jmb: tout ca est crado. mais c'est 1000x plus rapide.
    // sly: faire que cette requête un peu plus lourde ne soit pas systématiquement utilisée, sauf demande
    if ($conditions->avec_zone_parente)
        $champs_en_plus.=",
        (
          SELECT id_polygone
          FROM polygones AS zones
          WHERE
            zones.id_polygone_type=".$config_wri['id_zone']."
            AND
            ST_INTERSECTS(polygones.geom, zones.geom) LIMIT 1
        ) AS id_zone ,
        (
          SELECT nom_polygone
          FROM polygones AS zones
          WHERE
            zones.id_polygone_type=".$config_wri['id_zone']."
            AND
            ST_INTERSECTS(polygones.geom, zones.geom) LIMIT 1
        ) AS nom_zone
        ";

  //FIXME jmb: a voir pour transformer cette combine de bbox en GIS un jour.
  $box="box2d(polygones.geom)";
  $query="SELECT polygone_type.type_polygone,
                 polygone_type.categorie_polygone_type,
                 st_xmin($box) AS ouest,
                 st_xmax($box) AS est,
                 st_ymin($box) AS sud,
                 st_ymax($box) AS nord,
                 ".colonnes_table('polygones',False)."
                 $champs_en_plus
          FROM polygones,polygone_type $table_en_plus
          WHERE
            polygones.id_polygone_type=polygone_type.id_polygone_type
            $conditions_sql
          $ordre
          $limite
  ";
  $res=$pdo->query($query);
  if (!$res)
    return erreur("Requête impossible",$query);
  while ($polygone=$res->fetch())
  {
    if ($polygone->ouest && $polygone->sud && $polygone->est && $polygone->nord)
        $polygone->bbox="$polygone->ouest,$polygone->sud,$polygone->est,$polygone->nord";
    else
        $polygone->bbox="-5,42,8,51";
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
function infos_polygone($id_polygone,$avec_geometrie="aucune")
{
  $conditions = new stdClass;
  $conditions->ids_polygones=$id_polygone;
  if ($avec_geometrie!="aucune")
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
  global $config_wri;
  if (isset($_SERVER['HTTPS']))
      $schema="https";
  else
      $schema="http";
  
  if (!isset($polygone->type_polygone))
    $type_polygone="massif";
  else
    $type_polygone=$polygone->type_polygone;
  if ($local)
    $url_complete="";
  else
    $url_complete="$schema://".$config_wri['nom_hote'];

return $url_complete.$config_wri['sous_dossier_installation']."nav/$polygone->id_polygone/".replace_url($type_polygone)."/".replace_url($polygone->nom_polygone)."/";
}

/********************************************
Récupère les soumissions du formulaire de
modification de paramètres de massifs
*********************************************/
function edit_info_polygone()
{
    global $pdo;
    if (!$_SESSION['niveau_moderation'])
        return null;

    // On échappe les simples quotes
    $article_partitif = str_replace ("'", "''", $_POST ['article_partitif']);
    $nom_polygone     = str_replace ("'", "''", $_POST ['nom_polygone']);

    if (isset ($_POST ['nom_polygone']) && strlen ($nom_polygone) == 0) {
        echo 'Nom de massif vide';
        exit;
    }

    if (strlen ($article_partitif) > 20) {
        echo 'Article partitif trop long (max = 20 caractères): '.$article_partitif;
        exit;
    }

    if ($_POST['enregistrer'] && $_POST['id_polygone'])
    {
        $query_update = "UPDATE polygones SET "
      ."article_partitif	= '$article_partitif', "
      ."nom_polygone = '$nom_polygone', "
      ."geom = ST_SetSRID(ST_GeomFromGeoJSON('{$_POST['json_polygones']}'), 4326) "
      ."WHERE id_polygone = {$_POST['id_polygone']}";
        $res = $pdo->query($query_update);
        if (!$res)
            erreur('Requête impossible',$query_update);
    }

  // Création
    if ($_POST['enregistrer'] && $_POST['id_polygone'] == 0)
    {
        // On commence par chercher s'il existe déjà un polygone homonyme
        $query_no = "SELECT id_polygone FROM polygones WHERE nom_polygone = '$nom_polygone'";
        $res=$pdo->query($query_no);
        if (!$res)
            erreur('Requête impossible',$query_no);

        if (!$new_poly=$res->fetch())
        {
            // Alors, on le crée
            $query_cree = "INSERT INTO polygones (id_polygone_type, article_partitif, nom_polygone, geom) ".
        "VALUES (1, '$article_partitif', '$nom_polygone', ST_SetSRID(ST_GeomFromGeoJSON('{$_POST['json_polygones']}'), 4326))";
            $res=$pdo->query($query_cree);
            if (!$res)
                erreur('Requête impossible',$query_cree);

            // Maintenant, on rècupère le n° du polygone créé
            $res=$pdo->query($query_no);
            if (!$res)
                erreur('Requête impossible',$query_no);
            else
                $new_poly=$res->fetch();
        }
        // Et donc, on va voir ce polygone
        return $new_poly->id_polygone;
    }

    if ($_POST['supprimer'])
    {
        $query_delate = "DELETE FROM polygones WHERE id_polygone = {$_POST['id_polygone']}";
        $res = $pdo->query($query_delate);
        if (!$res)
            erreur('Requête impossible',$query_delate);
    }
    return null;
}

/********************************************
Cree un objet geometrie a utiliser dans le SQL PostGIS

Par exemple, cree un Polygone avec une bbox ou un massif, cree un cercle avec un point et un rayon.

$params  contient les coordonnées
$type est le type de geometrie a creer : "cercle", "polygone", "bboxOL" (FIXME pleonasme: une bbox c'est un polygone)

Elle renvoie une chaine de texte a utiliser en SQL, par exemple:
WHERE Within(geom, cree_geometrie(...)  )
*********************************************/
function cree_geometrie( $params , $type )
{
  switch ($type) {

    case 'bboxOL':
      //bbox OL: ouest,sud,est,nord
      // mise en forme avec des points, des vrais
      list($ouest,$sud,$est,$nord) = explode(",",$params);
      $geotexte = "ST_SetSRID(ST_MakeBox2D(ST_Point($ouest, $sud), ST_Point($est ,$nord)),4326)";
      break;

    case 'polygone':
      //FIXME check les params: [0]->lat, [0]->lon , [1].....
      $geotexte = "FIXME";
      break;

    case 'cercle':
      //FIXME check les params: lat, lon, et rayon
      $lat = $params['lat'];
      $lon = $params['lon'];
      $rayon = $params['rayon'] ;
      // au depart on a du 4326 en degres. Transform vers 900913 en metres. application du Buffer en metres. Retransformation en 4326.
      // Vu qu'on parle en metres et pas en degrés, c'est necessaire.
      $geotexte = "ST_Transform(ST_Buffer(ST_Transform(ST_GeomFromText('POINT($lon $lat)',4326),900913),$rayon),4326)";
      break;

    default:
      $geotexte = "mauvais type de geometrie";
  }
  return $geotexte ;
}

?>
