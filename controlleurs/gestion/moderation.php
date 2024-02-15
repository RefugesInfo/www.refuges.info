<?php
/***
Contrôleur qui prépare la vue pour les pages de moderation des points
***/

require_once ('forum.php');
require_once ('commentaire.php');
require_once ('mise_en_forme_texte.php');

// Traitement des actions
switch ($_REQUEST['type'])
{
	case 'modification':
	case 'transfert_forum':
	case 'transfert_autre_point':
	case 'suppression_photo':

		$commentaire->texte=stripslashes($_REQUEST['texte']);
		$commentaire->auteur_commentaire=stripslashes($_REQUEST['auteur_commentaire']);
		if (!empty($commentaire->id_createur_commentaire))
          $commentaire->id_createur_commentaire=stripslashes($_REQUEST['id_createur']);
		$commentaire->rotation=$_REQUEST['rotation'];
		//On suppose qu'après modification par qui que ce soit, on ne veut plus forcément prévenir un modérateur
		//et si c'est le modérateur qui fait la modif, on suppose qu'il à fait la correction.
		$commentaire->demande_correction=0;
		$vue->retour=modification_ajout_commentaire($commentaire);
		if ($_REQUEST['type'] == 'transfert_forum') 		// ensuite on le transfert sur le forum
          $vue->retour=transfert_forum($commentaire);
          
		if ($_REQUEST['type'] == 'transfert_autre_point') 	// On le modifie si des changements ont été faits, puis on change d'id point pour le transférer vers une autre fiche, si le numéro rentré n'existe pas, une erreur est retournée et le transfert n'a pas lieu
          if (!$vue->retour->erreur)
          {
              $point=infos_point($commentaire->id_point);
              $retour->message='ce commentaire a été déplacé sur la fiche de <a href="'.lien_point($point,true).'">Ce point</a>';
          }
		if ($_REQUEST['type'] == 'suppression_photo') 		// et on supprime la photo
          $vue->retour=suppression_photos($commentaire);
        break;
     

	case 'suppression':
		$vue->retour=suppression_commentaire($commentaire);
		break; 
}


$vue->point=infos_point($_REQUEST['id_point_retour']);
$vue->utilisateurs=infos_utilisateurs();
