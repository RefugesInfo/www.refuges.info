// Utilitaire de saisie des boutons du formulaire
function affiche_et_set(el, affiche, valeur) {
  document.getElementById(el).style.visibility = affiche;
  document.getElementById(el).value = valeur;
  return false;
}

// Affichage de la carte
const map = initLeafletMap(
  'carte-saisie',
  'https://<?=$_SERVER["SERVER_NAME"]?>',
  <?=$vue->version_features?>,
  <?=json_encode($config_wri['mapKeys'])?>
);

// Marqueur d'édition de position de cabane
const markersLLinputEls = document.querySelectorAll('#markers-lon-lat input'),
  marqueur = L.marker(
    map.getCenter(), {
      icon: L.icon({
        iconUrl: '/images/viseur.svg',
        iconSize: [32, 32],
        iconAnchor: [16, 16],
      }),
      zIndexOffset: 1000,
      draggable: true,
    }
  ).addTo(map);

function centrecCarteAuxInputs() {
  const ll = L.latLng(markersLLinputEls[2].value, markersLLinputEls[1].value);

  marqueur.setLatLng(ll);
  map.panTo(ll);
}

function inputsAuMarqueur() {
  const position = marqueur.getLatLng();

  markersLLinputEls[0].value = '{"type":"Point","coordinates":[' +
    position.lng.toFixed(5) + ',' + position.lat.toFixed(5) +
    ']}"';

  markersLLinputEls[1].value = position.lng.toFixed(5);
  markersLLinputEls[2].value = position.lat.toFixed(5);
}

inputsAuMarqueur();
marqueur.on('drag', inputsAuMarqueur);
