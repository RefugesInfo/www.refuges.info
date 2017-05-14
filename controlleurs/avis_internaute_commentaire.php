<?php
/**********************************************************************************************
Permettre à n'importe qui d'indiquer qu'un commentaire à pas, peu, un peu, ou beaucoup d'intérêt, 
J'avais imaginé un système sophistiqué de scoring mais en fait c'est très peu utilisé, là ou
c'est utile, c'est que si un internaute trouve un commentaire inutile ça l'indique à un modérateur
**********************************************************************************************/
require_once ("bdd.php");
require_once ("commentaire.php");

$commentaire=infos_commentaire($controlleur->url_decoupee[1]);

if ($commentaire->erreur)
{
    $vue->http_status_code = 404;
    $vue->type = "page_simple";
    $vue->titre=$commentaire->message;
}
else
{
    $vue->commentaire=$commentaire;
    $vue->commentaire->lien=lien_point($commentaire,True);
    
    /**************************** l'action  ******************************/
    if ($_POST['valider']!="")
    {
        $vue->type="page_simple";
        // Si l'internaute est connecté au forum ou qu'il a saisi la lettre anti-robot
        if (isset($_SESSION['id_utilisateur']) or $_POST['anti_robot']=="f")
        {
            $commentaire->demande_correction=$_POST['demande_correction'];
            modification_ajout_commentaire($commentaire);
            $vue->titre="Merci pour votre aide au classement";
        }
        else
            $vue->titre="Oups ? la lettre anti_robot saisie n'est pas la bonne";
        
        $vue->lien=$vue->commentaire->lien;
        $vue->contenu="Vous pouvez retourner sur : ";
        $vue->titre_lien="la fiche de $commentaire->nom";
    }
    else
    {
        $vue->lien_que_mettre=lien_wiki("que_mettre");
        if (!isset($_SESSION['id_utilisateur']))
            $vue->test_anti_robot=True;
    }
}
?>
