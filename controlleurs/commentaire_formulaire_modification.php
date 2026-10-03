<?php
/***
Contrôleur du formulaire de modification d'un commentaire (par un modérateur ou par son auteur)
Le formulaire envoie ses actions à commentaire_modification.php, comme point_formulaire_modification -> point_modification
***/

add_lib('style_formulaire.css');
add_lib('point_ajout_commentaire.js'); // sélecteur de photo (pilule, glisser-déposer, aperçu)

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
  $vue->point=infos_point($_REQUEST['id_point_retour'] ?? Null,true);
  $vue->utilisateurs=infos_utilisateurs();
}
