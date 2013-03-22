<?php
/***
Point d'entrée de la page "Fiche du point" qui s'occupe de présenter le point, sommet,
village et tout autre "type" possible de la base avec photos, nom, infos, commentaires, etc...
on peut accéder au point par http://<site>/point/183/ce/quon/veut/ ( pour le n°183 ). (sly)
FIXME 16/02/2013: il faut en finir avec le Options +Multiviews merdique et peu performant, 
du rewrite et un vrai modèle MVC avec un seul script d'entrée à tous le site me semble la direction à prendre
***/


require_once ('modeles/config.php');
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_mode_emploi.php");
require_once ("fonctions_points.php");
require_once ("fonctions_pubs.php");
require_once ("fonctions_utilisateurs.php");

// Arguments de la page
$array = explode ('/',$_SERVER['PATH_INFO']);
$id_point = $array [1]; // $array [1] contient l'id du point
$modele = new stdClass();
// FIXME je trouverais plus claire de mettre le point dans $modele->point pour éviter d'écraser d'autre propriété du modèle
$modele = infos_point ($id_point);

// Les infos du point deviennent des membres du template ($modele->latitude ...)
// Partie spécifique de la page
if ($modele->erreur) 
    $modele->type = 'point_inexistant';
else if ($modele->nom_type == 'Censuré' && $_SESSION['niveau_moderation']<1) 
    $modele->type = 'point_censure';
