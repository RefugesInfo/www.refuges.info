<?php
/***
Contrôleur qui prépare la vue pour les pages de moderation des points
***/

require_once ('forum.php');
require_once ('commentaire.php');
require_once ('mise_en_forme_texte.php');

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
