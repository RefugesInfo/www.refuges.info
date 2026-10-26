<?php
/**********************************************************************************************
Outil jetable : rangement des cabanes non gardées « fermées » (fil du forum modérateurs t=17433)

Un seul fichier, indépendant (PHP + HTML + CSS + JS), volontairement moche, à la manière de test.php.
Archivé ici (ressources/outils/), il ne s'active QUE si on le copie sur le contrôleur de la route générique :

  Activer    : cp ressources/outils/rangement-cabanes-fermees.php controlleurs/maintenance.php
  Désactiver : git checkout controlleurs/maintenance.php        (retour à la coquille vide, route en 404)
  URL        : https://xxxx.refuges.info/maintenance            (modérateurs uniquement, aucun lien nulle part)
  Ne JAMAIS commiter la copie active de controlleurs/maintenance.php.

Principe : chaque modérateur se réserve des lots de 10 fiches (filtrables par région, années, mot), puis pour chaque fiche :
  - « Ne rien décider et laisser aux autres » : la fiche est rendue à la liste commune, un autre modérateur la verra ;
  - « Retirer de la liste globale »  : la fiche reste telle quelle (cabane non gardée, fermée) et sort de la liste de tout le monde ;
  - « Convertir en bâtiment inutilisable » : bâtiment à investiguer (id 28) + conditions_utilisation='fermeture' (libellé « Inutilisable »).
Pas de suppression ici : on supprime avec le formulaire habituel, la fiche sort alors toute seule de la liste.

Périmètre : id_point_type = 7 (cabane non gardée) ET conditions_utilisation = 'fermeture'.
Les candidates sont recalculées à chaque affichage, seule la table ci-dessous mémorise réservations et décisions.

Fin de chantier : export CSV (?export=csv), puis désactiver l'outil, puis :
  DROP TABLE rangement_fiches;

Si le rôle de la base ne peut pas créer la table, la créer à la main :
  CREATE TABLE rangement_fiches (
    id_point integer PRIMARY KEY, id_moderateur integer NOT NULL, reserve_le timestamptz NOT NULL DEFAULT now(),
    decision text CHECK (decision IN ('rien','converti','hors_outil')), traite_le timestamptz);
**********************************************************************************************/
require_once ("bdd.php");
require_once ("point.php");
require_once ("forum.php");
require_once ("utilisateur.php");
require_once ("leaflet_libs.php"); // Les mêmes librairies leaflet que la fiche d'un point (ajoutées dans $vue->css_lib_head et $vue->java_lib_foot)

$DELAI_RESERVATION = '1 hour'; // Sans action pendant ce délai, le lot est rendu aux autres (chaque clic de traitement remet le compteur à zéro)
$TAILLE_LOT = 10;
$TYPE_CABANE = $config_wri['id_cabane_non_gardee'];
$TYPE_BATIMENT = $config_wri['id_batiment_a_investiguer'];

function h($texte) { return htmlspecialchars((string)$texte, ENT_QUOTES, 'UTF-8'); }

function sortie_json($ok, $message)
{
  header('Content-Type: application/json; charset=utf-8');
  die(json_encode(array('ok' => $ok, 'message' => $message)));
}

/******* Droits : modérateurs uniquement *******/
if (!est_moderateur())
{
  http_response_code(403);
  die("Réservé aux modérateurs, êtes-vous bien connecté ?");
}
$moi = (int)$user->data['user_id'];
$jeton = hash_hmac('sha256', 'maintenance|'.$moi, $user->data['user_form_salt'].$user->data['session_id']);

/******* Table, créée à la première ouverture *******/
$pdo->exec("CREATE TABLE IF NOT EXISTS rangement_fiches (
  id_point integer PRIMARY KEY,
  id_moderateur integer NOT NULL,
  reserve_le timestamptz NOT NULL DEFAULT now(),
  decision text CHECK (decision IN ('rien','converti','hors_outil')),
  traite_le timestamptz)");

