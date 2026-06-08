// Carte leaflet

const permalinkInit = (localStorage.permalink || '5/46.5/5').split('/');
// Défaut : zoom/latitude/longitude

permalinkInit[0] = Math.min(parseInt(permalinkInit[0]), 10);
localStorage.permalink = permalinkInit.join('/');

const map = initMap(
  'carte-accueil',
  'https://<?=$_SERVER["SERVER_NAME"]?>',
  <?=json_encode($config_wri['mapKeys'])?>
);
