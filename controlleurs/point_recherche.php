<?php
/********************************************************************************************************
Les resultats de la recherche. Ce fichier recupere les criteres du formulaire
( une suite de fiche refuges, mais sans tous les détails )
********************************************************************************************************/

require_once ("point.php");
require_once ("polygone.php");


/************ Préparation des conditions de la recherche *******************/
// tous ceux dont le name du formulaire correspondent à la condition sur le champs en base du même nom
$conditions = new stdClass;
$conditions->trinaire = new stdClass;
$conditions->avec_liste_polygones=True;

// Le formulaire nous envoi les données en GET, mais j'accepte aussi en POST en provenance possible d'un tiers ($_REQUEST combinant GET et POST)
if (!empty($_REQUEST))
{
  $conditions->ids_polygones = $_REQUEST['id_polygone'] ?? '';
  $conditions->ids_types_point = $_REQUEST['id_point_type'] ?? '';
  $conditions->nom = $_REQUEST['nom'] ?? '';
  $conditions->description = $_REQUEST['description'] ?? '';
  $conditions->places_minimum = $_REQUEST['places_minimum'] ?? '';
  $conditions->places_maximum = $_REQUEST['places_maximum'] ?? '';
  $conditions->places_matelas_minimum = $_REQUEST['places_matelas_minimum'] ?? '';
  $conditions->altitude_minimum = $_REQUEST['altitude_minimum'] ?? '';
  $conditions->altitude_maximum = $_REQUEST['altitude_maximum'] ?? '';
  $conditions->chauffage = $_REQUEST['chauffage'] ?? '';
  $conditions->precision_gps = $_REQUEST['precision_gps'] ?? '';
  $conditions->id_createur = $_REQUEST['id_createur'] ?? '';
  $conditions->ouvert = $_REQUEST['ouvert'] ?? '';
  $conditions->limite = $_REQUEST['limite'] ?? $config_wri['points_maximum_recherche'];

  // les cases à cocher qui peuvent être soit "cochée" = true, pas cochée = (vide)
  if (!empty($_REQUEST['champs_trinaires']))
    foreach ( $_REQUEST['champs_trinaires'] as $c )
      $conditions->trinaire->$c = true ; 

  //  ou la case rouge ajoutée en javascript "cochées spécialement" avec l'option "état inconnu" qui ne sert qu'aux modérateurs pour l'entretient des fiches
  if (!empty($_REQUEST['champs_null']))
    foreach ( $_REQUEST['champs_null'] as $c )
      $conditions->trinaire->$c = NULL; 

  // Un peu spécial pour cette option, personne ne souhaite chercher les cabanes dont il manque des murs, par contre, on cherche celle qui sont bien isolées.
  if (isset($_REQUEST['ne_manque_pas_un_mur']))
    $conditions->trinaire->manque_un_mur=false;
      
  // Le rangement par pays/département (administrative) ou massif/réserves naturelle (montagnarde) n'est plus une condition de la recherche, car tout est toujours renvoyé, mais lors de l'affichage par la vue, on peut inclure juste l'une des deux catégories souhaités, Par défaut, on veut afficher zones, massifs, régions, réserves naturelles :
  $vue->condition_categorie_polygone = $_REQUEST['condition_categorie_polygone'] ?? 'montagnarde';


  //======================================
  // C'est LA que ca cherche
  
  $points = infos_points ($conditions);
  if (!empty($points->erreur))
  {
    $vue->contenu=$points->message."<br>(Vous pouvez revenir en arrière avec votre navigateur pour corriger le problème)";
    $vue->type="page_simple";
    $vue->titre="Recherche sur refuges.info en Erreur";

  }
  else
  {
    $vue->nombre_points=sizeof($points);
    $vue->titre="Recherche sur refuges.info ($vue->nombre_points points affichés)";

    if (isset($points))
      foreach ($points as $point)
      {
        $point->lien=lien_point($point,true);
        $vue->points[]=$point;
      }
    //en PG, pas moyen de savoir si on a tapé la limite. Je dis que si on a pile poile le nombre de points, c'est qu'on l'a atteinte
    if (!empty($conditions->limite) && $vue->nombre_points == $conditions->limite)
      $vue->limite_atteinte = $conditions->limite;
    
    //-----------------------------------------------------------------------------------------------------
    // Recherche de points sur nominatim.openstreetmap.org à condition d'avoir coché la case ET avoir fourni un nom à chercher
      
    if (!empty($_REQUEST['avec_point_osm']) and !empty($_REQUEST['nom']) )
    {
      $nominatim = new stdClass();
      $vue->recherche_osm_active=True;
      $appel_nominatim = $config_wri['url_appel_nominatim'] .http_build_query 
      (
      array 
      (
      'email' => $config_wri['email_contact_nominatim'],
        'format' => 'xml',
        'countrycodes' => 'fr,ch,it,es',
        'accept-language' => 'fr',
        'q' => $_REQUEST['nom'],
        'limit' => 20,
        )
        );
        // Récupération du contenu
      $cache = file_get_contents ($_SERVER['REQUEST_SCHEME'].':'.$appel_nominatim);
      
      // Extraction de l'arbre xml
      $nominatim->xml = simplexml_load_string ($cache);
      $nominatim->nb_points = count($nominatim->xml);
      if ($nominatim->nb_points>1)
        $nominatim->pluriel="s";
      else
        $nominatim->pluriel="";
      
      $nominatim->url_site=$config_wri['url_nominatim'];
      $vue->nominatim=$nominatim;
    }
  }
}
else
{
  $vue->contenu="Votre recherche ne contient aucun critère, il devrait au moins y avoir le nom (même vide)";
  $vue->http_status_code = 404;
  $vue->type="page_simple";
}

