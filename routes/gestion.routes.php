<?php
/**************************************************
 *              ROUTEUR de la gestion
 * Ce fichier appelle juste le bon controlleur.
 * La vue et le modèle sont appellés par le controlleur.
 * cf. : http://bpesquet.developpez.com/tutoriels/php/evoluer-architecture-mvc/images/3.png
 *
 * Changelog :
 *   * 08/05/2017 - Dom - Version intiale :
 *          découpage URL, redirection sur le bon
 *          controleur.
 * 
**************************************************/

require_once ('identification.php');

// Par défaut
$controlleur->type = 'page_simple';

switch ($controlleur->url_decoupee[1]) {
	case 'moderation': // cas spécial de "moderation" qui est autorisée aussi à l'auteur de son propre commentaire. Peut-être qu'il faudrait d'ailleurs sortir ça de la /gestion qui pourrait alors être réservée à 100% aux modérateurs, là, ça oblige une petite condition sur mesure
    $controlleur->type = 'gestion/'.$controlleur->url_decoupee[1];
    break;

	case 'liste_pages_wiki':
	case 'modifier_modeles':
	case 'commentaires_attente_correction':
	case 'historique_modifications':
	case 'historique_envoi_emails':
		if (est_moderateur())
			$controlleur->type = 'gestion/'.$controlleur->url_decoupee[1];
        else
        {
          $vue->http_status_code = 403;        
          $vue->interdit_raison = ", vous devez être un modérateur du site, pour accéder à cette page, êtes vous bien connecté ?";
        }
    break;

	default:
		$vue->http_status_code = 404;
}