/******* Entretien : réservations périmées libérées, fiches traitées à la main (supprimées, converties, rouvertes...) soldées *******/
$pdo->exec("DELETE FROM rangement_fiches WHERE decision IS NULL AND reserve_le < now() - interval '$DELAI_RESERVATION'");
$pdo->exec("UPDATE rangement_fiches r SET decision='hors_outil', traite_le=now()
  WHERE decision IS NULL AND NOT EXISTS (
    SELECT 1 FROM points p WHERE p.id_point=r.id_point AND p.id_point_type=$TYPE_CABANE AND p.conditions_utilisation='fermeture')");

/******* Filtres (venus de l'URL) *******/
$f = array(
  'region' => (int)($_REQUEST['region'] ?? 0),
  'annee_min' => (int)($_REQUEST['annee_min'] ?? 0),
  'annee_max' => (int)($_REQUEST['annee_max'] ?? 0),
  'mot' => trim($_REQUEST['mot'] ?? ''),
  'tri' => (($_REQUEST['tri'] ?? '') == 'recentes') ? 'recentes' : 'anciennes',
);

// Condition SQL des fiches encore à ranger (hors celles déjà réservées ou traitées) selon les filtres
function sql_candidates($f)
{
  global $pdo, $TYPE_CABANE;
  $sql = "p.id_point_type=$TYPE_CABANE AND p.conditions_utilisation='fermeture' AND COALESCE(p.modele,0)=0
    AND NOT EXISTS (SELECT 1 FROM rangement_fiches r WHERE r.id_point=p.id_point)";
  if ($f['region'])
    $sql .= " AND EXISTS (SELECT 1 FROM polygones pol WHERE pol.id_polygone=".(int)$f['region']." AND ST_Intersects(pol.geom,p.geom))";
  if ($f['annee_min'])
    $sql .= " AND extract(year from p.date_creation) >= ".(int)$f['annee_min'];
  if ($f['annee_max'])
    $sql .= " AND extract(year from p.date_creation) <= ".(int)$f['annee_max'];
  if ($f['mot'] !== '')
    $sql .= " AND (p.nom||' '||COALESCE(p.remarques,'')||' '||COALESCE(p.acces,'')||' '||COALESCE(p.proprietaires,'')) ILIKE "
      .$pdo->quote('%'.addcslashes($f['mot'], '%_\\').'%');
  return $sql;
}

function url_page($f, $message = '')
{
  $params = array_filter($f, function ($v) { return $v !== '' && $v !== 0; });
  if ($message !== '')
    $params['message'] = $message;
  return strtok($_SERVER['REQUEST_URI'], '?').($params ? '?'.http_build_query($params) : '');
}

/******* Export CSV des décisions *******/
if (($_GET['export'] ?? '') == 'csv')
{
  header('Content-Type: text/csv; charset=utf-8');
  header('Content-Disposition: attachment; filename="rangement-cabanes-fermees.csv"');
  $sortie = fopen('php://output', 'w');
  fputcsv($sortie, array('id_point', 'decision', 'moderateur', 'reserve_le', 'traite_le'));
  foreach ($pdo->query("SELECT r.id_point, r.decision, u.username, r.reserve_le, r.traite_le
      FROM rangement_fiches r LEFT JOIN phpbb3_users u ON u.user_id=r.id_moderateur ORDER BY r.id_point", PDO::FETCH_NUM) as $ligne)
    fputcsv($sortie, $ligne);
  die();
}

/******* Actions (POST) *******/
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $ajax = !empty($_POST['ajax']);
  $reponse = function ($ok, $message) use ($ajax, $f) {
    if ($ajax)
      sortie_json($ok, $message);
    header('Location: '.url_page($f, $message));
    die();
  };

  if (!hash_equals($jeton, (string)($_POST['jeton'] ?? '')))
    $reponse(false, "Jeton invalide, rechargez la page.");

  $action = $_POST['action'] ?? '';

  if ($action == 'reserver')
  {
    $deja = (int)$pdo->query("SELECT count(*) FROM rangement_fiches WHERE id_moderateur=$moi AND decision IS NULL")->fetchColumn();
    $a_prendre = $TAILLE_LOT - $deja;
    if ($a_prendre <= 0)
      $reponse(false, "Votre lot de $TAILLE_LOT fiches n'est pas terminé.");
    $ordre = ($f['tri'] == 'recentes') ? 'DESC' : 'ASC';
    $pris = $pdo->exec("INSERT INTO rangement_fiches (id_point, id_moderateur)
      SELECT p.id_point, $moi FROM points p WHERE ".sql_candidates($f)."
      ORDER BY p.date_creation $ordre, p.id_point LIMIT $a_prendre
      ON CONFLICT (id_point) DO NOTHING");
    $reponse(true, $pris ? "$pris fiche(s) réservée(s)." : "Aucune fiche disponible avec ce filtre.");
  }

  if ($action == 'liberer')
  {
    $id = (int)($_POST['id_point'] ?? 0);
    $pris = $pdo->exec("DELETE FROM rangement_fiches WHERE id_point=$id AND id_moderateur=$moi AND decision IS NULL");
    if (!$pris)
      $reponse(false, "Cette fiche n'est pas dans votre lot (déjà traitée, ou réservation expirée). Rechargez la page.");
    $pdo->exec("UPDATE rangement_fiches SET reserve_le=now() WHERE id_moderateur=$moi AND decision IS NULL");
    $reponse(true, "Fiche $id rendue aux autres.");
  }

  if ($action == 'rien' or $action == 'convertir')
  {
    $id = (int)($_POST['id_point'] ?? 0);

    // On ne traite que sa propre réservation, encore ouverte
    $reservation = $pdo->query("SELECT 1 FROM rangement_fiches WHERE id_point=$id AND id_moderateur=$moi AND decision IS NULL")->fetchColumn();
    if (!$reservation)
      $reponse(false, "Cette fiche n'est pas dans votre lot (déjà traitée, ou réservation expirée). Rechargez la page.");

    if ($action == 'convertir')
    {
      // On ne passe à la fonction du modèle que le strict nécessaire : elle ne touche que les champs présents,
      // mais impose nom, altitude, précision GPS et geojson (qui sert aussi au contrôle des cabanes cachées alentour)
      $fiche = $pdo->query("SELECT id_point, nom, altitude, id_type_precision_gps, topic_id, ST_AsGeoJSON(geom,15) AS geojson
        FROM points WHERE id_point=$id AND id_point_type=$TYPE_CABANE AND conditions_utilisation='fermeture'", PDO::FETCH_OBJ)->fetch();
      if (!$fiche)
        $reponse(false, "La fiche a changé entre-temps, rechargez la page.");
      $fiche->id_point_type = $TYPE_BATIMENT;
      $fiche->conditions_utilisation = 'fermeture';
      $retour = modification_ajout_point($fiche, $moi);
      if (!empty($retour->erreur))
        $reponse(false, "Conversion refusée : ".strip_tags($retour->message));
    }

    $pdo->exec("UPDATE rangement_fiches SET decision=".$pdo->quote($action == 'rien' ? 'rien' : 'converti').", traite_le=now()
      WHERE id_point=$id AND id_moderateur=$moi AND decision IS NULL");
    // Activité : le reste du lot reste à moi encore le délai complet
    $pdo->exec("UPDATE rangement_fiches SET reserve_le=now() WHERE id_moderateur=$moi AND decision IS NULL");
    $reponse(true, $action == 'rien' ? "Fiche $id retirée de la liste globale." : "Fiche $id convertie en bâtiment inutilisable.");
  }

  $reponse(false, "Action inconnue.");
}

/******* Données d'affichage *******/
$stats = $pdo->query("SELECT
    (SELECT count(*) FROM points p WHERE ".sql_candidates(array('region'=>0,'annee_min'=>0,'annee_max'=>0,'mot'=>'')).") AS disponibles,
    count(*) FILTER (WHERE decision IS NULL) AS reservees,
    count(*) FILTER (WHERE decision='rien') AS rien,
    count(*) FILTER (WHERE decision='converti') AS converties,
    count(*) FILTER (WHERE decision='hors_outil') AS hors_outil
  FROM rangement_fiches", PDO::FETCH_OBJ)->fetch();
$disponibles_filtre = (int)$pdo->query("SELECT count(*) FROM points p WHERE ".sql_candidates($f))->fetchColumn();

$regions = $pdo->query("SELECT id_polygone, nom_polygone, id_polygone_type FROM polygones
  WHERE id_polygone_type IN (1,10,11) ORDER BY CASE id_polygone_type WHEN 10 THEN 1 WHEN 1 THEN 2 ELSE 3 END, nom_polygone", PDO::FETCH_OBJ)->fetchAll();
$types_region = array(10 => 'Départements', 1 => 'Massifs', 11 => 'Zones');

$lot = $pdo->query("SELECT p.id_point, p.nom, p.altitude, p.date_creation, p.date_modification_fiche, p.places, p.manque_un_mur,
    p.remarques, p.acces, p.proprietaires, ST_X(p.geom) AS lon, ST_Y(p.geom) AS lat, r.reserve_le,
    (SELECT string_agg(pol.nom_polygone, ', ' ORDER BY pol.id_polygone_type DESC, pol.nom_polygone) FROM polygones pol
       WHERE pol.id_polygone_type IN (1,10) AND ST_Intersects(pol.geom,p.geom)) AS lieux,
    (SELECT count(*) FROM commentaires c WHERE c.id_point=p.id_point) AS nb_commentaires
  FROM rangement_fiches r JOIN points p ON p.id_point=r.id_point
  WHERE r.id_moderateur=$moi AND r.decision IS NULL ORDER BY p.date_creation, p.id_point", PDO::FETCH_OBJ)->fetchAll();

$motif_alerte = '/priv[ée]e?s?|interdit|r[ée]serv[ée]e?s?|berger|propri[ée]taire|ruine|squat|habit[ée]/iu';
?><!doctype html>
<html lang="fr"><head><meta charset="utf-8">
<title>Rangement des cabanes fermées</title>
<meta name="robots" content="noindex">
<?php foreach ($vue->css_lib_head ?? array() as $css_lib) { ?><link rel="stylesheet" href="<?=h($css_lib)?>">
<?php } ?>
<style>
body{font-family:sans-serif;margin:1em 2em;max-width:80em}
h1{font-size:1.4em} table{border-collapse:collapse;margin:.5em 0} td,th{border:1px solid #aaa;padding:.3em .6em;text-align:left;vertical-align:top}
th{background:#eee} form.filtres label{margin-right:1em;white-space:nowrap}
.fiche{border:1px solid #888;padding:.6em;margin:.8em 0;background:#fafafa;display:flex;gap:1em;flex-wrap:wrap}
.fiche .infos{flex:1 1 22em;min-width:0} .fiche .carte{flex:0 0 min(100%,34em);height:26em}
.fiche h2{font-size:1.1em;margin:0 0 .3em}
.alerte{background:#fdd;padding:0 .2em} .texte{white-space:pre-wrap;background:#fff;border:1px solid #ddd;padding:.3em;margin:.2em 0 .6em}
.etiquette{font-weight:bold;font-size:.9em}
.message{padding:.5em;margin:.5em 0;background:#dfd;border:1px solid #8b8} .message.erreur{background:#fdd;border-color:#b88}
button{padding:.4em .8em;margin-right:.5em;cursor:pointer} button.danger{background:#fc9}
.petit{color:#555;font-size:.9em}
</style></head><body>
<h1>Rangement des cabanes non gardées « fermées »</h1>
<p class="petit">Outil temporaire, voir le fil modérateurs « Rangement des anciennes fiches de points non utilisables ». Moi : <?=h($user->data['username'])?>.</p>

<div id="message"><?php if (!empty($_GET['message'])) { ?><div class="message"><?=h($_GET['message'])?></div><?php } ?></div>

<h3>Avancement</h3>
<table><tr><th>À ranger (disponibles)</th><th>Réservées</th><th>Retirées de la liste (inchangées)</th><th>Converties</th><th>Traitées hors outil</th></tr>
<tr><td><?=$stats->disponibles?></td><td><?=$stats->reservees?></td><td><?=$stats->rien?></td><td><?=$stats->converties?></td><td><?=$stats->hors_outil?></td></tr></table>
<p class="petit"><a href="?export=csv">export CSV</a></p>

<h3>Me réserver un lot de <?=$TAILLE_LOT?> fiches</h3>
<form class="filtres" method="post" action="<?=h(strtok($_SERVER['REQUEST_URI'], '?'))?>">
  <input type="hidden" name="jeton" value="<?=h($jeton)?>"><input type="hidden" name="action" value="reserver">
  <label>Région
    <select name="region"><option value="0">toutes</option>
    <?php $type_courant = null; foreach ($regions as $r) {
      if ($r->id_polygone_type != $type_courant) { if ($type_courant !== null) echo '</optgroup>'; $type_courant = $r->id_polygone_type; echo '<optgroup label="'.h($types_region[$type_courant]).'">'; }
      echo '<option value="'.$r->id_polygone.'"'.($f['region'] == $r->id_polygone ? ' selected' : '').'>'.h($r->nom_polygone).'</option>';
    } echo '</optgroup>'; ?>
    </select></label>
  <label>Créées de <input name="annee_min" size="4" value="<?=$f['annee_min'] ?: ''?>"> à <input name="annee_max" size="4" value="<?=$f['annee_max'] ?: ''?>"></label>
  <label>Mot <input name="mot" size="12" value="<?=h($f['mot'])?>" placeholder="ex. privé"></label>
  <label>Tri <select name="tri"><option value="anciennes">plus anciennes d'abord</option><option value="recentes"<?=$f['tri']=='recentes'?' selected':''?>>plus récentes d'abord</option></select></label>
  <button type="submit">Me réserver <?=$TAILLE_LOT?> fiches</button>
  <span class="petit"><?=$disponibles_filtre?> disponible(s) avec ce filtre (le compte se met à jour après chaque réservation).</span>
</form>

<h3>Mon lot (<?=count($lot)?> fiche(s), rendu aux autres après 1 heure sans action)</h3>
<?php if (!$lot) echo '<p>Aucune fiche réservée.</p>'; ?>
<?php foreach ($lot as $p) {
  $alertes = preg_match_all($motif_alerte, $p->nom.' '.$p->remarques.' '.$p->acces.' '.$p->proprietaires, $trouves) ? array_unique(array_map('mb_strtolower', $trouves[0])) : array();
  $osm = "https://www.openstreetmap.org/?mlat={$p->lat}&mlon={$p->lon}#map=17/{$p->lat}/{$p->lon}";
?>
<div class="fiche" id="fiche-<?=$p->id_point?>">
 <div class="infos">
  <h2><a href="/point/<?=$p->id_point?>/" target="_blank"><?=h($p->nom)?></a> <span class="petit">#<?=$p->id_point?></span></h2>
  <div class="petit">
    <?=(int)$p->altitude?> m — créée le <?=h(substr($p->date_creation, 0, 10))?> — modifiée le <?=h(substr($p->date_modification_fiche, 0, 10))?>
    — <?=h($p->lieux ?: 'hors massif et département')?> — <?=$p->nb_commentaires?> commentaire(s)
    — places : <?=h($p->places)?><?=$p->manque_un_mur ? ' — manque un mur' : ''?>
    — <a href="<?=h($osm)?>" target="_blank">OSM</a> — <a href="/point/<?=$p->id_point?>/" target="_blank">fiche</a>
  </div>
  <?php if ($alertes) { ?><div>À regarder : <?php foreach ($alertes as $a) echo '<span class="alerte">'.h($a).'</span> '; ?></div><?php } ?>
  <?php foreach (array('Propriétaires / accessibilité' => $p->proprietaires, 'Remarques' => $p->remarques, 'Accès' => $p->acces) as $etiquette => $valeur) { ?>
    <div class="etiquette"><?=$etiquette?></div>
    <div class="texte"><?=trim($valeur) === '' ? '<span class="petit">(vide)</span>' : h(trim($valeur))?></div>
  <?php } ?>
  <form method="post" action="<?=h(strtok($_SERVER['REQUEST_URI'], '?'))?>" class="actions" style="margin-top:.5em">
    <input type="hidden" name="jeton" value="<?=h($jeton)?>"><input type="hidden" name="id_point" value="<?=$p->id_point?>">
    <button type="submit" name="action" value="liberer">Ne rien décider et laisser aux autres</button>
    <button type="submit" name="action" value="rien">Retirer de la liste globale</button>
    <button type="submit" name="action" value="convertir" class="danger">Convertir en bâtiment inutilisable</button>
  </form>
 </div>
 <div class="carte" id="carte-<?=$p->id_point?>" data-lat="<?=h($p->lat)?>" data-lon="<?=h($p->lon)?>"></div>
</div>
<?php } ?>

<?php foreach ($vue->java_lib_foot ?? array() as $js_lib) { ?><script src="<?=h($js_lib)?>"></script>
<?php } ?>

<script>
/* global L, couchesDeFond, clusterPOI, controlesComuns */
// Cartes leaflet des fiches : mêmes fonds, points refuges.info et contrôles que la fiche d'un point (vues/point.js).
// Une carte par fiche, créée seulement quand elle approche de l'écran. Le fond choisi sur l'une (ex. IGN TOP25 pour
// repérer le pictogramme « abri ») est appliqué à toutes les autres.
(function () {
  var cartes = [];
  var fondChoisi = 'TOP25'; // Par défaut la carte IGN, pour repérer le pictogramme « abri » (et non le fond mémorisé par le site)
  var cles = <?=json_encode($config_wri["mapKeys"])?>;

  function creerCarte(div) {
    var lat = parseFloat(div.dataset.lat), lon = parseFloat(div.dataset.lon);
    var carte = L.map(div);
    var fonds = couchesDeFond(cles);
    var nom = fonds[fondChoisi] ? fondChoisi : Object.keys(fonds)[0];
    var entree = {carte: carte, fonds: fonds, courant: nom};
    fonds[nom].addTo(carte);
    clusterPOI('https://<?=$_SERVER["SERVER_NAME"]?>', '<?=$vue->version_features?>').addTo(carte);
    controlesComuns(carte).forEach(function (c) { c.addTo(carte); });
    L.control.layers(fonds, {
      'Itinéraires': L.tileLayer('https://tile.waymarkedtrails.org/hiking/{z}/{x}/{y}.png', {maxZoom: 18}),
    }).addTo(carte);
    var marqueur = L.marker([lat, lon], {
      icon: L.icon({iconUrl: '/images/cadre.svg', iconSize: [32, 44], iconAnchor: [16, 22]}),
    }).addTo(carte);
    carte.setView(marqueur.getLatLng(), 15);

    cartes.push(entree);
    carte.on('baselayerchange', function (e) {
      entree.courant = e.name;
      if (e.name === fondChoisi) return;
      fondChoisi = e.name;
      cartes.forEach(function (autre) {
        if (autre === entree || autre.courant === e.name || !autre.fonds[e.name]) return;
        autre.carte.removeLayer(autre.fonds[autre.courant]);
        autre.fonds[e.name].addTo(autre.carte);
        autre.courant = e.name;
      });
    });
  }

  var observateur = new IntersectionObserver(function (entrees) {
    entrees.forEach(function (e) {
      if (!e.isIntersecting) return;
      observateur.unobserve(e.target);
      creerCarte(e.target);
    });
  }, {rootMargin: '400px'});
  document.querySelectorAll('.fiche .carte').forEach(function (div) { observateur.observe(div); });
})();

// Traite le clic sans recharger la page : la fiche disparaît du lot, comme dans la liste de tout le monde
document.querySelectorAll('form.actions').forEach(function (form) {
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var bouton = e.submitter;
    var donnees = new FormData(form);
    donnees.set('action', bouton.value);
    donnees.set('ajax', '1');
    form.querySelectorAll('button').forEach(function (b) { b.disabled = true; });
    fetch(form.getAttribute('action'), {method: 'POST', body: donnees}).then(function (r) { return r.json(); }).then(function (rep) {
      var zone = document.getElementById('message');
      zone.innerHTML = '';
      var div = document.createElement('div');
      div.className = 'message' + (rep.ok ? '' : ' erreur');
      div.textContent = rep.message;
      zone.appendChild(div);
      if (rep.ok) form.closest('.fiche').remove();
      else form.querySelectorAll('button').forEach(function (b) { b.disabled = false; });
    }).catch(function () {
      alert('Erreur réseau, rechargez la page.');
      form.querySelectorAll('button').forEach(function (b) { b.disabled = false; });
    });
  });
});
</script>
</body></html>
<?php
// On quitte ici : le routeur chercherait sinon une vue maintenance.html qui n'existe pas
die();
