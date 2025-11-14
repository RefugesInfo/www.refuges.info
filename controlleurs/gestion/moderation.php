<?php
/***
Contrôleur qui prépare la vue pour les pages de moderation des commentaires
FIXME Réflexion rangement 2025 : je trouve bizarre que l'on soit toujours dans /gestion, depuis qu'un utilisateur peut modifier son propre commentaire, on devrait traiter ça comme les points du site et ranger ça ailleurs que dans /gestion non ?

***/

require_once ('forum.php');
require_once ('commentaire.php');
require_once ('mise_en_forme_texte.php');

$commentaire = infos_commentaire($_REQUEST['id_commentaire'],true);

/*** On vérifie d'abord que ce commentaire existe bien (qu'il n'a pas été supprimé entre temps, qu'on tente pas de nous arnaquer) ***/
if (!empty($commentaire->erreur))
{
  $vue->http_status_code = 404;
  $vue->type = "page_simple";
  $vue->titre= "Erreur 404 : commentaire introuvable";
  $vue->contenu=$commentaire->message;
}
else
{
  /*** Ce commentaire existe bel et bien, on vérifie maintenant qu'on a les droits de le modifier ***/
  if ( !est_autorise($commentaire->id_createur_commentaire))
  {
    $vue->http_status_code = 403;
    $vue->type = "page_simple";
    $vue->titre= "Erreur 403 : droit insuffisants";
    $vue->contenu ="Pour modifier le commentaire d'id=$commentaire->id_commentaire, soit ça doit être le votre, soit vous devez être modérateur global, êtes vous bien connecté ?";
  }
  else
  {
  /*** Ce commentaire existe et on a les droits de le modifier, on continue les traitements ***/
  $controlleur->type = 'gestion/moderation';
  // Traitement des actions
  if (!empty($_REQUEST['type']))
    switch ($_REQUEST['type'])
    {
      case 'transfert_autre_point':
        $commentaire->id_point=$_REQUEST['id_autre_point'] ?? Null;
        $autre_point=infos_point($commentaire->id_point);

      case 'modification':
      case 'transfert_forum':
      case 'suppression_photo':
        $commentaire->texte=stripslashes($_REQUEST['texte'] ?? "");
        $commentaire->auteur_commentaire=stripslashes($_REQUEST['auteur_commentaire'] ?? "");

        if (est_moderateur()) // Seul les modérateurs ont le droit de changer la date d'un commentaire
          $commentaire->date = $_REQUEST['date'] ?? Null;

        if (est_moderateur()) // Seuls les modérateurs ont le droit de changer le user d'un commentaire
          $commentaire->id_createur_commentaire=$_REQUEST['id_createur_commentaire'] ?? 0;

        $commentaire->rotation = $_REQUEST['rotation'] ?? Null;

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
    }
    $vue->point=infos_point($_REQUEST['id_point_retour'] ?? Null,true);
    $vue->utilisateurs=infos_utilisateurs();
  }
}
