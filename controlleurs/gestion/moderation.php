<?php
/***
Contrôleur qui prépare la vue pour les pages de moderation des points
***/

require_once ('commentaire.php');
require_once ('mise_en_forme_texte.php');

// Traitement des actions
switch($_REQUEST['type'])
{
	case 'modification':
		$commentaire->texte=stripslashes($_REQUEST['texte']);
		$commentaire->auteur_commentaire=stripslashes($_REQUEST['auteur_commentaire']);
		//On suppose qu'après modification par qui que ce soit, on ne veut plus forcément prévenir un modérateur
		//et si c'est le modérateur qui fait la modif, on suppose qu'il à fait la correction.
		$commentaire->demande_correction=0;
		$vue->retour=modification_ajout_commentaire($commentaire);
		break;

	case 'transfert_forum':
		// D'abord on le modifie si des changements ont été faits
		$commentaire->texte=stripslashes($_REQUEST['texte']);
		$commentaire->auteur_commentaire=stripslashes($_REQUEST['auteur_commentaire']);
		$vue->retour=modification_ajout_commentaire($commentaire);

		// ensuite on le transfert sur le forum
		$vue->retour=transfert_forum($commentaire);
		break;

	case 'suppression':
		$vue->retour=suppression_commentaire($commentaire);
		break; 

	case 'transfert_autre_point':
		// On le modifie si des changements ont été faits, puis on change d'id point pour le transférer vers une autre fiche
		$commentaire->texte=stripslashes($_REQUEST['texte']);
		$commentaire->auteur_commentaire=stripslashes($_REQUEST['auteur_commentaire']);
		$commentaire->id_point=$_REQUEST['id_autre_point'];
		$vue->retour=modification_ajout_commentaire($commentaire);
		if (!$vue->retour->erreur)
			$retour->message='ce commentaire a été déplacé sur la fiche de <a href="'.lien_point_lent($commentaire->id_point).'">Ce point</a>';
		break;

	case 'suppression_photo':
		$vue->retour=suppression_photos($commentaire);
		break;
}
?>
