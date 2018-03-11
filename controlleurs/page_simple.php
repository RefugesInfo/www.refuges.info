<?php 
// Conteneur standard de l'entête et pied de page

// sly: Pour les erreurs sans plus d'info de type route inexistante ou authentification en erreur, un message générique.
// sly: Il reste possible de toute façon de générer un 404 avec une page sur mesure
switch ($vue->http_status_code) {
	case 403:
		$vue->contenu = $vue->titre = "Erreur 403 - Vous n'avez pas les droits d'accès à la page \"$controlleur->url_base\"";
		break;

	case 404:
		$vue->contenu = $vue->titre = "Erreur 404 - La page demandée \"$controlleur->url_base\" est introuvable sur refuges.info";

}
?>
