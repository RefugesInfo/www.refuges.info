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
