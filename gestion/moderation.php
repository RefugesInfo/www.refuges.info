<?php
//-----------------------------------------------
// Modif des commentaires
//----------------------------------------

require_once ("../includes/config.php");
require_once ("commentaire.php");
//Pas d'accès direct à la page !
if (AUTH!=1)
	die("<h3>Accès non autorisé</h3>");

// si nous n'avons pas un modérateur, nous vérifions si il s'agit bien de son commentaire
$commentaire=infos_commentaire($_REQUEST['id_commentaire'],True);

if ($commentaire->erreur)
  $vue->erreur=$commentaire->message;

if ($commentaire->id_createur_commentaire==$_SESSION['id_utilisateur'])
  $autorisation=True;
else if ($_SESSION['niveau_moderation']>=1)
  $autorisation=TRUE;
else
  $autorisation=FALSE;

if ( !$autorisation )
    $vue->erreur="Impossible d'accéder à cette page vous n'y êtes pas autorisé";
else
	echo "<h3>Modération des commentaires</h3>\n";
$retour = new stdclass;
// on vient ici par 3 moyens:
//	  -type=transfert
//	  -type=modif
//	  -type=suppression
// 	  -on vient d'arriver: ya pas de type. default. on affiche le formulaire.
if ($vue->erreur=="")
{
    switch($_REQUEST['type'])
    {
        case "transfert_forum":
            // D'abord on le modifie si des changements ont été faits
            $commentaire->texte=stripslashes($_REQUEST["texte"]);
            $commentaire->auteur_commentaire=stripslashes($_REQUEST["auteur_commentaire"]);
            $retour=modification_ajout_commentaire($commentaire);
            
            // ensuite on le transfert sur le forum
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
            // On le modifie si des changements ont été faits, puis on change d'id point pour le transférer vers une autre fiche
            $commentaire->texte=stripslashes($_REQUEST["texte"]);
            $commentaire->auteur_commentaire=stripslashes($_REQUEST["auteur_commentaire"]);
            $commentaire->id_point=$_REQUEST['id_autre_point'];
            // FIXME sly : bidouille juste parce que j'ai voulu mettre "nouvelles globales" et "commentaires" au même endroit, je ferais mieux
            // de coller ça ailleurs (genre une page wiki libre de modification pour les modérateurs)
            if ($commentaire->id_point==$config['numero_commentaires_generaux'])
                $message=$commentaire->id_point." est une valeur spéciale interdite";
            else
            {
                $retour=modification_ajout_commentaire($commentaire);
                if (!$retour->erreur)
                        $message="ce commentaire a été déplacé sur la fiche de <a href='".lien_point_lent($commentaire->id_point)."'>Ce point</a>";
                else
                        $message=$retour->message;
            }
            print("<h4>$message</h4>");
            break;
        case "suppression_photo":
            $retour=suppression_photos($commentaire);
            print("<h4>$retour->message</h4>");
            break;
            
        default:
            // affichage du formulaire de modif
            // FIXME sly : à convertir en template MVC
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
            ";
            if ($commentaire->id_createur_commentaire==0) // seulement modifiable si n'était pas authentifié'
                echo "auteur:<input type='text' name='auteur_commentaire' value='$commentaire->auteur_commentaire' />";
            echo "</label>
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
            'suppression' entraine également la suppression de la photo.<br />
            'transfert_forum' entraîne aussi le déplacement de la photo vers le forum
            </p>
            <!--<a href=\"./?page=moderation&amp;type=suppression&amp;vider=1&amp;id_commentaire=".$_REQUEST['id_commentaire']."&amp;id_point_retour=".$_REQUEST['id_point_retour']."\">supprimer le commentaire</a>-->";
            
    } // fin du switch
    print("<a href=\"".lien_point_lent($_REQUEST['id_point_retour'])."\">Retour au point</a>");
    $commentaire=infos_commentaire($_REQUEST['id_commentaire']);
}
else
    print($vue->erreur);
?>
