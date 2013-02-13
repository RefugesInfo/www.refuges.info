<?php
/**********************************************************************************************
Pour ajouter un commentaire rattaché à un point
**********************************************************************************************/

require_once("modeles/config.php");
require_once ($config['chemin_modeles']."fonctions_autoconnexion.php");
require_once ($config['chemin_modeles']."fonctions_affichage_points.php");
require_once ($config['chemin_modeles']."fonctions_commentaires.php");
require_once ($config['chemin_modeles']."fonctions_points.php");
require_once ($config['chemin_modeles']."fonctions_mode_emploi.php");

setlocale(LC_TIME, "fr_FR");
$commentaire->id_point=$_GET['id_point'];
$point=infos_point($commentaire->id_point);
if ($point!=-1)
{
  if (!isset($_SESSION['id_utilisateur']))
    $modele->non_connecte=True;
  $commentaire->auteur=$_SESSION['login_utilisateur'];
  
  // on vient de valider notre formulaire, faisons le nécessaire
  if ($_POST['action']!="") 
  {
    $commentaire->texte=stripslashes($_POST['comment_texte']);
    $commentaire->auteur=stripslashes($_POST['comment_auteur']);
    $commentaire->texte_propre=htmlspecialchars($commentaire->texte,0,"UTF-8");
    $modele->lettre_verification=$_POST["lettre_verification"];

    // peut être un robot ?
    if ( ($modele->lettre_verification!="f") AND !isset($_SESSION['id_utilisateur']) )
    {
      $model->erreur_captcha=True;
      $modele->lettre_verification="";
    }
    else if (bloquage_internaute($_POST['comment_auteur']))  // utilisateur dont l'adresse IP est bannie
      $model->banni=True;
    else
    {
      // c'est quoi ça ?
      set_magic_quotes_runtime(0);
      // Variables du commentaire à ajouter, presque plus de tests à faire, tout est dans la fonction d'ajout de
      // commentaires
      
      if (is_uploaded_file  ( $file_path=$_FILES['comment_photo']['tmp_name']  ) )
	$commentaire->photo['originale']=$file_path;
      $commentaire->demande_correction=$_POST['demande_correction'];
      $commentaire->id_createur=$_SESSION['id_utilisateur'];
      // Transmission des info en cas d'erreur au modèle
      $modele->messages=modification_ajout_commentaire($commentaire);
      
      // ça semble avoir marché, on vide juste son texte qu'il puisse ressaisir un commentaire
      if (!$modele->messages->erreur)
	$commentaire->texte_propre="";

      // Nettoyage de la photo envoyée qu'elle fût ou non insérer correctement comme commentaire
      if (is_uploaded_file  ( $file_path))
	unlink($file_path);
    }
  }
  // Qu'on arrive juste ou que l'on vienne de rentrer un point, on affiche le formulaire (rappel paramètres si erreur, vide si nouveau commentaire de +)
  if ( !isset($_SESSION['id_utilisateur']) )
    $modele->captcha=True;
  
  $quel_point="$point->article_defini $point->nom_type : $point->nom";
  $modele->titre="Ajout d'un commentaire sur $quel_point";
  $modele->lien_point=lien_point_lent($id_point);
  $modele->lien_texte_retour="Retour à $quel_point";
  $modele->point_existe=True;
  $modele->commentaire=$commentaire;
}
else
  $modele->point_existe=False;

$modele->type = 'point_ajout_commentaire'; // Le type
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");
?> 
