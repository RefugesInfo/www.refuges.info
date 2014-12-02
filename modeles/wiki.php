<?php 
/********************************************************************
Fonctions liées au wiki du site (tout type de page que les modérateurs peuvent écrire)
Accés aux données : entrées / sorties / modifications des textes / formatage pour affichage

********************************************************************/

require_once ("config.php");
require_once ("mise_en_forme_texte.php");
require_once ("bdd.php");

// Fonction pour réaliser un lien vers une page du mode d'emploi 
function lien_wiki($page="/")
{
    global $config;
    return $config['base_wiki'].strtolower($page);
}

// retourne plus simplement le contenu de la page wiki concernée au format html (le bbcode a été converti en html)
function wiki_page_html($page)
{
    global $config,$pdo;
    $contenu_page=wiki_page_brut($page);
    if ($contenu_page->erreur)
        return "Contenu inexistant";
    else
    {
            // gestion des liens internes au format [url=##page]c'est là que ça se passe[/url]
            $contenu_html=str_replace("##",$config['base_wiki'],$contenu_page->contenu);
            //spécial commentaires inventés par sly à enlever (peut être mieux directement dans bbcode2html ?)
            $contenu_html=preg_replace("/\[c\].*\[\/c\]/s","",$contenu_html);
            // conversion bbcode
            $contenu_html=bbcode2html($contenu_html,TRUE);
            // ceci a pour but de simplifier l'écriture du wiki pour les non informaticiens (un retour ligne, ben, ça retourne à la ligne !)
            $contenu_html=nl2br($contenu_html,false);
            // et des espaces rajoutés en rab feront vraiment des espaces
            $contenu_html=str_replace("   ","&nbsp;&nbsp;",$contenu_html);

            // Toutefois, notre style css fait que les titres <hx> sont déjà précédés et suivi d'un retour ligne forcé, ça en ferait donc beaucoup dans le cas
            // où on souhaite garder lisible notre saisie, j'enlève donc celui qui précède et qui suit
            $contenu_html=preg_replace("/<\/h([1-9])><br>/","</h$1>\n",$contenu_html);
            $contenu_html=preg_replace("/<br>\r\n<h([1-9])>/","\n<h$1>",$contenu_html);
            return $contenu_html;
    }
}

// Récupération en format brut
function wiki_page_brut($page)
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
