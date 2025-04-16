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

require_once ("point.php");
require_once ('forum.php');

// Je ne sais pas dans quel fichier mettre cette fonction, elle ne sert que à la saisie d'un point et uniquement ici en gros
function preparation_point()
{
    // on rempli l'object $point à mettre à jour/ajouter en fonction des paramètres POST
    // si l'id_point peut être vide, cela indiquera une création 
    // ATTENTION GAIN DE TEMPS : si on fait attention à ce que le nom des champs correspondent en base, on gagne du temps et de la simplicité
    // Il y aura bien quelques variables en trop dans l'object $point, mais la fonction modification n'en tiendra pas compte
    $point = new stdClass;
    foreach ($_REQUEST as $nom => $value)
        $point->$nom=stripslashes(trim($value));
    
    return $point;
}  
function gestion_retour($retour,$vue)
{
    if (isset($retour->erreur) and $retour->erreur) 
        $vue->erreur=$retour->message;
    else
    {
        $point_apres_modif=infos_point($retour,true,true,true);
        $vue->erreur=$point_apres_modif->message ?? Null;
        $vue->lien_point=lien_point($point_apres_modif);
    } 
}  
switch( $_REQUEST["action"] )
{
    case 'Ajouter' :
        // Il faut soit être identifié, soit avoir rentré la bonne lettre anti-robot
        if ( !est_connecte() AND ($_REQUEST['lettre_securite'] != $config_wri['captcha_reponse']) ) 
        {
            $vue->erreur = "ERREUR: vous n'avez pas rentré la lettre demandée";
            break; // on sort, on ne passe pas à "modifier" qui est l'action groupée
        }
        $point=preparation_point();
        if (est_connecte())
            $point->id_createur=$infos_identification->user_id;
        $retour = modification_ajout_point($point,$infos_identification->user_id);
        gestion_retour($retour,$vue);
        $vue->message="Le point a bien été ajouté";
        break;
    case 'Modifier' :
        $ancien_point=infos_point($_REQUEST['id_point'],True,false); // Uniquement pour récupérer l'id_createur car tout le reste est dans $_REQUEST
        $point=preparation_point();
        $point->topic_id=$ancien_point->topic_id;
        // modification uniquement si modérateur global ou modérateur de cette fiche
        if ( est_autorise($ancien_point->id_createur) )
        {
            $retour = modification_ajout_point($point,$infos_identification->user_id);
            gestion_retour($retour,$vue);
            $vue->message="Le point a bien été modifié";
        }
        else
            $vue->erreur="Vous n'êtes ni modérateur global, ni modérateur de cette fiche, vous n'avez pas l'autorisation de la modifier";
        break;
    
    case 'supprimer':
        $ancien_point=infos_point($_REQUEST['id_point'],True,false); // Uniquement pour récupérer l'id_createur car tout le reste est dans $_REQUEST
        if ( est_autorise($ancien_point->id_createur ?? 0) )
        {
            $point=infos_point($_REQUEST['id_point'],True);
            $resultat_suppression=suppression_point($point,$infos_identification->user_id);
            if ($resultat_suppression->erreur)
                $vue->erreur=$resultat_suppression->message;
            else
                $vue->message=$resultat_suppression->message; // Il pourra y avoir des messages sur mesures (genre "le point a été supprimé mais il n'y avait pas de commentaires")
            break;
        }
        else
            $vue->erreur="Vous n'êtes pas modérateur du site, vous n'avez pas l'autorisation de la supprimer";
        break;
} 

