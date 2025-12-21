<?php
// Je centralise ici les opérations spécifiques à http sur les headers

function headers_cors_par_default()
{
  global $config_wri;
  if($config_wri['autoriser_CORS']===TRUE) 
  {
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Origin: *");
  }
}

function headers_cache_api($secondes_de_cache = 60)
{
  $ts = gmdate("D, d M Y H:i:s", time() + $secondes_de_cache) . " GMT";
  header("Pragma: cache");
  header("Expires: $ts");
  header("Cache-Control: max-age=$secondes_de_cache");
}
