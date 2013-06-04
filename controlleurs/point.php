<?php
/***
Point d'entrée de la page "Fiche du point" qui s'occupe de présenter le point, sommet,
village et tout autre "type" possible de la base avec photos, nom, infos, commentaires, etc...
on peut accéder au point par http://<site>/point/183/ce/quon/veut/ ( pour le n°183 ). (sly)
FIXME 16/02/2013: il faut en finir avec le Options +Multiviews merdique et peu performant, 
du rewrite et un vrai modèle MVC avec un seul script d'entrée à tous le site me semble la direction à prendre
***/


require_once ("fonctions_polygones.php");
require_once ("fonctions_mode_emploi.php");
require_once ("fonctions_points.php");
require_once ("fonctions_pubs.php");
require_once ("fonctions_utilisateurs.php");

$condition = new stdClass();

// Arguments de la page
$id_point = $controlleur->url_decoupee[2]; // l'id du point est 5 dans /point/5/... c'est le controlleur qui nous passe se tableau

// On indique de manière bien évidente aux modérateur que cette fiche est censurée
if ($_SESSION['niveau_moderation']>=1)
    $meme_si_censure=True;
else
    $meme_si_censure=False;

// FIXME je trouverais plus clair de mettre le point dans $vue->point pour éviter d'écraser d'autre propriété du modèle
// sly : FIXME ouais grave; obligé de bidouiller pour rétablir ce que infos_point écrase !
$ancienne_vue = new stdClass;
foreach ($vue as $cle => $val)
    $ancienne_vue->$cle=$val;
$vue = infos_point ($id_point,$meme_si_censure);

foreach ($ancienne_vue as $cle => $val)
    $vue->$cle=$val;

