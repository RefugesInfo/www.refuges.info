// Initialisation de la carte
const map = L.map('carte-point');

// Couches tuilées
const tileLayers = couchesDeFond(<?=json_encode($config_wri['mapKeys'])?>),
  permalink = sessionStorage.permalink.split('/');

// Chargement du fond de carte actif
permalinkControl(map);
(tileLayers[decodeURI(permalink[3])] || Object.values(tileLayers)[0]).addTo(map);

// Points refuges.info
clusterPOI('https://<?=$_SERVER["SERVER_NAME"]?>', <?=$vue->version_features?>).addTo(map);

// Contrôles
controlesComuns(map).forEach((control) => control.addTo(map));

L.control.layers(tileLayers, {
  'Itinéraires': coucheItineraires,
}).addTo(map);

// Marqueur de position de cabane
L.marker(
  [<?=$vue->point->latitude?>, <?=$vue->point->longitude?>], {
    icon: L.icon({
      iconUrl: '/images/cadre.svg',
      iconSize: [32, 44],
      iconAnchor: [16, 22],
    }),
  }
).addTo(map);

// Lance le chargement de la carte
map.setView([<?=$vue->point->latitude?>, <?=$vue->point->longitude?>], 15);
