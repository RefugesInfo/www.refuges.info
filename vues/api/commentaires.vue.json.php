<?php

header("Content-disposition: filename=commentaires.json");
header("Content-Type: application/json; charset=UTF-8");
header("Content-Transfer-Encoding: binary");
headers_cors_par_default();
headers_cache_api();

$commentaires['copyright'] = $config_wri['copyright_API'];
echo json_encode($commentaires, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
