<?php
/***
Contrôleur qui prépare la vue pour les pages des points
***/

require_once ("polygone.php");
require_once ("point.php");
require_once ("pub.php");
require_once ("utilisateur.php");
require_once ("mise_en_forme_texte.php");

$condition = new stdClass();

// Arguments de la page
$id_point = $controlleur->url_decoupee[1]; // l'id du point est 5 dans /point/5/... c'est le controlleur qui nous passe se tableau

// On indique de manière bien évidente aux modérateur que cette fiche est censurée
if ($_SESSION['niveau_moderation']>=1)
    $meme_si_censure=True;
else
    $meme_si_censure=False;

$point = infos_point ($id_point,$meme_si_censure);
// Partie spécifique de la page
if ($point->erreur)
{
    $vue->type="page_simple";
    $vue->contenu=$point->message;
}
else // le point est valide
{
    // Les infos du point deviennent des membres de $vue ($vue->point->latitude ...)
    $vue->point=$point;
    $vue->nom_createur = bbcode2html($point->nom_createur);
    $vue->nom=bbcode2html($point->nom);
    $vue->proprio=bbcode2html($point->proprio);
    $vue->acces=bbcode2html($point->acces);
    $vue->remark=bbcode2html($point->remark);
    $vue->nom_debut_majuscule = bbcode2html(mb_ucfirst($point->nom));
    $vue->lien_wiki_explication_type=lien_wiki("fiche-".replace_url($point->nom_type));
    $vue->lien_wiki_explication_geo=lien_wiki("geo-uri");
    $vue->titre = "$vue->nom_debut_majuscule $point->altitude m ($point->nom_type)";
    $vue->description = protege("fiche d'information sur : $vue->nom_debut_majuscule, $point->nom_type, altitude $point->altitude avec commentaires et photos");
    $vue->lien_explication_publicite=lien_wiki("publicite");
    
    if ($point->polygones)
        foreach ($point->polygones as $polygone)
        {
            if (!empty($polygone->categorie_polygone_type)) // il existe des catégories "vide" elles sont des zone de positionnement de point de vu carte sans intérêt pour l'utilisateur final
            {
                if ($polygone->categorie_polygone_type=="montagnarde")
                    $polygone->avec_lien_carte=True;
                $vue->localisation_point[$polygone->categorie_polygone_type][] = $polygone; // On sépare en autant de tableaux qu'il y a de catégories
            }
        }
    if ($point->modele!=1)
    $vue->forum_point = infos_point_forum ($point);
    $vue->forum_point->post_text_propre = bbcode2html (preg_replace ('/<[^>]*>/i', '', $vue->forum_point->post_text));

	//FIXME : Bon, C pa BO mais ça marche pour l'instant ! On passe temporairement en timezone Paris pour décoder l'heure du forum
	// Pas sûr que ça marche encore en heure d'hiver !
	date_default_timezone_set('Europe/Paris');
    $vue->forum_point->date_humaine=strftime ('%A %e %B %Y à %H:%M',$vue->forum_point->post_time);
	date_default_timezone_set('UTC');

    $conditions_commentaires = new stdClass();
    $conditions_commentaires->ids_points = $id_point;
    $tous_commentaires = infos_commentaires ($conditions_commentaires);
    $vue->annonce_fermeture = texte_non_ouverte ($point);

    /*********** Création de la liste des points à proximité si les coordonnées ne sont pas "cachée" et de l'affichage de la carte ***/
    if ($point->id_type_precision_gps != $config['id_coordonees_gps_fausses'])
    {
        $conditions = new stdClass;
        $conditions->avec_infos_massif=True;
        $conditions->limite=10;
        $conditions->ouvert='oui';
        
        $g = array ( 'lat' => $point->latitude, 'lon' => $point->longitude , 'rayon' => 5000 );
        $conditions->geometrie = cree_geometrie( $g , 'cercle' );
        
        $conditions->avec_distance=True;
        $points_proches=infos_points($conditions);
        if (count($points_proches))
            foreach ($points_proches as $point_proche) 
            {
                //On ne veut pas dans les points proches le point lui même
                if ($point_proche->id_point!=$point->id_point)
                {
                    $point_proche->lien=lien_point($point_proche);
                    $point_proche->nom=mb_ucfirst(bbcode2html($point_proche->nom));
                    $point_proche->distance_au_point=number_format($point_proche->distance/1000,"2",",","");
                    $vue->points_proches[]=$point_proche;
                }
            }
            
        /*********** Détermination de la carte à afficher ***/
        $vue->mini_carte=TRUE;
		$vue->css           [] = $config['url_chemin_leaflet'].'leaflet.css?'.filemtime($config['chemin_leaflet'].'leaflet.css');
		$vue->java_lib_foot [] = $config['url_chemin_leaflet'].'leaflet.js?' .filemtime($config['chemin_leaflet'].'leaflet.js');
        $vue->vignette = param_cartes ($point);
    }

    /***********  détermination si le point se situe dans un polygone pour lequel un message est à faire passer *******/
    // L'utilisation principal est le message de réglementation de la réserve naturelle
    if (count($point->polygones))
        foreach ($point->polygones as $polygone)
            if ($polygone->message_information_polygone!="")
                $vue->polygone_avec_information=$polygone;
            
    /*********** Préparation de la présentation du point ***/
    if (isset($_SESSION['id_utilisateur']) AND ( $_SESSION['niveau_moderation'] >= 1 OR $_SESSION['id_utilisateur'] == $point->id_createur OR $point->id_point_type == $config['id_batiment_en_montagne']))
        $vue->lien_modification=TRUE;
            
    /*********** Préparation des infos complémentaires (c'est à dire les attributs du bas de la fiche) ***/
    // Construction du tableau qui sera lu, ligne par ligne par le modele pour être affiché
    
    // Voici tous ceux qui nous intéresse 
    // FIXME: une méthode de sioux doit exister pour se passer d'une liste en dure, comme par exemple récupérer 
    // ça directement de la base, mais bon... usine à gaz non ? un avis ? -- sly
    $champs=array_merge(array('places_matelas'),$config['champs_binaires_points'],array('site_officiel'));
   
    foreach ($champs as $champ) 
    {
        $champ_equivalent = "equivalent_$champ";
        // Si ce champs est vide, c'est que cet élément ne s'applique pas à ce type de point (exemple: une cheminée pour un sommet)
        if ($point->$champ_equivalent!="") 
        {
            switch ($champ)
            {
                case 'site_officiel':
                    if ($point->$champ!="")
                        $val=array('valeur'=> '', 'lien' => $vue->point->$champ, 'texte_lien'=> $vue->nom_debut_majuscule);
                    break;
                   
                case 'places_matelas':
                    if($point->$champ == -1)
                        $val=array('valeur'=> 'Sans');
                    elseif($point->$champ === 0)
                        $val=array('valeur'=> 'Avec, en nombre inconnu');
                    elseif($point->$champ === NULL )
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
    foreach ($tous_commentaires AS $commentaire)
    {
        $commentaire->texte_affichage=bbcode2html($commentaire->texte,FALSE,FALSE);
        $commentaire->auteur_commentaire_affichage=bbcode2html($commentaire->auteur_commentaire);
        $commentaire->date_commentaire_format_francais=strftime ("%A %e %B %Y à %H:%M", $commentaire->ts_unix_commentaire);
        // Préparation des données et affichage d'un commentaire de la fiche d'un point
        // ici le lien pour modérer ce commentaire si on est modérateur ou auteur du commentaire
        if (isset($_SESSION['id_utilisateur']) AND ( ($_SESSION['niveau_moderation']>=1) OR ($_SESSION['id_utilisateur']==$commentaire->id_createur_commentaire))) 
        {
            $commentaire->lien_commentaire='/gestion/moderation?id_point_retour='.$commentaire->id_point.'&amp;id_commentaire='.$commentaire->id_commentaire;
            $commentaire->texte_lien_commentaire = 'Modifier';
        } 
        else 
        {
            // l'internaute, en cliquant ici va nous donner ce qu'il pense de ce commentaire
            $commentaire->lien_commentaire = "/avis_internaute_commentaire/$commentaire->id_commentaire/";
            $commentaire->texte_lien_commentaire = 'Que pensez vous de ce commentaire ?';
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
?>
