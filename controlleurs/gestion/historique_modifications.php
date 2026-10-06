  <?php
/***
Indique de manière brutale (print_r) les dernières modifications ayant lieu sur les points de la base
pas super lisible, mais c'est mieux que rien en attendant un super wiki de versionning des fiches de points
si ça semble utile, je pourrais l'améliorer avec conditions sur le point et p'tet mise en rouge de ce qui a changé ;-)
2020 : Et aussi ranger proprement avec un modèle pour gérer la table historique_modifications_points.
sly : mais j'ai la flemme d'y passer du temps en sachant que ça n'est de toute façon pas la bonne solution
sly 2022: bonne solution ou pas, pour l'instant, on a que ça ! Alors j'ajoute quelques option dans l'url pour le tri
sly 2025: grand classique du "vu que ça marche, pourquoi changer", j'ajoute encore des fonctions...
***/

add_lib('gestion/historique_modifications.css');

require_once ('mise_en_forme_texte.php');
require_once ('utilisateur.php');


$condition_point=" WHERE 1=1 ";
// Le numéro de point peut venir de l'url (/gestion/historique_modifications/123) ou du formulaire (?id_point=123)
$id_point_filtre=$controlleur->url_decoupee[2] ?? $_GET['id_point'] ?? '';
if (est_entier_positif($id_point_filtre))
  $condition_point.=" AND id_point=".$id_point_filtre;
else
  $id_point_filtre='';


if (!empty($_GET['id_user']) and est_entier_positif($_GET['id_user']))
  $condition_point.=" AND id_user=".$_GET['id_user'];

if (!empty($_GET['type_modification']))
  $condition_point.=" AND type_modification=".$pdo->quote($_GET['type_modification']);

$limite=100;
if (!empty($_GET['limite']) and est_entier_positif($_GET['limite']))
  $limite=$_GET['limite'];

// Valeurs proposées par le mini formulaire de filtrage en haut de page
$vue->filtres=new stdClass();
$vue->filtres->id_point=$id_point_filtre;
$vue->filtres->id_user=$_GET['id_user'] ?? '';
$vue->filtres->type_modification=$_GET['type_modification'] ?? '';
$vue->filtres->limite=$limite;
$vue->filtres->types=$pdo->query("SELECT DISTINCT type_modification FROM historique_modifications_points ORDER BY 1")->fetchAll(PDO::FETCH_COLUMN);
$vue->filtres->utilisateurs=$pdo->query("SELECT DISTINCT h.id_user, u.username FROM historique_modifications_points h JOIN phpbb3_users u ON u.user_id=h.id_user ORDER BY u.username")->fetchAll();

$query_log_modification="select *,date_modification::timestamp(0) as date from historique_modifications_points$condition_point order by date_modification desc LIMIT $limite";

if (! ($res = $pdo->query($query_log_modification)))
  return erreur("Requête en erreur, impossible d'afficher l'historique de modifications",$query_log_modification);

// Liste des propriétés sous forme de texte brut, une par ligne
$texte_proprietes = function ($proprietes)
{
  $ppambules = ["stdClass Object\n(\n","\n)\n",")\n"];
  return str_replace($ppambules, "", print_r((object) $proprietes, true));
};

while ($modification_point = $res->fetch()) {
  // Si authentifié, on indique qui a fait la modif
  if ($modification_point->id_user!=0)
    $utilisateur=infos_utilisateur($modification_point->id_user);
  elseif (isset($utilisateur))
    $utilisateur->username="anonyme ?";

  // si cela concerne un point du site, on fait un lien vers lui pour se simplifier la consultation
  $lien_de_base="";
  if (in_array($modification_point->type_modification, array ("modification point","création point","suppression point")))
    $lien_de_base="point";

  if (in_array($modification_point->type_modification, array ("modification polygone","suppression polygone")))
    $lien_de_base="nav";

  if (!empty($modification_point->id_point))
    $modification_point->lien_point="/$lien_de_base/$modification_point->id_point";

  $point_avant=unserialize($modification_point->avant);
  $point_apres=unserialize($modification_point->apres);
  $modification_point->moderateur=$utilisateur->username??'';

  $modification_point->nom = $point_avant->nom ?? $point_avant->nom_polygone ??
    $point_apres->nom ?? $point_apres->nom_polygone ?? 'Erreur:Aucun nom?';

  // Pour une modification, "apres" ne contient que les propriétés changées, "avant" toutes celles du formulaire.
  // On affiche d'abord uniquement ce qui a changé, le reste de l'état d'avant est dans un "voir +"
  $avant_complet = (array) $point_avant;
  unset($avant_complet['geom']);
  $avant_change = $avant_complet;
  $avant_reste = [];
  if (!empty((array) $point_apres) and !empty($avant_complet))
  {
    $avant_change = array_intersect_key($avant_complet, (array) $point_apres);
    $avant_reste = array_diff_key($avant_complet, $avant_change);
  }
  // Dans la partie dépliée (et pour les créations/suppressions), on masque les valeurs vides
  $avant_reste = array_filter($avant_reste);
  if (empty((array) $point_apres))
    $avant_change = array_filter($avant_change);

  $modification_point->texte_avant = $texte_proprietes($avant_change);
  $modification_point->texte_avant_suite = $texte_proprietes($avant_reste);
  $modification_point->texte_apres = $texte_proprietes($point_apres);
  $vue->modifications_points[]=$modification_point;
}
