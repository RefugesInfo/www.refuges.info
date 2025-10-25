<?php

header("Content-disposition: filename=commentaires.json");
header("Content-Type: application/json; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
headers_cors_par_default();
headers_cache_api();

$commentaires['copyright'] = $config_wri['copyright_API'];
echo json_encode($commentaires);
