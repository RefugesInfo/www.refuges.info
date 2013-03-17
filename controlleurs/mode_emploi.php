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
require_once ("fonctions_mode_emploi.php");

$modele = new stdclass;
$nom_page=$controlleur->url_decoupee[2];
// On est bien avec un moderateur, on peut autoriser, si demande, modification et suppression
if (($_SESSION ['niveau_moderation'] >= 1) ) 
{
	if (isset($_POST ['modification']))
		ecrire_contenu ($nom_page, $_POST ['texte']);
	if ($_GET ['supprimer'] == 1)
		supprimer_page($nom_page);
}

if ($nom_page == '')
	$nom_page = 'index';

// Conteneur standard de l'entête et pied de page
$page =  recupere_contenu ($nom_page);

$vue->titre = "Mode d'emploi de refuges.info $nom_page";
$vue->nom_page= $nom_page;
// La page n'existe pas (ou pas encore !)
if ($page->erreur and $_GET['form_modifier']!=1)
{
    header("HTTP/1.0 404 Not Found");
    $vue->type="page_introuvable";
    $vue->titre=$page->message;
    if ($_SESSION ['niveau_moderation'] >= 1)
    {
        $vue->contenu="Toutefois, vous pouvez la créér si besoin car vous êtes modérateur en : ";
        $vue->lien_special=lien_mode_emploi($vue->nom_page)."?form_modifier=1";
        $vue->titre_lien="Cliquant ici";
    }
} // Un modérateur a demandé à la modifier
elseif($_GET['form_modifier']==1 and $_SESSION ['niveau_moderation'] >= 1)
{
    $vue->type="mode_emploi_modification";
    $vue->contenu_a_modifier=htmlspecialchars($page->contenu,0,"UTF-8");
    $vue->lien_validation=lien_mode_emploi($nom_page);
    
}
else // affichage de la page
{
    if ($_SESSION ['niveau_moderation'] >= 1)
        $vue->montrer_lien_admin=True;
    if ($nom_page!='index')
        $vue->lien_retour_index=lien_mode_emploi();
        
	$vue->date=date("d/m/Y",$page->ts_unix_page);
    $vue->contenu_html  = $page->contenu_html; 
}

?>
