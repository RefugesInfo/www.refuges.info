// Force la sélection du type de point concerné dans le sélecteur de couches de la carte
const nom_type="<?=$vue->point->nom_type?>";

if(localStorage.checkedLayers)
  localStorage.checkedLayers += ' ,';
else
  localStorage.checkedLayers = '';

localStorage.checkedLayers += nom_type.charAt(0).toUpperCase() + nom_type.slice(1);

// Affichage de la carte
const map = initLeafletMap(
  'carte-point',
  'https://<?=$_SERVER["SERVER_NAME"]?>',
  <?=$vue->version_features?>,
  <?=json_encode($config_wri['mapKeys'])?>
);

// Marqueur de position de cabane
L.marker(
  [<?=$vue->point->latitude?>, <?=$vue->point->longitude?>],
  {
    icon: L.icon({
      iconUrl: '/images/cadre.svg',
      iconSize: [32, 44],
      iconAnchor: [16, 22],
    }),
  }
).addTo(map);

map.setView([<?=$vue->point->latitude?>, <?=$vue->point->longitude?>], 15);