else // le point est valide. faut bosser.
{
    $modele->nom=bbcode2html($modele->nom);
    $modele->nom_debut_majuscule = ucfirst($modele->nom);
    $modele->titre = "$modele->nom_debut_majuscule $modele->altitude m ($modele->nom_type)";
    $modele->description = "fiche d'information sur : $modele->nom_debut_majuscule, $modele->nom_type, altitude $modele->altitude avec commentaires et photos";
    $modele->type = 'point'; // Le template
    foreach (array("administrative","montagnarde") as $categorie)
        if (($loc=localisation ($modele->polygones,$categorie))!="")
            $modele->localisation[$categorie] = localisation ($modele->polygones,$categorie);
    
    if ($modele->modele!=1)
    $modele->forum = infos_point_forum ($modele);
    $conditions_commentaires = new stdClass();
    $conditions_commentaires->ids_points = $id_point;
    $tous_commentaires = infos_commentaires ($conditions_commentaires);
    $modele->annonce_fermeture = texte_non_ouverte ($modele);

    /*********** Création de la liste des points à proximité si les coordonnées ne sont pas "cachée" ***/
    if ($modele->id_type_precision_gps != $config['id_coordonees_gps_fausses'])
    {
        $conditions = new stdClass;
        $conditions->avec_infos_massif=True;
        $conditions->limite=10;
        $conditions->ouvert='oui';
        
        $g = [ 'lat' => $modele->latitude, 'lon' => $modele->longitude , 'rayon' => 5000 ];
        $conditions->geometrie = cree_geometrie( $g , 'cercle' );
        //$conditions->distance="$modele->latitude;$modele->longitude;5000";
        
        $conditions->ordre="distance ASC";
        $modele->points_proches=infos_points($conditions);
        
        /*********** Détermination de la carte à afficher ***/
        $modele->mini_carte=TRUE;
        $modele->java_lib [] = 'http://maps.google.com/maps/api/js?v=3&amp;sensor=false';
        $modele->java_lib [] = $config['chemin_openlayers'].'OpenLayers.js';
        $modele->vignette = param_cartes ($modele);
    }
    
    /***********  détermination si le point se situe dans un polygone pour lequel un message est à faire passer *******/
    // L'utilisation principal est le message de réglementation de la réserve naturelle
    if (count($modele->polygones))
        foreach ($modele->polygones as $polygone)
            if ($polygone->message_information_polygone!="")
                $modele->polygone_avec_information=$polygone;
            
    /*********** Préparation de la présentation du point ***/
    if (isset($_SESSION['id_utilisateur']) AND ( $_SESSION['niveau_moderation'] >= 1 OR $_SESSION['id_utilisateur'] == $modele->id_createur ))
        $modele->lien_modification=TRUE;
            
    /*********** Préparation des infos complémentaires (c'est à dire les champs à cocher) ***/
    // Construction du tableau qui sera lu, ligne par ligne par le modele pour être affiché
    
    // Voici tous ceux qui nous intéresse (FIXME: une méthode de sioux doit exister pour se passer d'une liste en dure, comme par exemple récupérer ça directement de la base, mais bon... usine à gaz : bof)
    $champs=array_merge($config['champs_binaires_points'],array('site_officiel'),array('places_matelas'));
    foreach ($champs as $champ) 
    {
        $champ_equivalent = "equivalent_$champ";
        // Si ce champs est vide, c'est que cet élément ne s'applique pas à ce type de point (exemple: une cheminée pour un sommet)
        if ($modele->$champ_equivalent!="") 
        {
            switch ($champ)
            {
                //case 'sommaire': // un autre nomSVP, mais pas un pansement en code... on mets abri sommaire et voila.
                //if ($modele->$champ=="oui")
                //$val=array('valeur'=> $modele->$champ, 'lien' => lien_mode_emploi("fiche-cabane-non-gardee"), 'texte_lien'=> "(Plus de détail sur ce que cela signifie)");
                //    break;
                case 'site_officiel':
                    if ($modele->$champ!="")
                        $val=array('valeur'=> '', 'lien' => $modele->$champ, 'texte_lien'=> $modele->nom_debut_majuscule);
                    break;
                case 'ferme':  // jmb Hack paske j'ai merdé en supprimant la possibilité de Fermé = Inconnu
                    //if ( empty($modele->$champ) )
                    //    $modele->$champ = "non";
                    //$val=array('valeur'=> $modele->$champ);
                    unset($val);
                    break;
                    
                case (in_array($champ, $config['champs_binaires_simples_points'] ) ):  // vrais Bools
                    if($modele->$champ === TRUE)
                        $val = array('valeur'=> 'Oui');
                    if($modele->$champ === FALSE)
                        $val = array('valeur'=> 'Non');
                    if($modele->$champ === NULL)
                        $val = array('valeur'=> '<strong>Inconnu</strong>');
                    break;
                    
                case 'matelas':
                    break; // a virer plus tard. remplace par places_matelas.
                    
                case 'places_matelas':
                    if($modele->$champ == -1)
                        $val=array('valeur'=> 'Sans');
                    elseif($modele->$champ === 0)
                        $val=array('valeur'=> 'Avec, en nombre inconnu');
                    elseif($modele->$champ === NULL )
                        $val=array('valeur'=> '<strong>Inconnu</strong>');
                    else
                        $val=array('valeur'=> $modele->$champ);
                    break;
                    
                default:
                    if ($modele->$champ=="") 
                        $modele->$champ="<strong>Inconnu</strong>";
                    elseif ($modele->$champ < 0) 
                        $val=array('valeur'=> 'Sans');
                    $val=array('valeur'=> $modele->$champ);
            }            
            
            if (isset($val))
                $modele->infos_complementaires[$modele->$champ_equivalent]=$val;
            
            // Cas particulier : si matelas=yes, on indique combien de place à la ligne juste en dessous
            if ($champ=='matelas' and $modele->$champ=='oui')
                $modele->infos_complementaires['Places sur Matelas']=array('valeur'=>$modele->places_matelas);   
        }
        unset($val);
    }
    /*********** Préparation des infos des commentaires ***/
    foreach ($tous_commentaires AS $commentaire)
    {
        $commentaire->texte=bbcode2html($commentaire->texte);
        $commentaire->auteur=bbcode2html($commentaire->auteur);
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
            $commentaire->lien_commentaire = '/gestion/avis-internaute-commentaire.php?id_commentaire='.$commentaire->id_commentaire;
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
            $modele->commentaires_avec_photo[]=$commentaire;
        }
        
        $modele->commentaires[]=$commentaire;
    }
}

if ($_GET['format']=="geojson") {
	include ($config['chemin_vues']."$modele->type.geojson");
}
else {
	/*********** On affiche le tout ***/
	include ($config['chemin_vues']."_entete.html");
	include ($config['chemin_vues']."$modele->type.html");
	include ($config['chemin_vues']."_pied.html");
}
?>
