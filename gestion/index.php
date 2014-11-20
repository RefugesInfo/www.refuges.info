<?php
/**********************************************************************************************
Point d'entrée centraliser à la zone de gestion, les autres pages sont inclues à la demande
ça permet de factoriser un peu de code, regrouper l'authentification et de foutre un sacré boxon
sly 02/12/2012
Chantier d'avenir : passer en MVC
// 15/02/13 jmb : suppression de certaines fonctionnalités (polygones) . on pourra les remettre, eventuellement, + tard
// 15/02/13 jmb : l'avenir n'est pas vraiment a ce qu'on gere nous meme ces choses. Il y a plein de boulot plus urgent
                    un peu de re  ecriture PHP aussi (big switch)

***********************************************************************************************/

require_once ("../includes/config.php");
require_once ("autoconnexion.php");
require_once ("wiki.php");

auto_login_phpbb_users();

$vue = new stdClass;
$vue->titre="Zone de gestion";

if ($_SESSION['niveau_moderation']>=1)
    $vue->demande_correction=info_demande_correction ();

// FIXME : Cette bidouille ne serait pas nécessaire si la gestion était au format MVC
$vue->lien_wiki=prepare_lien_wiki_du_bandeau();
include ($config['chemin_vues']."_entete.html");

print("<div class=\"contenu\"$hauteur_contenu>");
// autoconnexion.php ayant déjà fait le boulot il n'y a plus qu'a vérifier
// qu'on est avec quelqu'un du forum et ayant un niveau modérateur au minimum
// l'évolution est de permettre à tout utilisateur de venir ici en présentant les 
// choix selon ces droits

if (isset($_SESSION['id_utilisateur']) )
{
    if ($_GET['page']=="")
    {//pas de paramètre 'page',
  
        //affichage des menus de gestion
        //----------------------------
        print("<h3>Zone de gestion</h3>");

        // un beau switch inversé
        switch ( $_SESSION['niveau_moderation'] )
        {
            // pour les admins
            case 3 : ;
            //pour les programmeurs
            case 2 :
/*
                print("
                    <h4>Programmeurs</h4>
                    <ul>
                        <li><a href='".$config['url_chemin_openlayers']."build/build.php'>Compression de la librairie OpenLayers</a> aprés modification des sources (dizaine de secondes)</li>
                    </ul>
                    ");
*/
            // pour tout modérateur
            //TODO : centraliser le niveau d'autorisation, sinon, il faut régler séparément chaque fichier gestion/*.php
            case 1 :
                print("
                    <h4>Modérateurs</h4>
                    <ul>
                        <li><a href='./?page=commentaires_attente_correction'>Voir les commentaires en attente d'une correction</a></li>
                        <li><a href='./?page=modifier_modeles'>Modifier les modèles de points</a> (le pré-remplissage des champs lors d'un ajout de point)</li>
                        <li><a href=\"".lien_wiki('contenus_speciaux')."\"> Liste des contenus spéciaux</a></li>
                        <li><a href='../nav?test_creer=1'>Créer un massif</a></li>
                    </ul>");
    
            // Pour tous les utilisateurs
            case 0 :
                print("
                    <h4>Pour tout le monde</h4>
                    <ul>
                      <li>
                        <a href='".$config['lien_forum']."login.php?logout=true'>Se déconnecter</a>
                      </li>
                    </ul>"); // pas de risque la page est mutante
        }
    }
    else   // il y a un param PAGE
    {
        // comment ca marchait avant sans ca ??
        $page = $_GET['page'] ;
        //paramètre page passé:
        echo "<h3><a href=\"./\">Retour</a>&nbsp;Zone de gestion</h3>";
        DEFINE('AUTH',1);
        switch($page)
        {
            case "verif_massif" :
            case "moderation" :
            case "modifier_modeles" :
            case "commentaires_attente_correction" :
            include("$page.php");
            default: break;
        }
    }
}
else
{//pas connecté ou pas de droit
    if (!isset($_SESSION['id_utilisateur']))
        print("<h3>Zone de gestion</h3><h4>Erreur</h4><p>Vous n'êtes pas connu du système veuillez vous connecter d'abord</p>");
    else
        print("<h3>Zone de gestion</h3><h4>Erreur</h4><p>Vous n'avez pas les droits requis pour atteindre cette zone</p>");
}

echo "\n </div><!-- fin du DIV contenu -->";
include ($config['chemin_vues']."_pied.html");
?>
