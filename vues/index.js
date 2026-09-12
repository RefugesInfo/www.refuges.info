// Carte leaflet

const permalinkInit = (localStorage.permalink || '5/46.5/5').split('/');
// Défaut : zoom/latitude/longitude

permalinkInit[0] = Math.min(parseInt(permalinkInit[0]), 10);
localStorage.permalink = permalinkInit.join('/');

const map = initLeafletMap(
  'carte-accueil',
  'https://<?=$_SERVER["SERVER_NAME"]?>',
  <?=$vue->version_features?>,
  <?=json_encode($config_wri['mapKeys'])?>
);

// Externalise le sélecteur de points pour les grandes largeurs de fenêtre
const conteneurSelecteurExterneEl = document.getElementById('conteneur-selecteur-points'),
  conteneurDeuxièmeSelecteurEl = document.querySelector(':has(>.leaflet-control-layers)').lastChild.lastChild,
  selecteursPointsEl = document.querySelector('.leaflet-control-layers-overlays:has(img)'),
  exportCarteEl = document.getElementById('export-carte'); // Lien d'export de la carte

['load', 'resize'].forEach(evtName =>
  window.addEventListener(evtName, () => {
    if (window.innerWidth < 800)
      conteneurDeuxièmeSelecteurEl.appendChild(selecteursPointsEl);
    else
      conteneurSelecteurExterneEl.insertBefore(selecteursPointsEl, conteneurSelecteurExterneEl.firstElementChild);
  }));

// Calcul du lien d'export
function setExportLink() {
  const bne = map.getBounds()._northEast,
    bsw = map.getBounds()._southWest,
    fc = (coord) => Math.floor(coord * 10000) / 10000,
    cc = (coord) => Math.ceil(coord * 10000) / 10000;

  exportCarteEl.lastElementChild.href = '/api/bbox' +
    '?type_points=' + localStorage.checkedLayers
    .split(',') // Sépare les noms de couches
    .map((layerName) => // Exécute pour chaque couche mémorisée
      (clusteredVectorlayers[layerName] ?? [])[0] // Retourne le n° de type de chaque couche
    )
    .filter(Boolean) // Filtre les couches n'ayant pas de n° de type
    .join(',') + // Reconstitue la chaine argument de type_points=
    '&nb_points=all' +
    '&bbox=' + fc(bsw.lng) + ',' + fc(bsw.lat) + ',' + cc(bne.lng) + ',' + cc(bne.lat) +
    '&format=' + exportCarteEl.firstElementChild.value;
}

map.on('overlayadd', () => setExportLink()); // Also for init
map.on('overlayremove', () => setExportLink());
map.on('moveend', () => setExportLink()); // For zoom & shifts