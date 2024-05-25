<?php
header("Content-Type: application/javascript");

include "ressources/gps.php";
echo "const jsVars = $js_vars;" . PHP_EOL;
echo file_get_contents("ressources/service-worker.js");
