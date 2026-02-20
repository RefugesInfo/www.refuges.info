<?php
require_once("../../includes/config.php");
require_once("bdd.php");

$query = "SELECT id_point, proprio, site_officiel FROM points WHERE site_officiel IS NOT NULL AND site_officiel != '' limit 100";
$res = $pdo->query($query) or die($query);

while ($row  =$res->fetch()) {
  $nl = empty($row->proprio) ? "" : "\n";
  $npp = str_replace("'", "''", $row->proprio.$nl."Site officiel: ".$row->site_officiel);
  $query_update = "UPDATE points SET proprio = '$npp', site_officiel = NULL WHERE id_point = $row->id_point";

  $pdo->query($query_update) or die($query_update);
  //file_put_contents("move_site_officiel.log", $query_update.PHP_EOL.PHP_EOL.PHP_EOL, FILE_APPEND );

  var_dump($row);
  var_dump($query_update);
}