// Les infos du point deviennent des membres du template ($vue->latitude ...)
// Partie spécifique de la page
if ($vue->erreur)
{
    $vue->type="page_simple";
    $vue->contenu=$vue->message;
}
else // le point est valide. faut bosser.
{
    $vue->nom=bbcode2html($vue->nom);
    $vue->nom_debut_majuscule = ucfirst($vue->nom);
    $vue->titre = "$vue->nom_debut_majuscule $vue->altitude m ($vue->nom_type)";
    $vue->description = "fiche d'information sur : $vue->nom_debut_majuscule, $vue->nom_type, altitude $vue->altitude avec commentaires et photos";
    foreach ($vue->polygones as $polygone)
    {
        if (isset($polygone->categorie_polygone_type))
        {
            if ($polygone->categorie_polygone_type=="montagnarde")
                $polygone->avec_lien_carte=True;
            $vue->localisation[$polygone->categorie_polygone_type][] = $polygone; // On sépare en autant de tableaux qu'il y a de catégories
        }
    }
    if ($vue->modele!=1)
    $vue->forum = infos_point_forum ($vue);
    $conditions_commentaires = new stdClass();
    $conditions_commentaires->ids_points = $id_point;
    $tous_commentaires = infos_commentaires ($conditions_commentaires);
    $vue->annonce_fermeture = texte_non_ouverte ($vue);


    /*********** Création de la liste des points à proximité si les coordonnées ne sont pas "cachée" ***/
    if ($vue->id_type_precision_gps != $config['id_coordonees_gps_fausses'])
    {
        $conditions = new stdClass;
        $conditions->avec_infos_massif=True;
        $conditions->limite=10;
        $conditions->ouvert='oui';
        
        $g = array ( 'lat' => $vue->latitude, 'lon' => $vue->longitude , 'rayon' => 5000 );
        $conditions->geometrie = cree_geometrie( $g , 'cercle' );
        
        $conditions->avec_distance=True;
        $vue->points_proches=infos_points($conditions);
        
        /*********** Détermination de la carte à afficher ***/
        $vue->mini_carte=TRUE;
//        $vue->java_lib [] = 'http://maps.google.com/maps/api/js?v=3&amp;sensor=false';
        $vue->java_lib [] = $config['chemin_openlayers'].'OpenLayers.js';
        $vue->vignette = param_cartes ($vue);
    }
    
    /***********  détermination si le point se situe dans un polygone pour lequel un message est à faire passer *******/
    // L'utilisation principal est le message de réglementation de la réserve naturelle
    if (count($vue->polygones))
        foreach ($vue->polygones as $polygone)
            if ($polygone->message_information_polygone!="")
                $vue->polygone_avec_information=$polygone;
            
    /*********** Préparation de la présentation du point ***/
    if (isset($_SESSION['id_utilisateur']) AND ( $_SESSION['niveau_moderation'] >= 1 OR $_SESSION['id_utilisateur'] == $vue->id_createur ))
        $vue->lien_modification=TRUE;
            
    /*********** Préparation des infos complémentaires (c'est à dire les champs à cocher) ***/
    // Construction du tableau qui sera lu, ligne par ligne par le modele pour être affiché
    
    // Voici tous ceux qui nous intéresse 
    // FIXME: une méthode de sioux doit exister pour se passer d'une liste en dure, comme par exemple récupérer 
    // ça directement de la base, mais bon... usine à gaz non ? un avis ? -- sly
    $champs=array_merge($config['champs_binaires_points'],array('places_matelas'),array('site_officiel'));
   
    foreach ($champs as $champ) 
    {
        $champ_equivalent = "equivalent_$champ";
        // Si ce champs est vide, c'est que cet élément ne s'applique pas à ce type de point (exemple: une cheminée pour un sommet)
        if ($vue->$champ_equivalent!="") 
        {
            switch ($champ)
            {
                //case 'sommaire': // un autre nomSVP, mais pas un pansement en code... on mets abri sommaire et voila.
                case 'site_officiel':
                    if ($vue->$champ!="")
                        $val=array('valeur'=> '', 'lien' => $vue->$champ, 'texte_lien'=> $vue->nom_debut_majuscule);
                    break;
                case 'ferme':  // jmb Hack paske j'ai merdé en supprimant la possibilité de Fermé = Inconnu
                    unset($val);
                    break;
                    
                case (in_array($champ, $config['champs_binaires_simples_points'] ) ):  // vrais Bools
                    if($vue->$champ === TRUE)
                        $val = array('valeur'=> 'Oui');
                    if($vue->$champ === FALSE)
                        $val = array('valeur'=> 'Non');
                    if($vue->$champ === NULL)
                        $val = array('valeur'=> '<strong>Inconnu</strong>');
                    break;
                    
                case 'matelas':
                    break; // a virer plus tard. remplace par places_matelas.
                    
                case 'places_matelas':
                    if($vue->$champ == -1)
                        $val=array('valeur'=> 'Sans');
                    elseif($vue->$champ === 0)
                        $val=array('valeur'=> 'Avec, en nombre inconnu');
                    elseif($vue->$champ === NULL )
                        $val=array('valeur'=> '<strong>Inconnu</strong>');
                    else
                        $val=array('valeur'=> $vue->$champ);
                    break;
                    
                default:
                    if ($vue->$champ=="") 
                        $vue->$champ="<strong>Inconnu</strong>";
                    elseif ($vue->$champ < 0) 
                        $val=array('valeur'=> 'Sans');
                    $val=array('valeur'=> $vue->$champ);
            }            
            
            if (isset($val))
                $vue->infos_complementaires[$vue->$champ_equivalent]=$val;
            
            // Cas particulier : si matelas=yes, on indique combien de place à la ligne juste en dessous
            if ($champ=='matelas' and $vue->$champ=='oui')
                $vue->infos_complementaires['Places sur Matelas']=array('valeur'=>$vue->places_matelas);   
        }
        unset($val);
    }
    /*********** Préparation des infos des commentaires ***/
    foreach ($tous_commentaires AS $commentaire)
    {
        $commentaire->texte_affichage=bbcode2html($commentaire->texte);
        $commentaire->auteur_commentaire_affichage=bbcode2html($commentaire->auteur_commentaire);
        $commentaire->date_commentaire_format_francais=strftime ("%A %e %B %Y à %H:%M", $commentaire->ts_unix_commentaire);
        // Préparation des données et affichage d'un commentaire de la fiche d'un point
        // ici le lien pour modérer ce commentaire
        if (isset($_SESSION['id_utilisateur']) AND ( ($_SESSION['niveau_moderation']>=1) OR ($_SESSION['id_utilisateur']==$commentaire->id_createur))) 
        {
            $commentaire->lien_commentaire='/gestion/?page=moderation&amp;id_point_retour='.$commentaire->id_point.'&amp;id_commentaire='.$commentaire->id_commentaire;
            $commentaire->texte_lien_commentaire = 'Modifier';
        } 
        else 
        {
            // l'internaute, en cliquant ici va nous donner ce qu'il pense de ce commentaire
            $commentaire->lien_commentaire = "/avis-internaute-commentaire/$commentaire->id_commentaire/";
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
