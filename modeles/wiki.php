<?php 
/********************************************************************
Fonctions liées au wiki du site (tout type de page que les modérateurs peuvent écrire)
Accés aux données : entrées / sorties / modifications des textes / formatage pour affichage

********************************************************************/

require_once ("config.php");
require_once ("fonctions_mise_en_forme_texte.php");
require_once ("fonctions_bdd.php");

// Fonction pour réaliser un lien vers une page du mode d'emploi 
function lien_wiki($page="index")
{
    global $config;
    $base=$config['base_wiki'];
    if ($page=="")
        return $base;
    return $base.strtolower($page)."/";
}

function recupere_contenu($page)
{
    global $config,$pdo;
    $page=$pdo->quote($page);
    $query="SELECT *,extract('epoch' from date) as ts_unix_page
              FROM pages_wiki 
              WHERE nom_page=$page order by date desc limit 1";
    $res=$pdo->query($query);
    if (!$res)
        return erreur("Requête SQL impossible à executer",$query);
    
    $page=$res->fetch();
    if (!$page)
        return erreur("Cette page du wiki n'existe pas");
    // gestion des liens internes au format [url=##page]c'est là que ça se passe[/url]
    $page->contenu_html=str_replace("##",lien_wiki(""),$page->contenu);
    // conversion bbcode
    $page->contenu_html=trim(bbcode2html($page->contenu_html,TRUE));
    return $page;
}

// fonction qui va ré-écrire le contenu de la page
function ecrire_contenu($page,$contenu)
{
	global $config,$pdo;
    $page=$pdo->quote($page);
    $contenu=$pdo->quote($contenu);
    $query="insert into pages_wiki (nom_page,contenu) VALUES ($page,$contenu)";
    $res=$pdo->query($query);
    if (!$res)
        return erreur("Requête SQL impossible à executer",$query);
   
    return ok("Page mise à jour, et ancienne verson conservée");
}

// Supprime la page et toute ses anciennes versions
function supprimer_page($page)
{
    global $config,$pdo;
    $page=$pdo->quote($page);
    $query="delete from pages_wiki where nom_page=$page";
    $res=$pdo->query($query);
    if (!$res)
        return erreur("Requête SQL impossible à executer",$query);
    
    return ok("Page supprimée et tout ses anciennes versions");
}
function prepare_lien_wiki_du_bandeau()
{
    foreach (array("index","licence","prudence","qui_est_refuges.info","liens","don","mentions-legales") as $nom_lien)
        $lien_wiki[$nom_lien]=lien_wiki($nom_lien);
    return $lien_wiki;
}
?>
