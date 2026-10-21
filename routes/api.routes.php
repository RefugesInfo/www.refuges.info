<?php
/**************************************************
 *              ROUTEUR de l'API
 * Ce fichier appelle juste le bon controlleur.
 * La vue et le modèle sont appellés par le controlleur.
 * cf. : https://bpesquet.developpez.com/tutoriels/php/evoluer-architecture-mvc/images/3.png
 *
 * Changelog :
 *   * 18/10/2014 - Léo - Version intiale :
 *          découpage URL, redirection sur le bon
 *          controleur.
 *
**************************************************/

// ?langue=en|it|es|de : liens (lien_point, lien_polygone) et messages dans cette langue, sans changer l'URL de l'API
// (fr ou valeur inconnue = français). Les cartes le passent pour que les clics mènent à la bonne version.
$langue_api = $_GET['langue'] ?? '';
if (in_array($langue_api, $config_wri['langues_url'], true))
{
  $controlleur->langue = $langue_api;
  $config_wri['langue_courante'] = $langue_api;
  $config_wri['url_suffixe_langue'] = $langue_api.'/';
  setlocale(LC_MESSAGES, $config_wri['locales_systeme'][$langue_api] ?? 'fr_FR.UTF-8');
}

// Cible sera le contenu de l'URL entre /api/ et ?argument=
$cible = $controlleur->url_decoupee[1] ?? '';
$cible = str_replace($_SERVER['QUERY_STRING'],'',$cible); // On enlève ce qu'il y a après le ?
$cible = str_replace('?','',$cible); // On enlève le ? (implique pas de ? dans les noms de fichiers)

switch ($cible) {
  case 'bbox': case 'point': case 'massif':
    include($config_wri['chemin_controlleurs'].'api/points.php');
    break;
  case 'commentaires':
    include($config_wri['chemin_controlleurs'].'api/commentaires.php');
    break;
  case 'contributions':
    include($config_wri['chemin_controlleurs'].'api/contributions.php');
    break;
  case 'polygones':
    include($config_wri['chemin_controlleurs'].'api/polygones.php');
    break;
  case 'doc':
    // Des fichiers html ou css simples, pas besoin d'un controler pour faire "include"
    if ($controlleur->url_decoupee[2] == "")
        include($config_wri['chemin_vues'].'api/doc/index.html');
    else
        include($config_wri['chemin_vues'].'api/doc/'.$controlleur->url_decoupee[2]);

    break;
  default:
    header('Location:'.'/api/doc/');
    break;
}

// Trace des appels API exploitables dans "Menu" -> "Historique des traces"
if (isset($config_wri['trace_api_threshold']) &&
  (microtime(true) - $__time_start) > $config_wri['trace_api_threshold'] &&
  isset($pdo)) { // Sauf /api/doc
  require_once ($config_wri['rep_forum'].'ext/RefugesInfo/trace/geoip2/geodata.php');

  $geodata = geodata();
  $geodata['appel'] = 'Requête API';
  $geodata['browser_operator'] = 'api';
  $geodata['text'] = $geodata['uri'];
  $geodata['ext_error'] = null;

  $query = requete_modification_ou_ajout_generique(
    'trace_requettes',
     array_map (fn($str) => $pdo->quote($str), $geodata),
    'insert'
  );
  $pdo->query($query);
}
