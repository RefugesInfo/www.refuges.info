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
	case 'transfert_autre_point':
		$commentaire->id_point=$_REQUEST['id_autre_point'];
        $autre_point=infos_point($_REQUEST['id_autre_point']);
	case 'modification':
	case 'transfert_forum':
	case 'suppression_photo':

		$commentaire->texte=stripslashes($_REQUEST['texte']);
		$commentaire->auteur_commentaire=stripslashes($_REQUEST['auteur_commentaire']);
		if (!empty($commentaire->id_createur_commentaire))
          $commentaire->id_createur_commentaire=stripslashes($_REQUEST['id_createur']);
          
		$commentaire->rotation=$_REQUEST['rotation'];
		
		// On suppose qu'après modification par un modérateur il a fait les corrections nécessaires et qu'il n'est plus besoin de lister ce commentaire dans les demandes de modération.
		// le but est de gagner du temps aux modérataurs qui n'ont pas besoin d'aller retirer manuellement de la liste des tâches à faire.
		if (est_moderateur())
          $commentaire->demande_correction=0;
          
        // On applique toutes les modifications, la fonction s'occupant de retourner une éventuelle erreur et un message en testant presque tous les cas possible (point inexistant, commentaire vide, ...)  
		$vue->retour=modification_ajout_commentaire($commentaire);
		
		if ($_REQUEST['type'] == 'transfert_forum') 		// ensuite on le transfert sur le forum (si cela échoue, un message d'erreur est retourné)
          $vue->retour=transfert_forum($commentaire);
                
		if ($_REQUEST['type'] == 'suppression_photo') 		// et on supprime la photo
          $vue->retour=suppression_photos($commentaire);
        break;
     

	case 'suppression':
		$vue->retour=suppression_commentaire($commentaire);
		break; 
}


$vue->point=infos_point($_REQUEST['id_point_retour']);
$vue->utilisateurs=infos_utilisateurs();
