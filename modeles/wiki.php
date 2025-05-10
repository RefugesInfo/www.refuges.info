<?php
/********************************************************************
Fonctions liées au wiki du site (tout type de page que les modérateurs peuvent écrire)
Accés aux données : entrées / sorties / modifications des textes / formatage pour affichage

********************************************************************/

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
    if (!empty($contenu_page->erreur))
        return "Contenu inexistant";

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
					return erreur("Une erreur sur la requête est survenue",$sql);

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

// Récupération en format brut
function liste_pages_wiki($conditions = Null)
{
  global $config_wri,$pdo;
  $query="SELECT nom_page, MAX(extract('epoch' from date)) as ts_date_derniere_modification
          FROM pages_wiki
          GROUP BY nom_page
          ORDER BY nom_page ASC;";
  $res=$pdo->query($query);
  if (!$res)
    return erreur("Requête SQL impossible à executer",$query);
  while ($page_wiki = $res->fetch())
    $pages_wiki[]=$page_wiki;
  if (empty($pages_wiki))
    return erreur("Il n'y a aucune page dans notre wiki, oulla, c'est louche, quelqu'un à tout purger, ou alors une nouvelle installation, ou alors un bug...");
  return $pages_wiki;
}
