// Utilitaire de saisie
function affiche_et_set(el, affiche, valeur) {
  document.getElementById(el).style.visibility = affiche;
  document.getElementById(el).value = valeur;
  return false;
}

var host = '<?=$config_wri["sous_dossier_installation"]?>', // Appeler la couche de CE serveur
  mapKeys = <?=json_encode($config_wri['mapKeys'])?>,
  layerOptions = <?=json_encode($config_wri['layerOptions'])?>,
  centre = [<?=$vue->point->longitude?>, <?=$vue->point->latitude?>],
  viseur = '<?=$config_wri["sous_dossier_installation"]?>images/viseur.svg';

// Gestion des cartes
var curseur = new myol.layer.Marker({
  src: viseur,
  prefix: 'marker', // S'interface avec les <TAG id="marker-xxx"...>
  // Prend la position qui est dans <input id="cadre-json">
  dragable: true,
  focus: 15, // Centre la carte sur le curseur
});

new ol.Map({
  target: 'carte-modif',
  view: new ol.View({
    enableRotation: false,
    constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
  }),
  controls: [
    // Haut gauche
    new ol.control.Zoom(),
    new ol.control.FullScreen(),
    new myol.control.MyGeocoder(),
    new myol.control.MyGeolocation(),

    // Bas gauche
    new myol.control.MyMousePosition(),
    new ol.control.ScaleLine(),

    // Bas droit
    new ol.control.Attribution({ // Attribution doit être défini avant LayerSwitcher
      collapsed: false,
    }),

    // Haut droit
    new myol.control.LayerSwitcher({
      layers: fondsCarte('modif', mapKeys),
    }),
  ],
  layers: [
    // Les autres points refuges.info
    couchePointsWRI({
      host: host, // Appeler la couche de CE serveur
      browserClusterMinResolution: null, // Pour ne pas générer de gigue
    }, 'modif'),

    // Le viseur jaune pour modifier la position du point
    curseur,

    // Gère le survol du curseur
    new myol.layer.Hover(),
  ],
});