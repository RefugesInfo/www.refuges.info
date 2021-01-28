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

// Par défaut
$controlleur->type = 'page_simple';

// C'est le point unique qui contrôle les autorisations de toutes les URL /gestion...
switch ($controlleur->url_decoupee[1]) {
	case 'moderation':
		$commentaire = infos_commentaire($_REQUEST['id_commentaire'],true);
		if ($commentaire->id_createur_commentaire === $_SESSION['id_utilisateur'] OR $_SESSION['niveau_moderation'])
			$controlleur->type = 'gestion/moderation';
        else
        {
          $vue->http_status_code = 403;
          $vue->interdit_raison =", pour modifier un commentaire, soit ça doit être le votre, soit vous devez être modérateur global, êtes vous bien connecté ?";
        }
    break;

	case 'modifier_modeles':
	case 'commentaires_attente_correction':
	case 'historique_modifications':
		if ($_SESSION['niveau_moderation'])
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

