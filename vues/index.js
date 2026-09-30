/* global couchesDeFond, couchesIconesWRI, WriPOILayer, WriPolygonLayer, couchesOverpass, coucheItineraires */
/* global controlesComuns, positionMemoryControl, positionMemoryArray */

const map = L.map('carte-accueil'),
  tileLayers = couchesDeFond('<?=json_encode($config_wri["mapKeys"])?>'),
  overlays = {},
  vectorCluster = L.markerClusterGroup({
    spiderfyOnMaxZoom: true, // Overlapping markers will spiderfy when clicked
    showCoverageOnHover: false, // Optional: hides the cluster bounds polygon
    maxClusterRadius: 30, // Less clusters
  });
  //TODO séparer sélecteur / clusters et faire 2 fonctions générales

// Couches refuges.info de la page 
if (typeof sessionStorage.checkedLayers !== 'string')
  sessionStorage.checkedLayers = 'Cabane non gardée,Refuge gardé,Gîte d\'étape';

// Chargement du fond de carte actif
(tileLayers[decodeURI(positionMemoryArray[3])] || Object.values(tileLayers)[0]).addTo(map);

// points WRI
for (const [nom, args] of Object.entries(couchesIconesWRI)) {
  const icone = '<img src="/images/icones/' + args[1] + '.svg"/> ' + nom, // Libellé de la ligne sélecteur
    layer = new WriPOILayer('https://<?=$_SERVER["SERVER_NAME"]?>', args[0], '<?=$vue->version_features?>'); // Couche affichable

  // Il est nécéssaire de grouper les points de chaque couche pour pouvoir les sélectionner indépendament
  overlays[icone] = L.featureGroup.subGroup(vectorCluster).addLayer(layer);

  // Affiche la couche au lancement de la page au cas où sa sélection serait mémorisée
  if (sessionStorage.checkedLayers.search(nom) !== -1) {
    // On affiche la couche sur la carte pour que le L.control.layers la considère comme cochée
    overlays[icone].addTo(map);

    // Quand les données sont chargées, on rafraîchit l'affichage du cluster
    layer.on('load', (evt) => {
      vectorCluster.removeLayer(evt.target);
      vectorCluster.addLayer(evt.target);
      addRemoveOverlay(); // Mémorise les couches et recalcule le lien export
    });
  }
}

// Polygones WRI
overlays['Régions'] = new WriPolygonLayer('https://<?=$_SERVER["SERVER_NAME"]?>', 11, '<?=$vue->version_features?>', true);
overlays['Massifs'] = new WriPolygonLayer('https://<?=$_SERVER["SERVER_NAME"]?>', 1, '<?=$vue->version_features?>', true);

// Couche externe d'itinéraires
overlays['Itinéraires'] = coucheItineraires;

// Restitution de ces 3 couches si elles sont mémorisése
for (const [nom, layer] of Object.entries(overlays))
  if (sessionStorage.checkedLayers.search(nom) !== -1) 
    layer.addTo(map);

// Couches OSM OverPass
for (const [nom, query] of Object.entries(couchesOverpass))
  overlays['OSM ' + nom] = new L.OverPassLayer({
    query: '(nwr' + query + '({{bbox}}););out center;',
    markerIcon: L.icon({
      iconUrl: 'https://<?=$_SERVER["SERVER_NAME"]?>/images/icones/' + nom.replace('ô', 'o').replace(/[^a-z]/gu, '') + '.svg',
      iconSize: [24, 24],
      iconAnchor: [12, 12],
    }),
    minZoom: 12,
    minZoomIndicatorEnabled: false,
  });

vectorCluster.addTo(map);

// Controles
L.control.layers(tileLayers).addTo(map);
L.control.layers(null, overlays).addTo(map);
controlesComuns(map).forEach((control) => control.addTo(map));
positionMemoryControl(map);

// Externalise le sélecteur de points pour les grandes largeurs de fenêtre
['load', 'resize'].forEach(evtName =>
  window.addEventListener(evtName, () => {
    const conteneurSelecteurExterneEl = document.getElementById('conteneur-selecteur-points'),
      conteneurDeuxiemeSelecteurEl = document.querySelector(':has(>.leaflet-control-layers)').lastChild.lastChild,
      selecteursPointsEl = document.querySelector('.leaflet-control-layers-overlays:has(img)');

    if (window.innerWidth < 800)
      conteneurDeuxiemeSelecteurEl.appendChild(selecteursPointsEl);
    else
      conteneurSelecteurExterneEl.insertBefore(selecteursPointsEl, conteneurSelecteurExterneEl.firstElementChild);
  }));

// Lance le chargement de la carte
map.setView([positionMemoryArray[1], positionMemoryArray[2]], positionMemoryArray[0]);

// Calcul du lien d'export
const overlaySelectors = document.querySelectorAll('.leaflet-control-layers-overlays input'), // Lien d'export de la carte
  exportCarteEl = document.getElementById('export-carte');

/* eslint-disable-next-line no-unused-vars */
function copyExportLink() {
  navigator.clipboard.writeText(exportCarteEl.children[1].href)
    .then(() => alert('Lien d\'exportation copié dans le presse-papier :\n\n' +
      exportCarteEl.children[1].href));
}

// Mémorisation des couches de points et l'export
function addRemoveOverlay() {
  const bne = map.getBounds()._northEast,
    bsw = map.getBounds()._southWest,
    fc = (coord) => Math.floor(coord * 10000) / 10000,
    cc = (coord) => Math.ceil(coord * 10000) / 10000,
    checkedLayersNames = [],
    checkedLayersTypes = [];

  // Calcul des couches sélectionnées
  for (const lsInputEl of overlaySelectors) {
    const nom = lsInputEl.parentElement.lastChild.innerText.trim();

    if (lsInputEl.checked) {
      checkedLayersNames.push(nom);

      if (typeof couchesIconesWRI[nom] === 'object')
        checkedLayersTypes.push(couchesIconesWRI[nom][0]);
    }
  }

  // Mémorise dans la mémoire de l'explorateur
  sessionStorage.checkedLayers = checkedLayersNames.join(',');

  exportCarteEl.children[1].href = '/api/bbox' +
    '?type_points=' + checkedLayersTypes.join(',') +
    '&nb_points=all' +
    '&bbox=' + fc(bsw.lng) + ',' + fc(bsw.lat) + ',' + cc(bne.lng) + ',' + cc(bne.lat) +
    '&format=' + exportCarteEl.firstElementChild.value;

  // Affiche seulement quand il y a quelque chose à exporter
  exportCarteEl.style.display = checkedLayersTypes.length ? 'block' : 'none';
}

map.on('overlayadd', () => addRemoveOverlay()); // Also for init
map.on('overlayremove', () => addRemoveOverlay());
map.on('moveend', () => addRemoveOverlay()); // For zoom & shifts