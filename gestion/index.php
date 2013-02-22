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

require_once ("../modeles/config.php");
require_once ("fonctions_autoconnexion.php");

$modele->titre="Zone de gestion";
$olVersion = 'ol2.12.1.3';

// FIXME : Ou là la ! Je n'ai pas le temps pour l'instant, mais il faudra standardiser tout ça à le rentrée // Dominique 22/07/12
// Il faut faire ça ici, dans le fichier général de gestion car ça doit être fait avant d'appeler l'entête
// jmb je commente tout ce qui est edition de poly

include ($config['chemin_vues']."_entete.html");

print("<div class=\"contenu\"$hauteur_contenu>");
// fonctions_autoconnexion.php ayant déjà fait le boulot il n'y a plus qu'a vérifier
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
			case 3 :
				print("
					<h4>Administrateurs</h4>
					<ul>
						<li><a href='./?page=moderateurs'>Gestion des moderateurs</a></li>
					</ul>");

			//pour les programmeurs
			case 2 :
				print("
					<h4>Programmeurs</h4>
					<ul>
						<li><a href='./?page=verif_massif'>Vérification de la cohérence des massifs</a> (le chevauchement des massifs)</li>
						<li><a href='/$olVersion/build/build.php'>Compression de la librairie OpenLayers</a> aprés modification des sources (dizaine de secondes)</li>
					</ul>
					");
	
			// pour tout modérateur
			//TODO : centraliser le niveau d'autorisation, sinon, il faut régler séparément chaque fichier gestion/*.php
			case 1 :
				print("
					<h4>Modérateurs</h4>
					<ul>
						<li><a href='./?page=commentaires_attente_correction'>Voir les commentaires en attente d'une correction</a></li>
						<li><a href='./?page=modifier_modeles'>Modifier les modèles de points</a> (le pré-remplissage des champs lors d'un ajout de point)</li>
						<li><a href='./?page=news_gestion&amp;ajout=1'>Ajout d'une news général</a> (En haut de la page nouvelles)</li>
						<li><a href='./?page=import_polygone'>Importer un polygone dans la base</a></li>
					</ul>");
	
			// Pour tous les utilisateurs
			case 0 :
				print("
					<h4>Pour tout le monde</h4>
					<ul>
						<li><a href='./?page=moderateurs'>Connaître les moderateurs du site</a></li>
					</ul>"); // pas de risque la page est mutante
		
			// pour tout le monde	
			default :
				print("<p><a href='".$config['lien_forum']."login.php?logout=true'>Se déconnecter</a></p>");
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
			case "calcul_appartenance_polygone" :
			case "moderateurs" :
			case "news_gestion" :
			case "verif_massif" :
			case "moderation" :
			case "moderation2" :
			case "modifier_modeles" :
			case "commentaires_attente_correction" :
			case "import_polygone" :
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
