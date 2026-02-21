<?php

$serveur = "https://dom.refuges.info/";
$formats = ['geojson','kml','gml','gpx','csv','xml','rss'];
$format_texte = ['bbcode','texte','markdown'];
$detail = ['simple','complet'];
$bbox = '0.75,42.5,0.8,42.6'; // Lérida
$massif = 5066; // Lérida https://refuges.info/nav/5066
$point = 5314; // Baserca https://refuges.info/point/5314
$depuis = 1769904000; // 01/02/2026

$urls_to_test = [
  "non-reg" => [
    // Doc API
    "bbox?bbox=$bbox&type_points=all",
    "massif?massif=$massif&type_points=all",
    "point?id=$point&format=xml&format_texte=html",
    "contributions?format=rss&format_texte=html&massif=$massif",
    "polygones?massif=$massif&format=gml",
    // Accueil
    "bbox?nb_points=all&cluster=0.1&bbox=$bbox",
    "bbox?nb_points=all&bbox=$bbox",
    "polygones?type_polygon=1&bbox=-Infinity,-90,Infinity,90",
    // nav
    "polygones?massif=$massif&bbox=-Infinity,-90,Infinity,90",
    "massif?massif=$massif&type_points=7,10,9,29,23,3,28&nb_points=all&cluster=0.1&bbox=$bbox",
    // Edit massif"",
    "polygones?type_polygon=1&bbox=-Infinity,-90,Infinity,90",
    // Point & modif point
    "bbox?nb_points=all&bbox=$bbox",
  ],
];

foreach ($formats AS $for)
  foreach ($detail AS $det)
    $urls_to_test['non-reg'][] = "point?id=$point&format=$for&detail=$det";

foreach ($format_texte AS $dt)
  $urls_to_test['non-reg'][] = "point?id=$point&format_texte=$dt";

foreach ($urls_to_test AS $type_test => $apis_to_test) {
  if(!is_dir($type_test))
    mkdir($type_test);

  foreach ($apis_to_test AS $api) {
    preg_match_all('/'.implode('|',$formats).'/', $api, $match);
    $ext = $match[0][0] ?? 'json';
    $url = $serveur.'api/'.$api.'&nb_points=1';
    $nf = str_replace('-.', '.', str_replace(
      ['?','&','=',',',$ext.'.'],
      ['_','_','-','_','.'],
      "$type_test/$api.$ext"
    ));

    echo "<br><a href=\"$url\">$nf";

    $duree = microtime(true);
    $fc = $fc = file_get_contents($url);
    $duree = round(microtime(true) - $duree, 3);

    if(str_contains($url, 'xml'))
      $fc = str_replace("><", ">\n<", $fc);

    $trie = "";
    if($fc[0] == '{') {
      echo " (TRI, $duree s)";
      $trie = ", Les données ont été triées par clés et beautifiées pour simplifier la comparaison";

      $json = json_decode($fc);
      ksort_recursive($json);
      $fc = json_encode($json, JSON_PRETTY_PRINT);
      $fc = str_replace('    ', '  ', $fc);
    }
    else
      echo " ($duree s)";

    file_put_contents($nf, "$url\nDélai : $duree s$trie.\n\n$fc");
  }
}

function ksort_recursive(&$struct) {
  if (is_object($struct))
    $struct=(array)$struct;

  if (is_array($struct)) {
    ksort($struct);
    array_walk($struct, 'ksort_recursive');
  }
}
