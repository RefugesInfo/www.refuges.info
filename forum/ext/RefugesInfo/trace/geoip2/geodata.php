<?php
use GeoIp2\Database\Reader;
include __DIR__.'/../geoip2/geoip2.phar';

function geodata() {
  $ip = $_SERVER['REMOTE_ADDR'];
  $reader_asn = new Reader(__DIR__.'/../geoip2/GeoLite2-ASN.mmdb');
  $geodata_asn = $reader_asn->asn($ip);
  $reader_city = new Reader(__DIR__.'/../geoip2/GeoLite2-City.mmdb');
  $geodata_city = $reader_city->city($ip);

  date_default_timezone_set('UTC');
  global $__time_start;

  return [
    // 'trace_id' => autoincrement,
   'date' => date('r'),

    // ASN / FAI
    'ip' => $ip ?? '0.0.0.0',
    'host' => gethostbyaddr($ip),
    'asn_id' => 'AS'.$geodata_asn->autonomousSystemNumber,
    'asn_name' => $geodata_asn->autonomousSystemOrganization,
    'country_name' => $geodata_city->country->name,
    'city' => $geodata_city->city->name,

    // Serveur
    'uri' => isset($_SERVER['HTTP_HOST']) ?
      (
        ($_SERVER['REQUEST_SCHEME'] ?? '').'://'.
        ($_SERVER['HTTP_HOST'] ?? '').
        ($_SERVER['REQUEST_URI'] ?? '')
      ) : '',
    'referer' => $_SERVER['HTTP_REFERER'] ?? '',
    'post' => implode(',',array_keys($_POST)),
    'files' => serialize($_FILES),
    'duree' => isset($__time_start) ? round((microtime(true) - $__time_start) * 1000) : 0,

    // Navigateur
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
    'language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '',
  ];
}
