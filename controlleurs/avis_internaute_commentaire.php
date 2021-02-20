<?php
/**********************************************************************************************
Permettre à n'importe qui d'indiquer qu'un commentaire à pas, peu, un peu, ou beaucoup d'intérêt, 
J'avais imaginé un système sophistiqué de scoring mais en fait c'est très peu utilisé, là ou
c'est utile, c'est que si un internaute trouve un commentaire inutile ça l'indique à un modérateur
**********************************************************************************************/
require_once ("bdd.php");
require_once ("commentaire.php");

$commentaire=infos_commentaire($controlleur->url_decoupee[1]);

if (!empty($commentaire->erreur))
{
    $vue->http_status_code = 404;
    $vue->type = "page_simple";
    $vue->titre=$commentaire->message;
}
else
{
    $vue->commentaire=$commentaire;
    $vue->commentaire->texte_affichage=bbcode2html($commentaire->texte,FALSE,FALSE);

    $vue->commentaire->lien=lien_point($commentaire,True);
    
    /**************************** l'action  ******************************/
    if (!empty($_POST['valider']))
    {
        $vue->type="page_simple";
        // Si l'internaute est connecté au forum ou qu'il a saisi la lettre anti-robot
        if (est_connecte() or $_POST['anti_robot']=="f")
        {
            $commentaire->demande_correction=$_POST['demande_correction'];
            $commentaire->raison_demande_correction=$_POST['raison_demande_correction'];
            modification_ajout_commentaire($commentaire);
            $vue->contenu="Merci pour votre aide au tri, ";
        }
        else
            $vue->contenu="Oups ? la lettre anti_robot saisie n'est pas la bonne, utilisez le bouton \"Retour de votre navigateur pour reprendre la saisie\", ou ";
        
        $vue->lien=$vue->commentaire->lien;
        $vue->contenu.="vous pouvez retourner sur : ";
        $vue->titre_lien="la fiche de $commentaire->nom";
    }
    else
    {
        $vue->lien_que_mettre=lien_wiki("que_mettre");
        if (!est_connecte())
            $vue->test_anti_robot=True;
    }
}

