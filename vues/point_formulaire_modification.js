/* global couchesDeFond, clusterPOI, positionMemoryControl, positionMemoryArray, controlesComuns */

// Utilitaire de saisie des boutons du formulaire
/* eslint-disable-next-line no-unused-vars */
function afficheEtSet(el, affiche, valeur) {
  document.getElementById(el).style.visibility = affiche;
  document.getElementById(el).value = valeur;
  return false;
}

// TEMPORAIRE — compatibilité anciens navigateurs : Firefox < 121 (ESR 115, Windows 7/8) ne gère pas :has(),
// d'où ce repli qui marque la pilule cochée (voir label.coche dans style_formulaire.css).
// À supprimer avec la règle CSS quand ces navigateurs auront disparu (~2031).
function marquePilulesCochees() {
  document.querySelectorAll('form#form_point .booleen input[type=radio]').forEach((radio) => {
    if (radio.closest('label'))
      radio.closest('label').classList.toggle('coche', radio.checked);
  });
}
marquePilulesCochees();
document.querySelectorAll('form#form_point .booleen input[type=radio]').forEach((radio) => {
  radio.addEventListener('change', marquePilulesCochees);
});

// Initialisation de la carte
const map = L.map('carte-saisie');

// Couches tuilées
const tileLayers = couchesDeFond(<?=json_encode($config_wri["mapKeys"])?>);

// Chargement du fond de carte actif
(tileLayers[decodeURI(positionMemoryArray[3])] || Object.values(tileLayers)[0]).addTo(map);

// Points refuges.info
clusterPOI('https://<?=$_SERVER["SERVER_NAME"]?>', '<?=$vue->version_features?>').addTo(map);

// Contrôles
controlesComuns(map).forEach((control) => control.addTo(map));
L.control.layers(tileLayers).addTo(map);

// Initialisation de la position de la carte
<?php if(empty($vue->point->id_point)) { ?>
  map.setView([positionMemoryArray[1], positionMemoryArray[2]], 15);
<?php } else { ?>
  map.setView([<?=$vue->point->latitude?>,<?=$vue->point->longitude?>], 12);
<?php } ?>

// Mémorisation des glissements de la carte
positionMemoryControl(map);

// Marqueur déplaçable d'édition de position de cabane
const champsPositionEls = document.querySelectorAll('#champs-position input'),
  //TODO no click, no cursor
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

function deplacerMarqueur(ll) {
  marqueur.setLatLng(ll);

  champsPositionEls[1].value = Math.round(ll.lng * 100000) / 100000;
  champsPositionEls[2].value = Math.round(ll.lat * 100000) / 100000;

  champsPositionEls[0].value =
    '{"type":"Point","coordinates":[' +
    champsPositionEls[1].value + ',' + champsPositionEls[2].value +
    ']}';
}

// Réponse aux changement de champs input
/* eslint-disable-next-line no-unused-vars */
function champPositionChange() {
  deplacerMarqueur(L.latLng(champsPositionEls[2].value, champsPositionEls[1].value));
  map.panTo(marqueur.getLatLng());
}

// Initialisation des champs position
deplacerMarqueur(marqueur.getLatLng());

// Réponse aux changement de champs input
marqueur.on('drag', () => deplacerMarqueur(marqueur.getLatLng()));

// Repositionne le marqueur sur un double clic
map.doubleClickZoom.disable();
map.on('dblclick', (evt) => deplacerMarqueur(evt.latlng));