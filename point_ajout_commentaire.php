<?php
/**********************************************************************************************
Pour ajouter un commentaire rattaché à un point
**********************************************************************************************/

require_once("modeles/config.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_commentaires.php");
require_once ("fonctions_points.php");
require_once ("fonctions_mode_emploi.php");

$vue = new stdClass();
$commentaire = new stdClass();
setlocale(LC_TIME, "fr_FR");
$commentaire->id_point=$_GET['id_point'];
$point=infos_point($commentaire->id_point);
if ($point!=-1)
{
  if (!isset($_SESSION['id_utilisateur']))
    $vue->non_connecte=True;
  $commentaire->auteur=$_SESSION['login_utilisateur'];
  
  // on vient de valider notre formulaire, faisons le nécessaire
  if ($_POST['action']!="") 
  {
    $commentaire->texte=stripslashes($_POST['comment_texte']);
    $commentaire->auteur=stripslashes($_POST['comment_auteur']);
    $commentaire->texte_propre=htmlspecialchars($commentaire->texte,0,"UTF-8");
    $vue->lettre_verification=$_POST["lettre_verification"];

    // peut être un robot ?
    if ( ($vue->lettre_verification!="f") AND !isset($_SESSION['id_utilisateur']) )
    {
      $vue->erreur_captcha=True;
      $vue->lettre_verification="";
    }
    else if (bloquage_internaute($_POST['comment_auteur']))  // utilisateur dont l'adresse IP est bannie
		$vue->banni=True;
    else
    {
      // c'est quoi ça ?
      //set_magic_quotes_runtime(0); //jmb deprecated PHP5.4.
      // Variables du commentaire à ajouter, presque plus de tests à faire, tout est dans la fonction d'ajout de
      // commentaires
      
      if (is_uploaded_file  ( $file_path=$_FILES['comment_photo']['tmp_name']  ) )
	$commentaire->photo['originale']=$file_path;
      $commentaire->demande_correction=$_POST['demande_correction'];
      $commentaire->id_createur=$_SESSION['id_utilisateur'];
      // Transmission des info en cas d'erreur au modèle
      $vue->messages=modification_ajout_commentaire($commentaire);
      
      // ça semble avoir marché, on vide juste son texte qu'il puisse ressaisir un commentaire
      if (!$vue->messages->erreur)
	$commentaire->texte_propre="";

      // Nettoyage de la photo envoyée qu'elle fût ou non insérer correctement comme commentaire
      if (is_uploaded_file  ( $file_path))
	unlink($file_path);
    }
  }
  // Qu'on arrive juste ou que l'on vienne de rentrer un point, on affiche le formulaire (rappel paramètres si erreur, vide si nouveau commentaire de +)
  if ( !isset($_SESSION['id_utilisateur']) )
    $vue->captcha=True;
  
  $quel_point="$point->article_defini $point->nom_type : $point->nom";
  $vue->titre="Ajout d'un commentaire sur $quel_point";
  $vue->lien_point=lien_point_fast($point);
  $vue->lien_texte_retour="Retour à $quel_point";
  $vue->point_existe=True;
  $vue->commentaire=$commentaire;
}
else
  $vue->point_existe=False;

$vue->type = 'point_ajout_commentaire'; // Le type
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$vue->type.html");
include ($config['chemin_vues']."_pied.html");
?> 
