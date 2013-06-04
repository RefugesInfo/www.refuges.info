<?php
//-----------------------------------------------
// Modif des commentaires
//----------------------------------------

require_once ("../includes/config.php");
require_once ($config['chemin_modeles']."fonctions_commentaires.php");
require_once ($config['chemin_modeles']."fonctions_mode_emploi.php");
//Pas d'accès direct à la page !
if (AUTH!=1)
	die("<h3>Accès non autorisé</h3>");

// si nous n'avons pas un modérateur, nous vérifions si il s'agit bien de son commentaire
$commentaire=infos_commentaire($_REQUEST['id_commentaire'],True);

if ($commentaire->erreur)
  die($commentaire->message);

if ($commentaire->id_createur_commentaire==$_SESSION['id_utilisateur'])
  $autorisation=True;
else if ($_SESSION['niveau_moderation']>=1)
  $autorisation=TRUE;
else
  $autorisation=FALSE;

if ( !$autorisation )
	die ("<h3>Impossible d'accéder à cette page vous n'y êtes pas autorisé</h3>");
else
	echo "<h3>Modération des commentaires</h3>\n";

// on vient ici par 3 moyens:
//	  -type=transfert
//	  -type=modif
//	  -type=suppression
// 	  -on vient d'arriver: ya pas de type. default. on affiche le formulaire.

switch($_REQUEST['type'])
{
  case "transfert_forum":
	$retour=transfert_forum($commentaire);
	print("<h4>$retour->message</h4>");
  break;

  case "modification":
    $commentaire->texte=stripslashes($_REQUEST["texte"]);
    $commentaire->auteur_commentaire=stripslashes($_REQUEST["auteur_commentaire"]);
    //On suppose qu'après modification par qui que ce soit, on ne veut plus forcément prévenir un modérateur
    //et si c'est le modérateur qui fait la modif, on suppose qu'il à fait la correction.
    $commentaire->demande_correction=0;
    $retour=modification_ajout_commentaire($commentaire);
    print("<h4>$retour->message</h4>");
  break;

  case "suppression":
	$retour=suppression_commentaire($commentaire);
	print("<h4>$retour->message</h4>");
    break; 

  case "transfert_autre_point":
	$commentaire->id_point=$_REQUEST['id_autre_point'];
	$retour=modification_ajout_commentaire($commentaire);
	if ($retour->erreur)
		$message=$retour->message;
	else
		$message="ce commentaire a été déplacé sur la fiche de <a href='".lien_point_lent($commentaire->id_point)."'>Ce point</a>";
	print("<h4>$message</h4>");
	break;
  case "suppression_photo":
	$retour=suppression_photos($commentaire);
	print("<h4>$retour->message</h4>");
  break;

  default:
	// affichage du formulaire de modif
	echo "
	<p>
	Vous entrez dans la zone de modération qui va vous permettre de modifier un commentaire ou de le déplacer vers le forum dans la section correspondant au point
	</p>
	<h4>le commentaire est :</h4>
	<blockquote>";
	if ($commentaire->photo_existe==1)
		echo "<img
				src='".$config['rep_web_photos_points'].$commentaire->id_commentaire.".jpeg'
				alt='photo liée au commentaire'
				width='200px' /><br />\n";
	echo nl2br($commentaire->texte)."</blockquote>\n";
	// formulaire qui contient uniquement le comment
	echo "
	<form method='POST'>
		<input type='hidden' name='page' value='moderation' /> <!-- pour qu'il re appelle la page de moderation -->
		<label>
			auteur:
			<input type='text' name='auteur_commentaire' value='$commentaire->auteur_commentaire' />
		</label>
		<label>
			date:
			<input type='text' disabled='disabled' name='date' value='".date('d/m/Y H:i',$commentaire->ts_unix_commentaire)."' size='16'/>
		</label>
		<textarea name='texte' rows='10' cols='100'>".htmlspecialchars($commentaire->texte,0,"UTF-8")."</textarea>
		<br />

		<!-- tout cela n'est ptet pas necessaire -->
		<input type='hidden' name='id_commentaire' value='".$_REQUEST['id_commentaire']."' />
		<input type='hidden' name='id_point_retour' value='".$_REQUEST['id_point_retour']."' />

		<!-- 4 actions possible -->
		<input name='type' value='modification' type='submit' />
		<input name='type' value='transfert_forum' type='submit' />
		<input name='type' value='suppression' type='submit' />\n";
if ($commentaire->photo_existe==1)
	echo "\t\t<input name='type' value='suppression_photo' type='submit' />\n";

		echo "\t\t".'<br />
		<input name="type" value="transfert_autre_point" label="x" type="submit" />
		Indiquez le numéro de l\'autre point :<input type="text" name="id_autre_point" value="" size="16"/>';
	echo "
	</form>
	<p>
		'suppression' entraine la suppression de la photo.
		'transfert_forum' entraîne le déplacement de la photo vers le forum ET prends en compte les modifications
	</p>
	<!--<a href=\"./?page=moderation&amp;type=suppression&amp;vider=1&amp;id_commentaire=".$_REQUEST['id_commentaire']."&amp;id_point_retour=".$_REQUEST['id_point_retour']."\">supprimer le commentaire</a>-->";

} // fin du switch

print("<a href=\"".lien_point_lent($_REQUEST['id_point_retour'])."\">Retour au point</a>");
$commentaire=infos_commentaire($_REQUEST['id_commentaire']);
?>
