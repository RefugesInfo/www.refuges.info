<?php
/********************************************************************
Fonctions liées au wiki du site (tout type de page que les modérateurs peuvent écrire)
Accés aux données : entrées / sorties / modifications des textes / formatage pour affichage

********************************************************************/

require_once ("mise_en_forme_texte.php");
require_once ("bdd.php");
require_once ("traduction.php");

// Fonction pour réaliser un lien vers une page du wiki dont le nom est passé en paramètre
function lien_wiki($page="/",$langue=null)
{
    global $config_wri;
    // $langue : null = langue de la page courante ; 'fr' ou 'en' pour faire le lien vers l'autre version
    $suffixe_langue = ($langue===null) ? $config_wri['url_suffixe_langue'] : (($langue==='fr') ? '' : $langue.'/');
    // /wiki/page/en/ ; la page d'accueil du wiki s'appelle "index" (appelée sans nom ou avec "/", elle donne /wiki/index)
    $page = ($page==="/" or $page==="") ? 'index' : strtolower($page);
    return $config_wri['base_wiki'].$page.($suffixe_langue ? '/'.$suffixe_langue : '');
}

// retourne plus simplement le contenu de la page wiki concernée au format html (le bbcode a été converti en html)
function wiki_page_html($page)
{
    global $config_wri,$pdo;
    $contenu_page=wiki_page_brut($page);
    if (!empty($contenu_page->erreur))
        return "Contenu inexistant";

    // Traduction (table traductions, type 'wiki', clé = nom de la page) : seulement si elle correspond à la version
    // actuelle de la page, sinon on garde le français plutôt que d'afficher une information périmée
    if (($config_wri['langue_courante'] ?? 'fr') != 'fr')
    {
      $traduction = traduction_a_jour_wiki($page, $contenu_page->contenu);
      if ($traduction)
        $contenu_page->contenu = $traduction->texte;
    }

  // Horible bidouille pour le wiki contact
  // A intégrer dans le bbcode2html ?
  // Traitement de la balise {cherche_points}
  if (!empty($_POST['cherche_points']))
      $contenu_page->contenu = str_replace('{cherche_points}', $_POST['cherche_points'], $contenu_page->contenu);
  // Traitement de la balise de répétition [points]
  $contenu_page->contenu = preg_replace_callback(
    '/\[points\]([^\[]*)\[\/points\]/',
    function ($matches)
    {
      global $config_wri,$pdo;
      $cherche_points = $_POST ['cherche_points'] ?? '';
      $nb_max = 20;
      $retour=[];
      if($cherche_points) {
        $sql = "SELECT id_point, nom FROM points WHERE nom ILIKE ".$pdo->quote("%$cherche_points%")." LIMIT $nb_max";
        if ( ! ($res = $pdo->query($sql)))
          return erreur(_("Une erreur sur la requête est survenue"),$sql);

        while ($row = $res->fetch())
          $retour[] = str_replace (['{nom}','{id_point}'], [$row->nom,$row->id_point], $matches[1]);
      }
      if (count ($retour) >= $nb_max)
        $retour[] = "<p style='color:red'>... trop de résultats, merci d'affiner la recherche</p>";

      return implode('', $retour);
    },
    $contenu_page->contenu
  );

    // conversion bbcode
    $contenu_html=bbcode2html($contenu_page->contenu,True);

    // Toutefois, notre style css fait que les titres <hx> sont déjà précédés et suivi d'un retour ligne forcé, ça en ferait donc beaucoup dans le cas
    // où on souhaite garder lisible notre saisie, j'enlève donc celui qui précède et qui suit
    $contenu_html=preg_replace("/<\/h([1-9])><br>/","</h$1>\n",$contenu_html);
    //$contenu_html=preg_replace("/<br>\r\n<h([1-9])>/","\n<h$1>",$contenu_html);

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
    return erreur(_("Requête SQL impossible à executer"),$query);

  $page=$res->fetch();
  // Une page supprimée = sa dernière version a un contenu NULL (voir supprimer_page), les versions antérieures restent en base
  if (!$page or $page->contenu === null)
    return erreur(_("Cette page du wiki n'existe pas"));
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
    return erreur(_("Requête SQL impossible à executer"),$query);

  return ok("Page mise à jour, et ancienne verson conservée");
}

