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

// Hors modérateurs globaux, seul le modérateur actuel de la fiche (voir est_autorise) peut consulter l'historique, et uniquement celui de sa fiche
if (!est_moderateur())
{
  require_once ('point.php');
  $point_filtre = $id_point_filtre ? infos_point($id_point_filtre) : null;
  if (empty($point_filtre) or !empty($point_filtre->erreur) or !est_autorise($point_filtre->id_moderateur))
  {
    $vue->http_status_code = 403;
    $vue->type = "page_simple";
    $vue->titre = "Erreur 403 : droits insuffisants";
    $vue->contenu = "L'historique n'est consultable que par les modérateurs, ou par le modérateur de la fiche pour l'historique de sa fiche, êtes vous bien connecté ?";
    return;
  }
}


if (!empty($_GET['id_user']) and est_entier_positif($_GET['id_user']))
  $condition_point.=" AND id_user=".$_GET['id_user'];

if (!empty($_GET['type_modification']))
  $condition_point.=" AND type_modification=".$pdo->quote($_GET['type_modification']);

$limite=100;
if (!empty($_GET['limite']) and est_entier_positif($_GET['limite']))
  $limite=$_GET['limite'];

// Valeurs proposées par le mini formulaire de filtrage en haut de page
// Les listes de choix du formulaire se limitent à la fiche si on en regarde une seule
$condition_liste=$id_point_filtre ? " WHERE id_point=$id_point_filtre" : "";
$condition_liste_h=$id_point_filtre ? " WHERE h.id_point=$id_point_filtre" : "";
$vue->filtres=new stdClass();
$vue->filtres->id_point=$id_point_filtre;
$vue->filtres->id_user=$_GET['id_user'] ?? '';
$vue->filtres->type_modification=$_GET['type_modification'] ?? '';
$vue->filtres->limite=$limite;
$vue->filtres->types=$pdo->query("SELECT DISTINCT type_modification FROM historique_modifications_points$condition_liste ORDER BY 1")->fetchAll(PDO::FETCH_COLUMN);
$vue->filtres->utilisateurs=$pdo->query("SELECT DISTINCT h.id_user, u.username FROM historique_modifications_points h JOIN phpbb3_users u ON u.user_id=h.id_user$condition_liste_h ORDER BY u.username")->fetchAll();

$query_log_modification="select *,date_modification::timestamp(0) as date from historique_modifications_points$condition_point order by date_modification desc LIMIT $limite";

if (! ($res = $pdo->query($query_log_modification)))
  return erreur("Requête en erreur, impossible d'afficher l'historique de modifications",$query_log_modification);

// Champs texte pour lesquels on met en évidence, mot par mot, ce qui a changé ('remark' et 'proprio' : anciens noms, restés dans les anciennes lignes)
$champs_texte_compares = ['remarques', 'remark', 'acces', 'proprietaires', 'proprio'];

