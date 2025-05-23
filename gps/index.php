<!DOCTYPE html>
<?php include("ressources/gps.php")?>
<!--
© Dominique Cavailhez 2019
https://github.com/Dominique92/myol
Based on https://openlayers.org
-->
<html lang="fr">

<head>
  <!-- "Usual" title charset description viewport -->
  <title>My GPS</title>
  <meta charset="utf-8">
  <meta name="description" content="Offline GPS based on openlayers & Progressive Web Application">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
  <!-- Good old favicon -->
  <link rel="icon" href="ressources/favicon.svg" type="image/svg+xml">
  <!-- Android / Chrome -->
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="theme-color" content="white">
  <!-- IOS app icon + mobile Safari -->
  <link rel="apple-touch-icon" href="ressources/icon-512.png">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Hello World">
  <!-- Windows -->
  <meta name="msapplication-TileImage" content="ressources/icon-512.png">
  <meta name="msapplication-TileColor" content="#ffffff">

  <!-- PWA -->
  <link href="manifest.json" rel="manifest">
  <link href="<?=$myol_rep?>myol.css" rel="stylesheet">
  <style>
    <?=file_get_contents("ressources/gps.css").PHP_EOL.PHP_EOL?>
  </style>
</head>

<body>
  <div id="map"></div>
  <div id="myol-gps-traces">
    <p>Afficher une randonnée</p>
  </div>
  <div id="myol-button-upgrade">
    <p>New version</p>
    <p> <?=$last_change_date?> </p>
    <a href="">Reload</a>'
  </div>
  <div id="myol-button-upgrade-fr">
    <p>Une nouvelle version</p>
    <p>ou de nouvelles traces</p>
    <p>sont disponibles.</p>
    <p> <?=$last_change_date?> </p>
    <a href="">Recharger la page</a>
  </div>
  <div id="myol-gps-help-fr">
    <p>Vous pouvez utiliser ce GPS hors réseau en l'installant:</p>
    <p>- Explorateur -> options -> ajoutez à l'écran d'accueil (ou installer)</p>
    <p>Les fonds de cartes visualisés seront conservés dans le cache de l'explorateur quelques jours et pourront être affichées même hors de portée du réseau.</p>
    <p><u>Hors réseau:</u></p>
    <p>- Ouvrez le marque-page ou l'application</p>
    <p>- Lancez la localisation en cliquant sur &#x2295;</p>
    <p>- Si vous avez un fichier trace .gpx dans votre mobile, visualisez-le en cliquant sur &#x1F4C2;</p>
    <?php if (empty($config_wri)) { ?>
      <p>- Si vous voulez suivre une trace du serveur, affichez là en cliquant sur &#128694;</p>
    <?php } ?>
    <hr>
    <p>* Fonctionne bien sur Android avec Chrome, Edge, Brave, Samsung Internet, fonctions réduites avec Firefox & Safari</p>
    <p>* Cette application ne permet pas de visualiser ni d'enregistrer le parcours</p>
    <p>* Aucune donnée ni géolocalisation n'est remontée ni mémorisée.</p>
    <hr>
    <p>Version <?=$last_change_date?> </p>
  </div>
  <?php foreach ($html_include as $html)
    echo file_get_contents($html).PHP_EOL;
  ?>

  <script src="<?=$myol_rep?>myol.js"></script>
  <script>
    const jsVars = <?=$js_vars?>;

    <?php foreach ($js_include as $js)
      echo file_get_contents($js).PHP_EOL;
    ?>
  </script>
  <script src="ressources/gps.js" defer></script>
</body>

</html>