<?php 
// Conteneur standard de l'entête et pied de page

switch ($vue->http_status_code) {
	case 403:
		header("HTTP/1.0 403 Forbidden");
		$vue->titre = "Erreur 403 - Vous n'avez pas les droits d'accès à la page \"$controlleur->url_base\"";
		break;

	case 404:
		header("HTTP/1.0 404 Not Found");
		$vue->titre = "Erreur 404 - La page demandée \"$controlleur->url_base\" est introuvable sur refuges.info";

	case 200:
		break;

	default:
		if ($vue->http_status_code)
			$vue->titre = "Erreur ".$vue->http_status_code;
}
?>
