<?php
/*******************************************************************************
Ce fichier index.php est le fichier de point d'entrée de tout le site qu'on a codé nous
(ou presque, reste des vielleries toujours pas converties)

Il charge des trucs absoument généraux à tout le site mais par défaut, son seul
rôle consiste à charger la config, et le fichier de ./routes/ pour mapper les urls
On fera un petit effort pour ne lui faire faire qu'un minimum de choses car il peut
très bien être appelé pour des routes extrêmement simples qui ne font qu'ouvrir une vue html
toute bête ou des controlleurs n'ayant pas besoin de session par exemple
*******************************************************************************/

//Tout tout début de notre code, cela servira ultérieurement pour du profiling
$__time_start = microtime(true);

// obligatoire pour tout le site, donc on include pour tous les appels
require_once ('includes/config.php');

// short_open_tag est désactivé : une balise php courte "<?" oubliée dans une vue n'est plus interprétée et ressort telle
// quelle dans la page. On le signale dans le log d'erreur (grep "balise php courte") pour retrouver ces oublis.
// Par morceaux de 8 Ko (pas de mise en mémoire complète des gros exports), la sortie n'est jamais modifiée.
ob_start(function ($tampon) {
  static $deja_signale = false, $page_html = null;
  if ($page_html === null) // le type de contenu est connu dès le premier morceau
  {
    $page_html = true;
    foreach (headers_list() as $entete)
      if (stripos($entete, 'Content-Type:') === 0 and stripos($entete, 'text/html') === false)
        $page_html = false;
  }
  if ($page_html and !$deja_signale and preg_match('/<\?(?!xml)/', $tampon))
  {
    $deja_signale = true;
    error_log("balise php courte oubliee dans la sortie de ".($_SERVER['REQUEST_URI'] ?? '?'));
  }
  return false; // false : la sortie d'origine est envoyée telle quelle
}, 8192);
require_once ('gestion_erreur.php');

// On "démarre" le site
require_once ('generales.routes.php');

