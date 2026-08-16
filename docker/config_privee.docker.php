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

// [DEV LOCAL] Fait tourner le site sans le forum phpBB.
// Les dumps SQL publics fournissent un schéma phpBB 3.0/3.1 incompatible avec
// le code phpBB 3.3.17 du dépôt ; comme controlleurs/bandeau.php initialise une
// session phpBB sur chaque page, on la court-circuite en local.
// Voir modeles/identification.php. Retirer si vous disposez d'une vraie base phpBB.
$config_wri['forum_desactive']=true;
