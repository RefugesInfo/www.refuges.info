<!DOCTYPE html>
<?php include("ressources/gps.php")?>
<!--
© Dominique Cavailhez 2019
https://github.com/Dominique92/MyOl
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
  <link href="ressources/favicon.png" type="image/png" rel="icon">
  <!-- Android / Chrome -->
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="theme-color" content="white">
  <!-- IOS app icon + mobile Safari -->
  <link href="ressources/icon-512.png" rel="apple-touch-icon">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Hello World">
  <!-- Windows -->
  <meta name="msapplication-TileImage" content="ressources/icon-512.png">
  <meta name="msapplication-TileColor" content="#ffffff">
  <!-- PWA -->
  <link href="manifest.json" rel="manifest">
  <link href="<?=$dist_rep?>myol.css" rel="stylesheet">
  <script src="<?=$dist_rep?>myol.js"></script>
  </script>
  <link href="ressources/gps.css" rel="stylesheet">
  <script>
    var jsVars = <?=$js_vars?>
  </script>
  <script src="ressources/gps.js" defer></script>
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
    <hr>
    <p>
      <u>Avant le départ:</u>
    </p>
    <p>- Explorateur -> options -> ajoutez à l'écran d'accueil (ou installer)</p>
    <p>Pour mémoriser un fond de carte:</p>
    <p>- Choisissez un fond de carte</p>
    <p>- Placez-vous au point de départ de votre randonnée</p>
    <p>- Zoomez au niveau le plus détaillé que vous voulez mémoriser</p>
    <p>- Déplacez-vous suivant le trajet de votre randonnée suffisamment lentement pour charger toutes les dalles</p>
    <p>- Recommencez avec les fonds de cartes que vous voulez mémoriser</p>
    <p>* Toutes les dalles visualisées une fois seront conservées dans le cache de l'explorateur quelques jours et pourront être affichées même hors de portée du réseau</p>
    <hr>
    <p>
      <u>Hors réseau :</u>
    </p>
    <p>- Ouvrez le marque-page ou l'application</p>
    <p>- Si vous avez un fichier trace .gpx dans votre mobile, visualisez-le en cliquant sur &#x1F4C2;</p>
    <p>- Si vous voulez suivre une trace du serveur, affichez là en cliquant sur &#128694;</p>
    <p>- Lancez la localisation en cliquant sur &#x2295;</p>
    <hr>
    <p>* Fonctionne bien sur Android avec Chrome, Edge, Brave, Samsung Internet, fonctions réduites avec Firefox & Safari</p>
    <p>* Cette application ne permet pas de visualiser ni d'enregistrer le parcours</p>
    <p>* Aucune donnée ni géolocalisation n'est remontée ni mémorisée</p>
    <hr>
    <p>Version <?=$last_change_date?> </p>
  </div>
</body>

</html>