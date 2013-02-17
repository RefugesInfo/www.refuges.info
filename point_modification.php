<?php
/**********************************************************************************************
Page de modification d'un point
sly 26/11/2012 : FIXME à basculer sur le système des modèles (=séparation traitement/HTML)
jmb 16/02/13 : un peu de re ecriture du bazar avec des gros Switch
**********************************************************************************************/

/*************************************
3 cas pour arriver ici, toujours depuis point_formulaire_modification:
-Creation d'un point
-Modification d'un point
-suppression d'un point
*************************/

require_once("modeles/config.php");
require_once ($config['chemin_modeles']."fonctions_points.php");
require_once ($config['chemin_modeles']."fonctions_affichage_points.php");
require_once ($config['chemin_modeles']."fonctions_autoconnexion.php");
require_once ($config['chemin_vues']."_entete.html");

$html="<div class=\"contenu\">
";

switch( $_REQUEST["action"] )
{
	case 'Modifier' :
		$verbe = 'modifié '; // viendra s'accoller a "est <..> dans la base.... kes kon fait pas pour gagner du code
	case 'Ajouter' :
		$html .= "<h3>".$_REQUEST["action"]." un point</h3>";
		
		// on rempli l'object $point à mettre à jour/ajouter en fonction des paramètres POST
		// si l'id_point peut être vide, cela indiquera une création 
		// ATTENTION BIDOULLE si on fait attention à ce que le nom des champs correspondent, on gagne du temps avec :
		// Il y aura bien quelques trucs en trop, mais la fonction modification ne s'en servira pas
		foreach ($_REQUEST as $nom => $value)
			$point->$nom=stripslashes(trim($value));

		if ($_REQUEST["action"] == 'Ajouter')
		{
			// Etant donné que des robots, ou des peu scrupuleux remplissent avec des faux points, on les vire ici
			if ( !isset($_SESSION['id_utilisateur']) AND ($_REQUEST['lettre_securite']!="d") ) {
				$html .= "<h4>! ERREUR ! vous n'avez pas rentré la lettre demandée</h4>";
				break; // break le switch, au dessus des if
			}
			$verbe = 'ajouté ' ;
			$point->id_createur = isset($_SESSION['id_utilisateur']) ? $_SESSION['id_utilisateur'] : 0 ;
		}

		// fais le boulot
		$retour = modification_ajout_point($point);
	
		switch ($retour) 
		{
			case "erreur_nom" :
				$html .= "<p><strong>Le nom du point ne peut être vide</strong></p>"; break;
			case "erreur_point_inexistant" :
				$html .= "<p><strong>Le point que vous tentez de modifier n'existe pas</strong></p>"; break;
			case "erreur_latitude_vide" :
			case "erreur_latitude_non_numerique" :
				$html .= "<p><strong>Les coordonnées rentrées sont incorrecte, si vous rentrez des coordonnées approximatives, essayez de mettre une latitude et longitude approximative</strong></p>"; break;
		}
		//$ret->id_point = $retour; // id du point modifie/supprime
		$retourid = $retour; // id du point modifie/supprime
		
		// Blahblah
		$html.="<h4>Merci de votre contribution</h4>
			<h5>le point est ";
			if ( isset($verbe) ) 
				$html.=$verbe;
		$html.="dans la base</h5>";
		$html.="<p><a href=\"".lien_point_lent($retourid)."\">Cliquez ici pour voir la fiche</a></p>";
		$html.="<p>
				<h5>Pour continuer :</h5>
				<a href='/point_formulaire_modification.php?dupliquer=$point->id_point'> Dupliquer un autre point d'information au MEME endroit</a></p>";
		break;
		//$ret->html = $html ;
		//return $ret;

	case 'supprimer':
		$html .= "<h3>Suppression d'un point</h3>";
			suppression_point($_REQUEST['id_point']);
		$html.="<h4>Le point choisi a été supprimé !</h4>";
		break;
} // fin du switch action
		

	// FIXME a partir d'ici le code n'est vraiment pas beau, il doit y avoir moyen de se passer
	// du switch est de fusionner Ajouter et Modifier puisque la fonction modification_ajout_point fait déjà
	// tout le boulot
/*	function faire_boulot($point)
	{
	//var_dump($point);
	
		$retour=modification_ajout_point($point);
		if ($retour=="erreur_nom")
			$html.="<p><strong>Le nom du point ne peut être vide</strong></p>";
		if ($retour=="erreur_point_inexistant")
			$html.="<p><strong>Le point que vous tentez de modifier n'existe pas</strong></p>";
		if ($retour=="erreur_latitude_vide" or $retour=="erreur_latitude_non_numerique")
			$html.="<p><strong>Les coordonnées rentrées sont incorrecte, si vous rentrez des coordonnées approximatives, essayez de mettre une latitude et longitude approximative</strong></p>";

		$ret->html=$html;
		$ret->id_point=$retour;
		return $ret;
	}

$texte_duplication="<p>
<h5>Pour continuer :</h5>
<a href='/point_formulaire_modification.php?dupliquer=$point->id_point'> Dupliquer un autre point d'information au MEME endroit</a></p>";
switch ($_REQUEST["action"]) // le bouton ajouter ou modifier ou supprimer
{
  case 'Ajouter':
    $html .= "<h3>Ajout d'un point</h3>";
    // Etant donné que des robots, ou des peu scrupuleux remplissent avec des faux points, on les vire ici
    if ( !isset($_SESSION['id_utilisateur']) AND ($_REQUEST['lettre_securite']!="d") )
      $html.="<h4>! ERREUR ! vous n'avez pas rentré la lettre demandée</h4>";
    else
    {
      $ret=faire_boulot($point);
      if ($ret->html!="")
	$html.=$ret->html;
      else
      {
	$html.="<h4>Merci de votre contribution</h4>
	<h5>le point vient d'être ajouté dans la base</h5>
	<h5>le forum du point a été créé...</h5>\n";
	$html.="<p><a href=\"".lien_point_lent($ret->id_point)."\">Cliquez ici pour voir la fiche qui vient d'etre ajouté</a></p>
	$texte_duplication";
      }
    }
    break;
  case 'Modifier':

    $ret=faire_boulot($point);
    if ($ret->html!="")
      $html.=$ret->html;
    else
    {
      $html .= "<h3>Modification d'un point</h3>";
      $html.="<h4>Merci de votre contribution</h4>
      <h5>le point vient d'être modifié</h5>
      <p><a href=\"".lien_point_lent($ret->id_point)."\">Cliquez ici pour revenir à la fiche modifiée</a></p>
      $texte_duplication";
    }
    break;
  case 'supprimer':
    $html .= "<h3>Suppression d'un point</h3>";
    suppression_point($_REQUEST['id_point']);
    $html.="<h4>Le point choisi a été supprimé !</h4>";
    break;
} // fin du switch action
*/
  
$html .="</div>";

print($html);
  // C'est enregistre, cassos. fini basta.

require_once ($config['chemin_vues']."_pied.html");
?>  
