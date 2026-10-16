// Initialisation de la carte
const map = L.map('carte-edit', {
    pmIgnore: false,
  }),
  tileLayers = couchesDeFond(<?=json_encode($config_wri["mapKeys"])?>),
  polygoneId = <?=$vue->polygone->id_polygone??0?>,
  editJsonEl = document.getElementById('edit-json'), // Champ d'édition du geoJson
  exportPolygonEl = document.getElementById('export-polygon'); // Lien d'export dans la page

// Couche de massifs en fond pour servir de base au snapping
new WriPolygonLayer(
  1, // Seulement les massifs
  'https://<?=$_SERVER["SERVER_NAME"]?>',
  '<?=$vue->version_features?>', {
    bbox: true, // Pour ne pas ralentir le snapping
    pmIgnore: true, // Pour qu'ils ne soient pas modifiables
    snapIgnore: false, // Pour que les polygones en édition puisse coller aux contours de massifs
  }
).addTo(map);

// Contrôles
controlesComuns(map).forEach((control) => control.addTo(map));
L.control.layers(tileLayers, ).addTo(map);
map.doubleClickZoom.disable();
new ControlPolygonsUpload({
  title: 'Importer un fichier',
}).addTo(map);
positionMemoryControl(map);

// Chargement du fond de carte actif
(tileLayers[decodeURI(positionMemoryArray[3])] ||
  Object.values(tileLayers)[0] // La première par défaut
).addTo(map);

// Affiche le polygone courant
if (editJsonEl.value) {
  const polygonesAEditer = L.geoJson(JSON.parse(editJsonEl.value)); //.addTo(map);

  // Wait an instant the end of geoman init to add it
  setInterval(() => polygonesAEditer.addTo(map), 50);

  map.fitBounds(polygonesAEditer.getBounds());
} else {
  // Ou positionne la carte par défaut sur la dernière position utilisée
  map.setView([positionMemoryArray[1], positionMemoryArray[2]], positionMemoryArray[0]);
}


// Editeur
map.pm.addControls({
  oneBlock: true,
  cutPolygon: false, // Commenter pour activer le bouton ciseaux
  drawCircle: false,
  drawCircleMarker: false,
  drawMarker: false,
  dragMode: false,
  drawPolyline: false,
  drawRectangle: false,
  drawText: false,
  rotateMode: false,
});
map.pm.enableGlobalEditMode();
map.pm.setGlobalOptions({
  snappable: true,
  allowSelfIntersection: false,
});


// Restitue le geoJson édité
function layerChanged() {
  // On crée un multipolygone unique qui va englober tous les polygones du massif
  const finalGeoJson = {
    type: 'MultiPolygon',
    coordinates: [],
  };

  // On recherche les polygones éditables
  L.PM.Utils.findLayers(map).forEach((layer) => {
    const layerGeometry = layer.toGeoJSON().geometry;

    switch (layerGeometry.type) {
      case 'Polygon':
        // On ajoute le polygone
        finalGeoJson.coordinates.push(layerGeometry.coordinates);
        break;
      case 'MultiPolygon':
        // On ajoute séparément les polygones inclus
        finalGeoJson.coordinates.push(...layerGeometry.coordinates);
        break;
    }
  });

  // Ecriture du résultat dans la zone d'édition de la page
  editJsonEl.value = JSON.stringify(finalGeoJson);
}

map.on('layeradd', (evt) => {
  layerChanged(); // A la création du polynome
  evt.layer.on('pm:edit', layerChanged); // A l'édition du polygone
});
map.on('pm:remove', layerChanged); // A la suppression du polygone


// Changement de format d'export
function formatChange() { // Réponse au changement d'état de l'input select
  exportPolygonEl.firstElementChild.href = '/api/polygones' +
    '?massif=' + polygoneId +
    '&format=' + exportPolygonEl.lastElementChild.value;
}

if (exportPolygonEl)
  formatChange(); // Init de la page