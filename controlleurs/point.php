<?php
/***
Contrôleur qui prépare la vue pour les pages des points
***/

require_once ("polygone.php");
require_once ("point.php");
require_once ("utilisateur.php");
require_once ("mise_en_forme_texte.php");

$condition = new stdClass();

// Arguments de la page
$id_point = $controlleur->url_decoupee[1]; // l'id du point est 5 dans /point/5/... c'est le controlleur qui nous passe se tableau

// On n'autorise l'accès au fiches cachées ou aux modèle qu'aux modérateurs et on indique de manière bien évidente aux modérateur que cette fiche est cachée et non visible au public ou qu'il s'agit d'un modèle.
if (est_moderateur())
  $meme_si_cache=$meme_si_modele=True;
else
  $meme_si_cache=$meme_si_modele=False;

$point=infos_point($id_point,$meme_si_cache,True,$meme_si_modele);



// Partie spécifique de la page

// Le point n'est pas trouvé ou il y a un problème avec ce point
if (!empty($point->erreur))
{
  $vue->type="page_simple";
  // On affiche le message d'erreur spécifique à ce point
  $vue->contenu=$point->message;
  $vue->titre=$point->message;
  // Avec un code 404 pour bien préciser au moteur de recherche qu'il n'y a pas de page valide pour ce point
  $vue->http_status_code=404;
}
else // le point est valide
{
  // Les infos du point deviennent des membres de $vue ($vue->point->latitude ...)
  $vue->point=$point;
  $vue->nom_createur = protege($point->nom_createur);
  $vue->nom=protege($point->nom);
  $vue->proprio=bbcode2html($point->proprio);
  $vue->acces=bbcode2html($point->acces);
  $vue->remark=bbcode2html($point->remark);
  $vue->nom_debut_majuscule = protege(mb_ucfirst($point->nom));
  $vue->lien_wiki_explication_type=lien_wiki("fiche-".replace_url($point->nom_type));
  $vue->lien_wiki_explication_geo=lien_wiki("geo-uri");
  $vue->lien_wiki_explication_proprio=lien_wiki("informations_proprietaires");
  $vue->titre = "$vue->nom_debut_majuscule $point->altitude m ($point->nom_type)";

  $vue->localisation_point = array();
  foreach ($point->polygones as $polygone)
  {
    if (in_array($polygone->categorie_polygone_type,array("administrative","montagnarde","carte"))) // il existe d'autres catégories de polygone comme "interne" ce sont des polygones de positionnement de point de vu carte sans intérêt dans notre cas ici. Plutôt que de procéder par blacklist (categorie_polygone_type!="" je préfère finalement lister ceux que je veux)
      $vue->localisation_point[$polygone->categorie_polygone_type][] = $polygone; // On sépare en autant de tableaux qu'il y a de catégories
  }
  if ($point->modele!=1)
    $vue->forum_point = infos_point_forum ($point);

  $vue->lienforum=$config_wri['forum_refuge']."?t=".$point->topic_id;

  $vue->annonce_fermeture = texte_non_ouverte ($point);

  /*********** Création de la liste des points à proximité si les coordonnées ne sont pas "cachée" et de l'affichage de la carte ***/
  if ($point->id_type_precision_gps != $config_wri['id_coordonees_gps_fausses'])
  {
    $conditions = new stdClass;
    $conditions->limite=10;

    // On défini le cercle (centre et rayon) dont on veut les points à proximité
    $conditions->rayon_du_cercle=5000;
    $conditions->centre_du_cercle=$point->geom;

    $points_proches=infos_points($conditions);
    $vue->points_proches = array();
    foreach ($points_proches as $point_proche)
    {
      //On ne veut pas dans les points proches le point lui même
      if ($point_proche->id_point!=$point->id_point)
      {
        $point_proche->lien=lien_point($point_proche);
        $point_proche->nom=mb_ucfirst($point_proche->nom);
        if ($point_proche->distance<1000) // si le point est plus proche qu'1km on affichera en mètre
        {
          $point_proche->distance_au_point=number_format($point_proche->distance,"0",",","");
          $point_proche->distance_au_point_unite="m";
        }
        else
        {
          $point_proche->distance_au_point=number_format($point_proche->distance/1000,"2",",","");
          $point_proche->distance_au_point_unite="km";
        }
        $vue->points_proches[]=$point_proche;
      }
    }

    /*********** Détermination de la carte à afficher ***/
    $vue->carte=TRUE;
    $vue->mini_carte=TRUE;
  }

  /***********  détermination si le point se situe dans une réserve naturelle / zone réglementée *******/
  foreach ($point->polygones as $polygone)
    if ($polygone->id_polygone_type==$config_wri['id_zone_reglementee'])
      $vue->polygone_avec_information=$polygone;

  /*********** Préparation des infos complémentaires (c'est à dire les attributs du bas de la fiche) ***/
  // Dom 01/2026 : transféré dans modeles/point.php
  $vue->infos_complementaires = $point->infos_complementaires;
  array_walk_recursive($vue->infos_complementaires, 'updatebbcode2html'); // Pour compatibilité avec l'API

  /*********** Formatage des infos des commentaires ***/
  // Dom 01/2026 : Transféré dans /modele/commentaire.php
  $conditions_commentaires = new stdClass();
  $conditions_commentaires->ids_points = $id_point;
  $vue->commentaires = infos_commentaires ($conditions_commentaires);

  $vue->commentaires_avec_photo=[];
  foreach ($vue->commentaires AS $commentaire)
    if ($commentaire->photo_existe)
      $vue->commentaires_avec_photo[] = $commentaire;
}