// Compare deux textes mot par mot (plus longue sous-suite commune) et retourne le html des deux, la partie modifiée en <b class="modif">
$diff_mots = function ($texte_avant, $texte_apres)
{
  $mots_avant = preg_split('/(\s+)/u', $texte_avant, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
  $mots_apres = preg_split('/(\s+)/u', $texte_apres, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
  $nb_avant = count($mots_avant);
  $nb_apres = count($mots_apres);
  if ($nb_avant * $nb_apres > 4000000) // texte énorme : on n'essaie pas, affichage sans mise en évidence
    return null;

  // lcs[i][j] = longueur de la sous-suite commune des mots i.. de avant et j.. de apres
  $lcs = array_fill(0, $nb_avant + 1, array_fill(0, $nb_apres + 1, 0));
  for ($i = $nb_avant - 1; $i >= 0; $i--)
    for ($j = $nb_apres - 1; $j >= 0; $j--)
      $lcs[$i][$j] = ($mots_avant[$i] === $mots_apres[$j]) ? $lcs[$i + 1][$j + 1] + 1 : max($lcs[$i + 1][$j], $lcs[$i][$j + 1]);

  $change_avant = array_fill(0, $nb_avant, true);
  $change_apres = array_fill(0, $nb_apres, true);
  for ($i = 0, $j = 0; $i < $nb_avant and $j < $nb_apres;)
    if ($mots_avant[$i] === $mots_apres[$j])
      $change_avant[$i++] = $change_apres[$j++] = false;
    elseif ($lcs[$i + 1][$j] >= $lcs[$i][$j + 1])
      $i++;
    else
      $j++;

  // Segments en gras : un espace inchangé entre deux mots changés fait partie du même segment
  $en_html = function ($mots, $change)
  {
    $nb = count($mots);
    for ($k = 1; $k < $nb - 1; $k++)
      if (!$change[$k] and trim($mots[$k]) === '' and $change[$k - 1] and $change[$k + 1])
        $change[$k] = true;
    $html = '';
    for ($k = 0; $k < $nb; $k++)
    {
      $segment = '';
      $etat = $change[$k];
      for (; $k < $nb and $change[$k] === $etat; $k++)
        $segment .= $mots[$k];
      $k--;
      $segment = nl2br(protege($segment));
      $html .= $etat ? '<b class="modif">'.$segment.'</b>' : $segment;
    }
    return $html;
  };
  return [$en_html($mots_avant, $change_avant), $en_html($mots_apres, $change_apres)];
};

// Liste des propriétés en html, une par ligne ($remplacements : html déjà prêt pour certaines propriétés)
$html_proprietes = function ($proprietes, $remplacements = [])
{
  $lignes = [];
  foreach ((array) $proprietes as $propriete => $valeur)
    $lignes[] = "[$propriete] => ".($remplacements[$propriete] ?? nl2br(protege(is_scalar($valeur) ? (string) $valeur : print_r($valeur, true))));
  return implode("<br />\n", $lignes);
};

while ($modification_point = $res->fetch()) {
  // Si authentifié, on indique qui a fait la modif
  if ($modification_point->id_user!=0)
    $utilisateur=infos_utilisateur($modification_point->id_user);
  elseif (isset($utilisateur))
    $utilisateur->username="anonyme ?";

  // si cela concerne un point du site, on fait un lien vers lui pour se simplifier la consultation
  $lien_de_base="";
  if (in_array($modification_point->type_modification, array ("modification point","creation point","création point","suppression point")))
    $lien_de_base="point";

  if (in_array($modification_point->type_modification, array ("modification polygone","suppression polygone")))
    $lien_de_base="nav";

  if (!empty($modification_point->id_point))
    $modification_point->lien_point="/$lien_de_base/$modification_point->id_point";

  $point_avant=unserialize($modification_point->avant);
  $point_apres=unserialize($modification_point->apres);
  $modification_point->moderateur=$utilisateur->username??'';

  $modification_point->nom = $point_avant->nom ?? $point_avant->nom_polygone ??
    $point_apres->nom ?? $point_apres->nom_polygone ?? ($modification_point->id_point ? "Fiche n°$modification_point->id_point" : 'Erreur:Aucun nom?');

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

  // Pour une création, "apres" contient tout : on masque aussi les valeurs vides et la géométrie brute
  if (empty($avant_complet) and is_object($point_apres))
  {
    unset($point_apres->geom);
    $point_apres = array_filter((array) $point_apres);
  }

  // Mise en évidence de la partie modifiée des champs texte
  $diff_avant = [];
  $diff_apres = [];
  foreach ($champs_texte_compares as $champ)
    if (isset($avant_change[$champ], $point_apres->$champ) and is_string($avant_change[$champ]) and is_string($point_apres->$champ)
      and $avant_change[$champ] !== $point_apres->$champ
      and $diff = $diff_mots($avant_change[$champ], $point_apres->$champ))
      [$diff_avant[$champ], $diff_apres[$champ]] = $diff;

  // Ces trois champs sont du html déjà protégé, à afficher tel quel
  $modification_point->html_avant = $html_proprietes($avant_change, $diff_avant);
  $modification_point->html_avant_suite = $html_proprietes($avant_reste);
  $modification_point->html_apres = $html_proprietes($point_apres, $diff_apres);
  $vue->modifications_points[]=$modification_point;
}
