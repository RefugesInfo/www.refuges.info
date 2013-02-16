<?php
require_once("../../modeles/config_privee.php");
putenv("PGPASS=".$config['mot_de_passe_pgsql']);
$params="-d ".$config['base_pgsql']." -H ".$config['serveur_pgsql']." -U ".$config['utilisateur_pgsql']."";
// En option : -C 800 -s au cas où on manquerait de ram (plus long, mais plus fiable)
passthru("osm2pgsql -c --number-processes 2 $params -C 800 -s -S ./default.style -p osm -G -l --unlogged $argv[1]");
print("\n");
?>