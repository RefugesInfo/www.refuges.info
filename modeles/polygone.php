<?php
/**********************************************************************************************
Fonctions de gestion des polygones de notre base.
liens vers eux, récupération, calculs de bbox, pré-calcul spatial
gestion : modification/suppression/création
06/11/10 Dominique bornes_polygone
13/03/13 jmb PDO chamboulement PDO+ pour ajout et PDO-
**********************************************************************************************/

require_once ("bdd.php");
require_once ('mise_en_forme_texte.php');
require_once ("historique.php");

/***********************************************************************************
Cette fonction permet d'aller chercher un ou plusieurs polygones
$conditions->ids_polygones = 5 ou 4,7,8 -> récupère le/les polygones dont l'id est cette liste
$conditions->non_ids_polygones = 5 ou 4,7,8 -> récupère le/les polygones dont l'id n'est pas dans cette liste
$conditions->avec_geometrie=gml/kml/svg/text/... (ou not set si on la veut pas)
  La valeur choisie c'est le st_as$valeur de postgis voir : http://postgis.org/docs/reference.html#Geometry_Outputs
  la géométrie retournée sera sous $retour->geometrie_<paramètre en entrée> comme : $retour->geometrie_gml
$conditions->avec_enveloppe = True -> retourne 4 propriété ouest, est, sud et nord qui sont pour chaque polygones les bornes extrèmes (par défaut à False)
$conditions->intersection = id_poly -> Sélectionne tous les polygones ayant une intersection avec le polygone id_poly
$conditions->limite = 5 (un entier donnant le nombre max de polygones retournés)
$conditions->bbox (au format OL : -3.8,39.22,13.77,48.68 soit : ouest,sud,est,nord
$conditions->ids_polygone_type = 7 ou 7,8 (les ids de type de polygone)
$conditions->avec_zone_parente=True : renvoi la zone dans laquelle se trouve le polygone (par défaut False)
//FIXME jmb : BBOX ne veut plus rien dire a l'heure du GIS. BBOX + nord/sud/est/ouest ca redonde un peu.
// jmb: ajout du champ "nom_zone" (id plutot?)
//jmb: ajout de condition Ordre, comme infos_points

Retour :
[
  0 => stdClass Object
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
]
******************************************************************/
function infos_polygones($conditions)
{
  global $config_wri,$pdo;
  $conditions_sql=$champs_en_plus=$table_en_plus=$limite="";

  // Conditions sur les ids des polygones
  if (!empty($conditions->ids_polygones))
    if (!verif_multiples_entiers($conditions->ids_polygones))
      return erreur("le paramètre donné pour les ids de polygone est/sont invalide.s : $conditions->ids_polygones");
    else
      $conditions_sql.=" AND id_polygone IN ($conditions->ids_polygones)";

    // Conditions sur les ids des polygones (qui ne sont pas ceux donnés)
  if (!empty($conditions->non_ids_polygones))
    if (!verif_multiples_entiers($conditions->non_ids_polygones))
      return erreur("Le paramètre donnée pour les ids qui ne doivent pas y être n'est pas valide : $conditions->non_ids_polygones");
    else
      $conditions_sql.=" AND id_polygone NOT IN ($conditions->non_ids_polygones)";

  if (!empty($conditions->limite) and is_numeric($conditions->limite))
    $limite="LIMIT $conditions->limite";

  if (!empty($conditions->ordre))
    $ordre_champ="$conditions->ordre";
  else
    $ordre_champ="nom_polygone ASC";

  $ordre="ORDER BY $ordre_champ";

  if (!empty($conditions->ids_polygone_type))
    if (!verif_multiples_entiers($conditions->ids_polygone_type))
      return erreur("Le paramètre donnée pour les type de polygones n'est pas valide : $conditions->ids_polygone_type");
    else
      $conditions_sql.=" AND polygone_type.id_polygone_type IN ($conditions->ids_polygone_type)";

  // Ne prenons que les polygones qui intersectent une geometrie (etait: une bbox)
  if (!empty($conditions->geometrie))
    $conditions_sql.=" AND ST_Intersects(polygones.geom, {$conditions->geometrie})";

  if (!empty($conditions->avec_geometrie))
    $champs_en_plus.=",st_as$conditions->avec_geometrie(polygones.geom,5) AS geometrie_$conditions->avec_geometrie";

  if (!empty($conditions->intersection))
  {
    $table_en_plus.=",polygones AS zones ";
    $conditions_sql.=" AND ST_INTERSECTS(polygones.geom, zones.geom) AND zones.id_polygone = ". $conditions->intersection ;
  }

  // jmb: nom de la zone auquel le poly appartient.
  // jmb: le nom aussi si ca peut eviter un appel de plue.
  // jmb: tout ca est crado. mais c'est 1000x plus rapide.
  // sly: faire que cette requête un peu plus lourde ne soit pas systématiquement utilisée, sauf demande
  // sly: 2020 quand un massif est dans une zone, mais en touche une autre (en bordure) ça sort au pif une zone, parfois celle juste touchée. Le AND NOT ST_TOUCHES gère ce cas
  if (!empty($conditions->avec_zone_parente))
  {
    $champs_en_plus.=",zones.nom_polygone as nom_zone,zones.id_polygone as id_zone";
    $table_en_plus.=" LEFT JOIN polygones zones on ST_INTERSECTS(polygones.geom, zones.geom) AND NOT ST_TOUCHES(polygones.geom, zones.geom) AND zones.id_polygone_type=".$config_wri['id_zone'];
  }
  if (!empty($conditions->avec_enveloppe)) // FIXME: y'aurait plus simple en demandant st_envelope à postgis ?
    $champs_en_plus.=",
      st_xmin(polygones.geom) AS ouest,
      st_xmax(polygones.geom) AS est,
      st_ymin(polygones.geom) AS sud,
      st_ymax(polygones.geom) AS nord
    ";
  if (!empty($conditions->avec_geom))
    $champs_en_plus.=",geom";

  $query="SELECT polygone_type.*,".$config_wri['champs_table_polygones']."
      $champs_en_plus
    FROM polygone_type,polygones$table_en_plus
    WHERE
      polygones.id_polygone_type=polygone_type.id_polygone_type
      $conditions_sql
    $ordre
    $limite
  ";
  //d($query);
  $res=$pdo->query($query);
  if (!$res)
    return erreur("Requête SQL en erreur (vous pouvez nous signaler le problème sur le forum)",$query);
  // On les met tous dans le tableau à retourner
  $polygones = $res->fetchall();
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
function infos_polygone($id_polygone,$avec_geometrie=False,$avec_enveloppe=False,$avec_geom=False)
{
  if (!est_entier_positif($id_polygone)) // Inutile d'aller plus loin
    return erreur("le paramètre donné pour l' id unique de polygone est invalide : $id_polygone");

  $conditions = new stdClass;
  $conditions->ids_polygones=$id_polygone;

  if ($avec_geometrie)
    $conditions->avec_geometrie=$avec_geometrie;

  if ($avec_enveloppe)
    $conditions->avec_enveloppe=True;

  if ($avec_geom)
    $conditions->avec_geom=True;

  $poly=infos_polygones($conditions);
  if (!empty($poly->erreur))
    return erreur($poly->message);

  if (count($poly)!=1)
    return erreur("Le polygone d'id $id_polygone n'existe pas dans notre base");

  // Protection contre les polygones vides
  if (isset($poly[0]) &&
    isset($poly[0]->ouest) && isset($poly[0]->sud) &&
    isset($poly[0]->est) && isset($poly[0]->nord))
    $poly[0]->extent = [$poly[0]->ouest, $poly[0]->sud, $poly[0]->est, $poly[0]->nord];

  return $poly[0];
}

/************************************************************************************/
function infos_type_polygone($id_polygone_type)
{
  global $pdo;
  if (!est_entier_positif($id_polygone_type))
    return erreur("Vous demandez un type de polygone avec un id incorrect :".$id_polygone_type);
  $query="SELECT *
    FROM polygone_type
    WHERE id_polygone_type=$id_polygone_type
  ";
  $res=$pdo->query($query);
  if (empty($infos_type_polygone=$res->fetch()))
    return erreur("Le type de polygone avec un id de $id_polygone_type est inexistant dans notre base");
  else
    return $infos_type_polygone;
}

/************************************************************************************/
function liste_type_polygone()
{
  global $pdo;
  $query="SELECT * FROM polygone_type order by id_polygone_type";
  $res=$pdo->query($query);
  $liste_type_polygone = $res->fetchall();

  if (empty($liste_type_polygone) )
    return erreur("Il y a un problème dans la base, il n'y a aucune catégorie de polygone : polygone_type vide !");
  else
    return $liste_type_polygone;
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

  return $url_complete."/nav/$polygone->id_polygone/".replace_url($type_polygone)."/".replace_url($polygone->nom_polygone)."/";
}

/********************************************
Récupère les soumissions du formulaire de
modification de paramètres de massifs
*********************************************/
function edit_info_polygone()
{
    global $pdo;

    // On échappe les simples quotes
    $article_partitif = str_replace ("'", "''", $_POST['article_partitif']??'');
    $nom_polygone     = str_replace ("'", "''", $_POST['nom_polygone']??'');

    if (isset ($_POST ['nom_polygone']) && strlen ($nom_polygone) == 0) {
        echo '<p style="color:red">NOM DE MASSIF VIDE</p>';
        echo '<p>Revenez en arrière pour continuer l\'édition</p>';
        exit;
    }

    if (strlen ($article_partitif) > 20) {
        echo 'Article partitif trop long (max = 20 caractères): '.$article_partitif;
        echo '<p>Revenez en arrière pour continuer l\'édition</p>';
        exit;
    }

  // Edition
  if (!empty($_POST['enregistrer']) &&
    !empty($_POST['id_polygone']) &&
    !empty($_POST['id_polygone_type']) &&
    !empty($_POST['json_polygones']))
  {
    if (!json_decode($_POST['json_polygones'])->coordinates)
    {
      echo '<p style="color:red">MASSIF OU ZONE NON MODIFIÉ(E) CAR NE COMPORTE PAS DE POLYGONE</p>';
      echo '<p>Revenez en arrière pour continuer l\'édition</p>';
      exit;
    }

    // Historisation de la modification dans la table des historique des points
    $polygone_avant = infos_polygone($_POST['id_polygone'],false,false,true); // Avec geom

    $polygone_apres = new stdClass;
    $polygone_apres->nom_polygone = $nom_polygone;
    $polygone_apres->id_polygone = $_POST['id_polygone'];
    $polygone_apres->article_partitif = $article_partitif;
    $polygone_apres->id_polygone_type = $_POST['id_polygone_type'];

    historisation_modification($polygone_avant,$polygone_apres,'modification polygone');

    $query_update = "UPDATE polygones SET "
        ."article_partitif = '$article_partitif', "
        ."nom_polygone = '$nom_polygone', "
        ."id_polygone_type = '{$_POST['id_polygone_type']}', "
        ."geom = st_makevalid(ST_SetSRID(ST_GeomFromGeoJSON('{$_POST['json_polygones']}'), 4326)) "
      ."WHERE id_polygone = {$_POST['id_polygone']}";
    $res = $pdo->query($query_update);
    if (!$res)
      erreur('Requête impossible',$query_update);
  }

  // Création
  if (!empty($_POST['enregistrer']) &&
    empty($_POST['id_polygone']) &&
    !empty($_POST['id_polygone_type']) &&
    !empty($_POST['json_polygones']))
  {
    if (!json_decode($_POST['json_polygones'])->coordinates)
    {
      echo '<p style="color:red">MASSIF OU ZONE NON CRÉÉ(E) CAR NE COMPORTE PAS DE POLYGONE</p>';
      echo '<p>Revenez en arrière pour continuer l\'édition</p>';
      exit;
    }

    // On commence par chercher s'il existe déjà un polygone homonyme
    $query_no = "SELECT id_polygone FROM polygones WHERE nom_polygone = '$nom_polygone'";
    $res=$pdo->query($query_no);
    if (!$res)
      erreur('Requête impossible',$query_no);

    $new_poly = $res->fetch();
    if (!$new_poly)
    {
      // Alors, on le crée
      $query_cree = "INSERT INTO polygones (id_polygone_type, article_partitif, nom_polygone, geom) ".
        "VALUES ({$_POST['id_polygone_type']}, '$article_partitif', '$nom_polygone', st_makevalid(ST_SetSRID(ST_GeomFromGeoJSON('{$_POST['json_polygones']}'), 4326)))";
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

    // Historisation de la création dans la table des historique des points
    $polygone_apres = new stdClass;
    $polygone_apres->nom_polygone = $nom_polygone;
    $polygone_apres->id_polygone = $new_poly->id_polygone;
    $polygone_apres->article_partitif = $article_partitif;
    $polygone_apres->id_polygone_type = $_POST['id_polygone_type']??1;

    historisation_modification(null,$polygone_apres,'création polygone');

    // Et donc, on va voir ce polygone
    return $new_poly->id_polygone;
  }

  if (!empty($_POST['supprimer']) && !empty($_POST['id_polygone']))
  {
    // Historisation de la suppression dans la table des historique des points
    $polygone_avant = infos_polygone($_POST['id_polygone'],false,false,true); // Avec geom
    historisation_modification($polygone_avant,null,'suppression polygone');

    $query_delate = "DELETE FROM polygones WHERE id_polygone = {$_POST['id_polygone']}";
    $res = $pdo->query($query_delate);
    if (!$res)
      erreur('Requête impossible',$query_delate);
  }
  return null;
}

/*************************************************************
On lui passe un tableau de polygones et ça nous renvoi une chaine de caractère au format :
"Alpes > Chartreuse > Réserve Naturelle des Hauts de Chartreuse"
ou
"France > Rhône Alpes > Savoie"
Selon le 2ème paramètres qui est la catégorie de polygone
*************************************************************/
function chaine_de_localisation($polygones,$categorie_polygone_type='montagnarde')
{
  $localisation="";
  if (!empty($polygones))
  {
    $i=0;
    foreach( $polygones as $polygone )
      if ($polygone->categorie_polygone_type==$categorie_polygone_type)
      {
        $i++;
        if ($i>1)
          $localisation.=' > ';
        $localisation.=$polygone->nom_polygone;
      }
  }
  return $localisation;
}
