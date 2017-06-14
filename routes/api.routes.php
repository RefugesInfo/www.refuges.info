<?php
/**************************************************
 *              ROUTEUR de l'API
 * Ce fichier appelle juste le bon controlleur.
 * La vue et le modèle sont appellés par le controlleur.
 * cf. : http://bpesquet.developpez.com/tutoriels/php/evoluer-architecture-mvc/images/3.png
 *
 * Changelog :
 *   * 18/10/2014 - Léo - Version intiale :
 *          découpage URL, redirection sur le bon
 *          controleur.
 * 
**************************************************/

// Cible sera le contenu de l'URL entre /api/ et ?argument=
$cible = $controlleur->url_decoupee[1];
$cible = str_replace($_SERVER['QUERY_STRING'],'',$cible); // On enlève ce qu'il y a après le ?
$cible = str_replace('?','',$cible); // On enlève le ? (implique pas de ? dans les noms de fichiers)

switch ($cible) {
    case 'bbox': case 'point': case 'massif':
        include($config_wri['chemin_controlleurs'].'api/points.php');
        break;
    case 'contributions':
        include($config_wri['chemin_controlleurs'].'api/contributions.php');
        break;
    case 'polygones':
        include($config_wri['chemin_controlleurs'].'api/polygones.php');
        break;
    case 'doc':
        // Des fichiers html ou css simples, pas besoin d'un controler pour faire "include"
        if ($controlleur->url_decoupee[2] == "")
            include($config_wri['chemin_vues'].'api/doc/index.html');
        else 
            include($config_wri['chemin_vues'].'api/doc/'.$controlleur->url_decoupee[2]);
        
        break;
    default:
        header('Location:doc/');
        break;
}

?>
