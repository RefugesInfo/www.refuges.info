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
function copyExportLink() {
  navigator.clipboard.writeText(exportCarteEl.children[1].href)
    .then(() => alert('Lien d\'exportation copié dans le presse-papier :\n\n' +
      exportCarteEl.children[1].href));
}

function setExportLink() {
  const bne = map.getBounds()._northEast,
    bsw = map.getBounds()._southWest,
    fc = (coord) => Math.floor(coord * 10000) / 10000,
    cc = (coord) => Math.ceil(coord * 10000) / 10000;

  exportCarteEl.children[1].href = '/api/bbox' +
    '?type_points=' + localStorage.checkedLayersTypes +
    '&nb_points=all' +
    '&bbox=' + fc(bsw.lng) + ',' + fc(bsw.lat) + ',' + cc(bne.lng) + ',' + cc(bne.lat) +
    '&format=' + exportCarteEl.firstElementChild.value;

  // Affiche seulement quand il y a quelque chose à exporter
  exportCarteEl.style.display = localStorage.checkedLayersTypes ? 'block' : 'none';
}

map.on('overlayadd', () => setExportLink()); // Also for init
map.on('overlayremove', () => setExportLink());
map.on('moveend', () => setExportLink()); // For zoom & shifts