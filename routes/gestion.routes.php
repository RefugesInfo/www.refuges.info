<?php
/**************************************************
 *              ROUTEUR de la gestion
 * Ce fichier appelle juste le bon controlleur.
 * La vue et le modèle sont appellés par le controlleur.
 * cf. : https://bpesquet.developpez.com/tutoriels/php/evoluer-architecture-mvc/images/3.png
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

