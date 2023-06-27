<?php
/**********************************************************************************************
Pour ajouter un commentaire rattaché à un point
**********************************************************************************************/

require_once ("commentaire.php");
require_once ("point.php");
require_once ("wiki.php");
require_once ("mise_en_forme_texte.php");
require_once ("upload_max_filesize.php");
require_once ("identification.php");

$commentaire = new stdClass();
$conditions_commentaire = new stdClass();
$vue->succes_ajout_commentaire=False;

setlocale(LC_TIME, "fr_FR");
// les modérateurs ont droit d'ajouter des commentaires aux points cachés
if ( est_moderateur() )
    $conditions_commentaire->avec_points_caches=True;

$commentaire->id_point=$controlleur->url_decoupee[1];
$conditions_commentaire->ids_points=$commentaire->id_point;
$point=infos_point($commentaire->id_point,true);

if (empty($point->erreur))
{
  // on force la demande de correction
  if (!empty($_REQUEST['correction'])) 
      $vue->correction=true;
  else
      $vue->correction=False;
  

  // on vient de valider notre formulaire, faisons le nécessaire
  $vue->banni=False;
  $vue->erreur_captcha=False;
  if (!empty($_REQUEST['action'])) 
  {
    $commentaire->texte=stripslashes($_REQUEST['texte']);

    // Si on est connecté, ces valeurs ne sont pas défini, on la passe alors à ''
    $commentaire->auteur_commentaire=stripslashes($_REQUEST['auteur_commentaire'] ?? '');
    $vue->lettre_verification=$_REQUEST["lettre_verification"] ?? '';

    $commentaire->texte_propre=protege($commentaire->texte);
    
    // peut être un robot ?
    if ( ($vue->lettre_verification!="f") AND !est_connecte() )
    {
      $vue->erreur_captcha=True;
      $vue->lettre_verification="";
    }
    else
    {
      // Variables du commentaire à ajouter, presque plus de tests à faire (sauf ceux de contrôle qu'on aurait pas imposé par exemple aux modérateurs), tout est dans la fonction d'ajout de commentaires

      if (is_uploaded_file  ( $file_path=$_FILES['comment_photo']['tmp_name']  ) )
        $commentaire->photo['originale']=$file_path;

      $commentaire->demande_correction=$_REQUEST['demande_correction'] ?? '';
      
      // Et si on trouve un mot clé "censuré" on accepte le message mais on averti les modérateurs qu'il faut aller vérifier le commentaire
      if (isset ($config_wri['censure']) && preg_match ('/'.$config_wri['censure'].'/i', retrait_accents ($commentaire->texte)))
        $commentaire->demande_correction=2;

      // Et si la fiche concerne un batiment en montagne, on le signale systématiquement à un modérateur
      if ($point->id_point_type == $config_wri['id_batiment_en_montagne'])
        $commentaire->demande_correction=3;

      if (est_connecte() and est_entier_positif($infos_identification->user_id)) // l'utilisateur est connecté, il n'est pas anonyme (0) et y'a pas un user_id bizarre
        $commentaire->id_createur_commentaire=$infos_identification->user_id;
        
      // Et si on trouve un mot clé "interdit" on refuse le commentaire complètement
      if (isset ($config_wri['mots_interdits']) && preg_match ('/'.$config_wri['mots_interdits'].'/i', $commentaire->texte))
      {
        $vue->messages = new stdClass;
        $vue->messages->erreur=True;
        $commentaire->message="Il contient un ou des mots clés interdits. En cas de doute venez en parler sur le forum";
      }
      else
      // On tente d'ajouter le commentaire, qui peut retourner une erreur au besoin (point supprimé, erreur technique, ...)
        $vue->messages=modification_ajout_commentaire($commentaire);

      // ça semble avoir marché, on vide juste son texte qu'il puisse ressaisir un commentaire
      if (empty($vue->messages->erreur))
      {
        $commentaire->texte_propre="";
        $vue->succes_ajout_commentaire=True;
      }
      else 
      {
        $vue->type = "page_simple";
        $vue->contenu="Impossible d'ajouter ce commentaire car : $commentaire->message";   
        return;
      }

      // Nettoyage de la photo envoyée qu'elle fût ou non insérée correctement comme commentaire
      if (is_uploaded_file  ( $file_path))
        unlink($file_path);
    }
  }
  // Qu'on arrive juste ou que l'on vienne déjà de rentrer un premier commentaire, on affiche le formulaire (rappel paramètres si erreur, vide si nouveau commentaire de +)

  $quel_point="$point->article_defini $point->nom_type : ".protege($point->nom);
  $vue->titre="Ajout d'un commentaire sur $quel_point";
  $vue->lien_point=lien_point($point);
  $vue->lien_texte_retour="Retour à $quel_point";
  $vue->point_existe=True;
  $vue->commentaire=$commentaire;
  $vue->lien_wiki_que_mettre=lien_wiki('que_mettre');
  $vue->lien_wiki_restriction_licence=lien_wiki('restriction_licence');
  $vue->lien_forum_point=$config_wri['forum_refuge'].$point->topic_id;
}
else // Une erreur est survenue sur le point concerné, ne permettons pas d'ajouter un commentaire dans le vent !
{
  $vue->http_status_code = 404;
  $vue->type = "page_simple";
  $vue->titre="Impossible d'ajouter un commentaire car : $point->message";
}

