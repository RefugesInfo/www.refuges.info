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
  selecteursPointsEl = document.querySelector('.leaflet-control-layers-overlays:has(img)');

['load', 'resize'].forEach(evtName =>
  window.addEventListener(evtName, () => {
    if (window.innerWidth < 800)
      conteneurDeuxièmeSelecteurEl.appendChild(selecteursPointsEl);
    else
      conteneurSelecteurExterneEl.insertBefore(selecteursPointsEl, conteneurSelecteurExterneEl.firstChild);
  }));