// Supprime la page : on ajoute une version au contenu NULL, les anciennes versions et les traductions sont conservées
// (restauration à la main : réinsérer une copie de la dernière version non NULL de la page)
function supprimer_page($page)
{
  global $config_wri,$pdo;
  $existante=wiki_page_brut($page);
  if (!empty($existante->erreur))
    return $existante; // inexistante ou déjà supprimée : rien à faire
  $query="insert into pages_wiki (nom_page,contenu) VALUES (".$pdo->quote($page).",NULL)";
  $res=$pdo->query($query);
  if (!$res)
    return erreur(_("Requête SQL impossible à executer"),$query);

  return ok("Page supprimée, ses anciennes versions sont conservées");
}

// Récupération en format brut
function liste_pages_wiki($conditions = Null)
{
  global $config_wri,$pdo;
  // Dernière version de chaque page, sans les pages supprimées (contenu NULL)
  $query="SELECT nom_page, extract('epoch' from date) as ts_date_derniere_modification
          FROM (SELECT DISTINCT ON (nom_page) nom_page, date, contenu
                FROM pages_wiki
                ORDER BY nom_page, date DESC) AS dernieres_versions
          WHERE contenu IS NOT NULL
          ORDER BY nom_page ASC;";
  $res=$pdo->query($query);
  if (!$res)
    return erreur(_("Requête SQL impossible à executer"),$query);
  while ($page_wiki = $res->fetch())
    $pages_wiki[]=$page_wiki;
  if (empty($pages_wiki))
    return erreur(_("Il n'y a aucune page dans notre wiki, oulla, c'est louche, quelqu'un à tout purger, ou alors une nouvelle installation, ou alors un bug..."));
  return $pages_wiki;
}

// Toutes les pages du wiki, supprimées comprises (dernière version à contenu NULL), avec leur nombre de versions
function liste_pages_wiki_avec_supprimees()
{
  global $config_wri,$pdo;
  $query="SELECT nom_page, count(*) AS nb_versions,
            extract('epoch' from max(date)) AS ts_date_derniere_modification,
            (array_agg(contenu IS NULL ORDER BY date DESC))[1]::int AS supprimee
          FROM pages_wiki
          GROUP BY nom_page
          ORDER BY nom_page ASC;";
  $res=$pdo->query($query);
  if (!$res)
    return erreur(_("Requête SQL impossible à executer"),$query);
  return $res->fetchAll();
}

// Toutes les versions d'une page, de la plus récente à la plus ancienne ; ->version identifie la ligne (date au microseconde près)
function versions_page_wiki($page)
{
  global $config_wri,$pdo;
  $query="SELECT date::text AS version, extract('epoch' from date) AS ts_date, contenu
          FROM pages_wiki
          WHERE nom_page=".$pdo->quote($page)."
          ORDER BY date DESC";
  $res=$pdo->query($query);
  if (!$res)
    return erreur(_("Requête SQL impossible à executer"),$query);
  return $res->fetchAll();
}

// Restaure une version : on en ajoute une copie en tête de l'historique (rien n'est écrasé), ce qui remet aussi en ligne une page supprimée
function restaurer_version_wiki($page,$version)
{
  global $config_wri,$pdo;
  $query="insert into pages_wiki (nom_page,contenu)
          select nom_page,contenu from pages_wiki
          where nom_page=".$pdo->quote($page)." and date::text=".$pdo->quote($version)." and contenu is not null";
  $nb=$pdo->exec($query);
  if ($nb===false)
    return erreur(_("Requête SQL impossible à executer"),$query);
  if (!$nb)
    return erreur(_("Cette version n'existe pas ou correspond à une suppression"));
  return ok(_("Version restaurée, la page est en ligne avec ce contenu"));
}

// Purge définitive : la page, toutes ses versions et ses traductions (irréversible, réservé aux administrateurs, voir le contrôleur)
function purger_page_wiki($page)
{
  global $config_wri,$pdo;
  $query="delete from pages_wiki where nom_page=".$pdo->quote($page);
  $res=$pdo->query($query);
  if (!$res)
    return erreur(_("Requête SQL impossible à executer"),$query);
  supprime_traductions_wiki($page);
  return ok(_("Page, versions et traductions purgées définitivement"));
}
