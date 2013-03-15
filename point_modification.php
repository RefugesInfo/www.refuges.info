<?php
/**********************************************************************************************
Page de modification d'un point
sly 26/11/2012 : FIXME à basculer sur le système des modèles (=séparation traitement/HTML)
jmb 16/02/13 : un peu de re ecriture du bazar avec des gros Switch

3 cas pour arriver ici, toujours depuis point_formulaire_modification:
-Creation d'un point
-Modification d'un point
-suppression d'un point
**********************************************************************************************/

require_once("modeles/config.php");
require_once ("fonctions_points.php");
require_once ("fonctions_autoconnexion.php");
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
		$point = new stdClass;
		foreach ($_REQUEST as $nom => $value)
			$point->$nom=stripslashes(trim($value));
    
		if ($_REQUEST["action"] == 'Ajouter')
		{
			// Etant donné que des robots, ou des peu scrupuleux remplissent avec des faux points, on les vire ici
			if ( !isset($_SESSION['id_utilisateur']) AND ($_REQUEST['lettre_securite']!="d") ) 
			{
				$html .= "<h4>! ERREUR ! vous n'avez pas rentré la lettre demandée</h4>";
				break; // break le switch, au dessus des if
			}
			$verbe = 'ajouté ' ;
			//$point->id_createur = isset($_SESSION['id_utilisateur']) ? $_SESSION['id_utilisateur'] : 0 ;
		}
    
        // crade, mais trop de retard. verrai ca plus tard.
        if ( !is_numeric($point->places_matelas) && $point->places_matelas != "NULL" )
            $point->places_matelas = "0" ; // bug : cast d'une string vers 0

        // modification ou création du point
		$retour = modification_ajout_point($point);
    
		if ($retour->erreur) 
			$html .= "<p><strong>$retour->message</strong></p>";
		else
		{
			$retourid = $retour; // id du point modifié/supprimé
			$html.="<h4>Merci de votre contribution</h4>
			<h5>le point est ";
			if ( isset($verbe) ) 
				$html.=$verbe;
			$html.="dans la base</h5>";
			$html.="<p><a href=\"".lien_point_lent($retourid)."\">Cliquez ici pour voir la fiche</a></p>";
			/* COMMENTÉ TEMPORAIREMENT : sera ré-activé, d'une autre façon sans doute, sur la zone dev -- sly
			$html.="<p>
			<h5>Pour continuer :</h5>
			<a href='/point_formulaire_modification.php?dupliquer=$retourid'> Dupliquer un autre point d'information au même endroit</a></p>";
                        */
		}
		break;

	case 'supprimer':
		$html .= "<h3>Suppression d'un point</h3>";
		$point=infos_point($_REQUEST['id_point']);
		suppression_point($point);
		$html.="<h4>Le point \"$point->nom\" a été supprimé !</h4>";
		break;
} 
$html .="</div>";

print($html);
require_once ($config['chemin_vues']."_pied.html");
?>  
