<?php
/********************************************************************************************************
Les resultats de la recherche. Ce fichier recupere les criteres en POST du formulaire
( une suite de fiche refuges, mais sans tous les détails )
********************************************************************************************************/

require_once ("point.php");
require_once ("polygone.php");


/************ Préparation des conditions de la recherche *******************/
// tous ceux dont le name du formulaire correspondent à la condition sur le champs en base du même nom
$conditions = new stdClass;
$conditions->trinaire = new stdClass;

$conditions->avec_infos_massif=1;
$conditions->avec_liste_polygones="montagnarde";

// trie par polygones, autrement dit par massifs
// utile pour faire des listes séparées 
$conditions->ordre="liste_polygones"; 

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
                case 'id_massif':
                    $conditions->ids_polygones = $valeur; 
                    break ;
                    
                case 'id_point_type':
                    $conditions->ids_types_point = $valeur ;
                    break;
                    
                case 'champs_trinaires':
                    foreach ( $valeur as $c )
                        $conditions->trinaire->$c = true ; 
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
    if ($points->erreur)
    {
        $vue->erreur=$points->message;
        $vue->type="point_recherche_erreur";
    }
    else
    {
        $vue->nombre_points=sizeof($points);
        
        // FIXME sly : et aller, c'est beau l'abstraction en couche mais pour une recherche, on en est à 3 (4?) fois le parcours des résultats
        if (isset($points))
            foreach ($points as $point)
            {
                $point->lien=lien_point($point,true);
                $vue->points[]=$point;
            }
        //en PG, pas moyen de savoir si on a tapé la limite. Je dis que si on a pile poile le nombre de points, c'est qu'on l'a atteinte ........
        if (!empty($conditions->limite) && $vue->nombre_points == $conditions->limite)
            $vue->limite_atteinte = $conditions->limite;
        
        //-----------------------------------------------------------------------------------------------------
        // Recherche de points sur nominatim.openstreetmap.org
        
        if ($_POST['avec_point_osm'])
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
             'q' => $_POST['nom'],
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
             
             $nominatim->url_site=$config_wri['url_nominatim'];
             $vue->nominatim=$nominatim;
        }
    }
}
else
{
    $vue->erreur="Votre recherche ne contient aucun critère, il devrait au moins y avoir le nom (même vide)";
    $vue->type="point_recherche_erreur";
}
$vue->titre="Recherche sur refuges.info ($vue->nombre_points points trouvés)";
?> 
