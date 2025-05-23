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

// Par défaut, on veut afficher zones, massifs, régions, réserves
$vue->condition_categorie_polygone="montagnarde";

// FIXME sly : Mon rêve serait de déplacer ce bloc foreach dans une fonction générique que l'on puisse appeler 
// à chaque fois que l'on veut des points que les conditions soient reçues par GET ou POST. Une Sorte d'API de récupération
// dont les paramètres de recherche et conditions soient homogène sur tout le site (API interne, API externe GET/POST)
if (!empty($_REQUEST))
{
  foreach ($_REQUEST as $champ => $valeur)
  {
    if( ! empty($valeur) )
      switch ($champ) 
      {
        case 'id_polygone':
          $conditions->ids_polygones = $valeur; 
          break ;
          
        case 'id_point_type':
          $conditions->ids_types_point = $valeur ;
          break;
          
        case 'champs_trinaires':
          foreach ( $valeur as $c )
              $conditions->trinaire->$c = true ; 
          break;
        case 'condition_categorie_polygone':
          $vue->condition_categorie_polygone=$valeur;
          break;
          
        case 'champs_null':
          foreach ( $valeur as $c )
              $conditions->trinaire->$c = NULL ; 
          break; // TODO, ne pas restreindre aux champs trinaires.
        case 'ne_manque_pas_un_mur':
          $conditions->trinaire->manque_un_mur=false;
          break;
          
        default:  // tous les autres cas: nom, ouvert, places on repositionne comme condition la valeur telle qu'elle était dans le formulaire
          $conditions->$champ=trim($valeur); 
          break;
        }
          
  }

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

