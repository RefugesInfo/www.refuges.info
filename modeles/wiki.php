<?php
/********************************************************************
Fonctions liées au wiki du site (tout type de page que les modérateurs peuvent écrire)
Accés aux données : entrées / sorties / modifications des textes / formatage pour affichage

********************************************************************/

require_once ("config.php");
require_once ("mise_en_forme_texte.php");
require_once ("bdd.php");

// Fonction pour réaliser un lien vers une page du wiki dont le nom est passé en paramètre
function lien_wiki($page="/")
{
    global $config_wri;
    return $config_wri['base_wiki'].strtolower($page);
}

// retourne plus simplement le contenu de la page wiki concernée au format html (le bbcode a été converti en html)
function wiki_page_html($page)
{
    global $config_wri,$pdo;
    $contenu_page=wiki_page_brut($page);
    if ($contenu_page->erreur)
        return "Contenu inexistant";

    // conversion bbcode
    $contenu_html=bbcode2html($contenu_page->contenu,True);

    // Toutefois, notre style css fait que les titres <hx> sont déjà précédés et suivi d'un retour ligne forcé, ça en ferait donc beaucoup dans le cas
    // où on souhaite garder lisible notre saisie, j'enlève donc celui qui précède et qui suit
    $contenu_html=preg_replace("/<\/h([1-9])><br>/","</h$1>\n",$contenu_html);
    $contenu_html=preg_replace("/<br>\r\n<h([1-9])>/","\n<h$1>",$contenu_html);

    // Pareil pour les 2 tableaux qui se battent en duel
    $contenu_html=preg_replace("/<br>\r\n<t([rd])/","\n<t$1",$contenu_html);
    $contenu_html=preg_replace("/<\/t([rd])><br>/","</t$1>\n",$contenu_html);
    return $contenu_html;
}

// Récupération en format brut
function wiki_page_brut($page)
{
    global $config_wri,$pdo;
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
    return $page;
}

// fonction qui va ré-écrire le contenu de la page
function ecrire_contenu($page,$contenu)
{
  global $config_wri,$pdo;
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
    global $config_wri,$pdo;
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
