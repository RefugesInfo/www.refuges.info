<?php
/***
Contrôleur de l'action de modification d'un commentaire (par un modérateur ou par son auteur)
On arrive ici depuis commentaire_formulaire_modification, comme point_formulaire_modification -> point_modification
Actions possibles : modification, suppression_photo, transfert_forum, transfert_autre_point, suppression
***/

require_once ('forum.php');
require_once ('commentaire.php');
require_once ('mise_en_forme_texte.php');

$commentaire = infos_commentaire($_REQUEST['id_commentaire'] ?? 0,true);

/*** On vérifie d'abord que ce commentaire existe bien (qu'il n'a pas été supprimé entre temps, qu'on tente pas de nous arnaquer) ***/
if (!empty($commentaire->erreur))
{
  $vue->http_status_code = 404;
  $vue->type = "page_simple";
  $vue->titre= "Erreur 404 : commentaire introuvable";
  $vue->contenu=$commentaire->message;
}
/*** Ce commentaire existe bel et bien, on vérifie maintenant qu'on a les droits de le modifier ***/
elseif ( !est_autorise($commentaire->id_createur_commentaire))
{
  $vue->http_status_code = 403;
  $vue->type = "page_simple";
  $vue->titre= "Erreur 403 : droit insuffisants";
  $vue->contenu ="Pour modifier le commentaire d'id=$commentaire->id_commentaire, soit ça doit être le votre, soit vous devez être modérateur global, êtes vous bien connecté ?";
}
else
{
  /*** Ce commentaire existe et on a les droits de le modifier, on continue les traitements ***/
  // La case « Supprimer la photo » cochée avec le bouton « Modifier » : même traitement que modifier puis supprimer la photo
  if (($_REQUEST['type'] ?? '') == 'modification' and !empty($_REQUEST['supprimer_photo']))
    $_REQUEST['type']='suppression_photo';

  // Une action ne se déclenche que depuis le formulaire (POST), pas par un simple lien
  if ($_SERVER['REQUEST_METHOD'] != 'POST' or empty($_REQUEST['type']))
    $vue->retour=erreur("Aucune action demandée, utilisez le formulaire de modification du commentaire");
  else
    switch ($_REQUEST['type'])
    {
      case 'transfert_autre_point':
        $commentaire->id_point=$_REQUEST['id_autre_point'] ?? Null;
        $autre_point=infos_point($commentaire->id_point);
        if (!empty($autre_point->erreur))
        {
          $vue->retour=erreur("Transfert du commentaire impossible, car le point de destination indique : $autre_point->message");
          break;
        }

      case 'modification':
      case 'transfert_forum':
      case 'suppression_photo':
        $commentaire->texte=stripslashes($_REQUEST['texte'] ?? "");
        $commentaire->auteur_commentaire=stripslashes($_REQUEST['auteur_commentaire'] ?? "");

        if (est_moderateur()) // Seul les modérateurs ont le droit de changer la date d'un commentaire
          // Le sélecteur de date (datetime-local) envoie "2026-10-03T17:09:26", la base attend un espace
          $commentaire->date = str_replace('T', ' ', $_REQUEST['date'] ?? '') ?: Null;

        if (est_moderateur()) // Seuls les modérateurs ont le droit de changer le user d'un commentaire
          $commentaire->id_createur_commentaire=$_REQUEST['id_createur_commentaire'] ?? 0;

        $commentaire->rotation = $_REQUEST['rotation'] ?? Null;

        // Remplacement de la photo (inutile si on demande justement à la supprimer) : la fonction détecte que c'est une nouvelle photo et refait les versions réduite et vignette
        if ($_REQUEST['type'] != 'suppression_photo' and is_uploaded_file($_FILES['comment_photo']['tmp_name'] ?? ''))
          $commentaire->photo['originale']=$_FILES['comment_photo']['tmp_name'];

        // On applique toutes les modifications, la fonction s'occupant de retourner une éventuelle erreur et un message en testant presque tous les cas possible (point inexistant, commentaire vide, ...)
        $vue->retour=modification_ajout_commentaire($commentaire);

        if ($_REQUEST['type'] == 'transfert_forum') // ensuite on le transfert sur le forum (si cela échoue, un message d'erreur est retourné)
          $vue->retour=transfert_forum($commentaire);

        if ($_REQUEST['type'] == 'suppression_photo') // et on supprime la photo
          $vue->retour=suppression_photos($commentaire);
        break;

      case 'suppression':
        $vue->retour=suppression_commentaire($commentaire);
        break;

      default:
        $vue->retour=erreur("Action inconnue : ".protege($_REQUEST['type']));
    }

  $vue->point=infos_point($_REQUEST['id_point_retour'] ?? Null,true);
}
