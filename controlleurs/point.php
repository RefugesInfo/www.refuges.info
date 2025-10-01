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
    $vue->titre = "$vue->nom_debut_majuscule $point->altitude m ($point->nom_type)";
    
    $vue->localisation_point = array();
    foreach ($point->polygones as $polygone)
    {
        if (in_array($polygone->categorie_polygone_type,array("administrative","montagnarde","carte"))) // il existe d'autres catégories de polygone comme "interne" ce sont des polygones de positionnement de point de vu carte sans intérêt dans notre cas ici. Plutôt que de procéder par blacklist (categorie_polygone_type!="" je préfère finalement lister ceux que je veux)
            $vue->localisation_point[$polygone->categorie_polygone_type][] = $polygone; // On sépare en autant de tableaux qu'il y a de catégories
    }
    if ($point->modele!=1)
      $vue->forum_point = infos_point_forum ($point);
    $vue->lienforum=$config_wri['forum_refuge'].$point->topic_id;

    $conditions_commentaires = new stdClass();
    $conditions_commentaires->ids_points = $id_point;
    $tous_commentaires = infos_commentaires ($conditions_commentaires);
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
    // Construction du tableau qui sera lu, ligne par ligne par la vue pour être affiché
    // On pourrait détailler en html chaque propriété entourée par un if (propriété = valide), mais ça fait beaucoup de redondance, alors ainsi, je factorise au détriment d'un peu de lisibilité
    
    // Voici tous ce qui nous intéressent
    // FIXME: une méthode de sioux doit exister pour se passer d'une liste en dur, comme par exemple récupérer
    // ça directement de la base, mais bon... usine à gaz non ? un avis ? -- sly
    $champs=array_merge($config_wri['champs_entier_ou_sait_pas_points'],$config_wri['champs_trinaires_points'],array('site_officiel'));

    $vue->infos_complementaires = array ();
    foreach ($champs as $champ) 
    {
        $champ_equivalent = "equivalent_$champ";
        // Si ce champs est vide, c'est que cet élément ne s'applique pas à ce type de point (exemple: une cheminée pour une grotte)
        if ($point->$champ_equivalent!="") 
        {
            switch ($champ)
            {
                case 'site_officiel':
                    if ($point->$champ!="")
                        $val=array('valeur'=> '', 'lien' => $vue->point->$champ, 'texte_lien'=> $vue->nom_debut_majuscule);
                    break;
                   
                case 'places_matelas' : case 'places' :
                    if($point->$champ === NULL )
                        $val=array('valeur'=> '<strong>Inconnu</strong>');
                    else
                        $val=array('valeur'=> $point->$champ);
                    break;

                default: // Pour tous les boolééns restant
                    if($point->$champ === TRUE)
                        $val = array('valeur'=> 'Oui');
                    if($point->$champ === FALSE)
                        $val = array('valeur'=> 'Non');
                    if($point->$champ === NULL)
                        $val = array('valeur'=> '<strong>Inconnu</strong>');
                    break;
            }            
            
            if (isset($val))
                $vue->infos_complementaires[$point->$champ_equivalent]=$val;
            
        }
        unset($val);
    }
    /*********** Préparation des infos des commentaires ***/
    $vue->commentaires=array();
    $vue->commentaires_avec_photo=array();
    foreach ($tous_commentaires AS $commentaire)
    {
        $commentaire->texte_affichage=bbcode2html($commentaire->texte,FALSE,FALSE);
        $commentaire->auteur_commentaire_affichage=htmlentities($commentaire->auteur_commentaire);
        $commentaire->date_commentaire_format_francais= date_format_francais($commentaire->ts_unix_commentaire);
        // Préparation des données et affichage d'un commentaire de la fiche d'un point
        // ici le lien pour modérer ce commentaire si on est modérateur ou auteur du commentaire
        if (est_autorise($commentaire->id_createur_commentaire)) 
        {
            $commentaire->lien_commentaire='/gestion/moderation?id_point_retour='.$commentaire->id_point.'&amp;id_commentaire='.$commentaire->id_commentaire;
            $commentaire->texte_lien_commentaire = 'Modifier';
        } 
        else 
        {
            // l'internaute, en cliquant ici va nous donner ce qu'il pense de ce commentaire
            $commentaire->lien_commentaire = "/avis_internaute_commentaire/$commentaire->id_commentaire/";
            $commentaire->texte_lien_commentaire = 'Info périmée ?';
        }
        
        // Si, selon la base une photo existe, on va l'afficher
        if ($commentaire->photo_existe) 
        {
            if (isset($commentaire->date_photo))
                $commentaire->date_photo_format_francais=strftime ("%d/%m/%Y", $commentaire->ts_unix_photo);
            else
                $commentaire->date_photo_format_francais = '';
            // On garde une copie des commentaires avec photos pour nous fournir la liste des petite vignettes
            $vue->commentaires_avec_photo[]=$commentaire;
        }
        
        $vue->commentaires[]=$commentaire;
    }
}

