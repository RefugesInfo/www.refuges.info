<?php 
/*****************************************************
Descriptif, licence, fonctionnement,... du site 
On appel le fichier sous forme  mode_emploi.php?page=truc 

Contient les include de PHP, les déclarations et appels des blocs d'affichage et les passages de données entre ces programmes
Ne contient aucun traitement d'info ni balise HTML
Les fichiers réalisant l'affichage sont dans /vues/news.*
je dis pas que c'est une super idée, mais je tente, tout se trouve dans un sous repertoire avec les textes 
ici c'est une sorte de metamoteur qui génère le tout
ça ressemble à une sorte de "wiki" avec les tags phpBB et HTML autorisés + nos codes internes [->12] (lien vers un point de la base)
c'est donc "un peu" plus rapide à écrire et disponible pour les modérateurs, les liens entres pages sont plus simples et centralisés

Finalement on passe à un quasi-vrai wiki sans historique que pour modérateurs
*****************************************************/
require_once ('../modeles/config.php');
require_once ($config['chemin_modeles']."fonctions_autoconnexion.php");
require_once ($config['chemin_modeles']."fonctions_mode_emploi.php");

$modele = new stdclass;

// On est bien avec un moderateur, on peut autoriser, si demande, modification et suppression
if (($_SESSION ['niveau_moderation'] >= 1) ) 
{
	if (isset($_POST ['modification']))
	{
		ecrire_contenu ($_GET ['page'], stripslashes ($_POST ['texte']));
		ecrire_contenu ("./sauvegarde/".$_GET ['page'].date('-YMd.H:i:s'), stripslashes ($_POST ['texte']));
	}
	if ($_GET ['supprimer'] == 1)
		supprimer_page($_GET ['page']);
}

if ($_GET ['page'] == '')
	$_GET ['page'] = 'index';

// Conteneur standard de l'entête et pied de page
unset ($page);
$modele->titre = "Mode d'emploi de refuges.info ".$_GET['page'];
$modele->contenu  = htmlspecialchars(recupere_contenu($_GET['page']),0,"UTF-8");
$modele->html =  genere_contenu ($_GET ['page']);

// La page n'existe pas (ou pas encore !)
if (!$modele->html)
{
	header("HTTP/1.0 404 Not Found");
	$modele->html="Erreur 404 - La page demandée est introuvable sur refuges.info";
	if (($_SESSION ['niveau_moderation'] >= 1) )
		$modele->html.=", toutefois, vous pouvez la créér si besoin car vous êtes modérateur";
}
else
	$modele->date_fichier=date("d/m/Y",date_modif_contenu($_GET ['page']));

$modele->type = 'mode_emploi'; // Le type
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");
?>
