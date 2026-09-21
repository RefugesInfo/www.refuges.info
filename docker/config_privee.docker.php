<?php
/*************************************************
Modèle de configuration locale pour la stack Docker.
Copié automatiquement vers ../config_privee.php par `make up`
(config_privee.php est gitignoré : ne pas y mettre de secrets réels).
*************************************************/

// Accès à Postgresql (service "db" du docker-compose)
$config_wri['serveur_pgsql']="db";
$config_wri['utilisateur_pgsql']="refuges";
$config_wri['mot_de_passe_pgsql']="refuges";
$config_wri['base_pgsql']="refuges";

// Clés des cartes laissées vides en local :
// les fonds de carte sous contrat (IGN, Mapbox...) ne s'afficheront pas.
$config_wri['mapKeys'] = [
  'thunderforest' => '',
  'mapbox' => '',
  'bing' => '',
  'ign' => '',
];

// Options de développement : afficher les erreurs PHP à l'écran
$config_wri['debug']=true;
ini_set('error_reporting', E_ALL ^ E_NOTICE ^ E_DEPRECATED);
ini_set('display_errors', '1');

// Derrière un reverse proxy qui termine le TLS (Traefik, nginx...) : le conteneur ne voit que du HTTP.
// On suit X-Forwarded-Proto, sinon le bandeau refuse d'afficher le formulaire de connexion
// ("vous devez passer en HTTPS", voir vues/bandeau.html) et phpBB construit des URL en http.
if (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https')
{
  $_SERVER['HTTPS'] = 'on';
  $_SERVER['REQUEST_SCHEME'] = 'https';
  $_SERVER['SERVER_PORT'] = 443;
}
