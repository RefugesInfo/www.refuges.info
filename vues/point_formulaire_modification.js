var host = '<?=$config_wri["sous_dossier_installation"]?>',
  mapKeys = <?=json_encode($config_wri['mapKeys'])?>,
  layerOptions = <?=json_encode($config_wri['layerOptions'])?>,
  idPoint = <?=intval($vue->point->id_point)?>;

// Utilitaire de saisie
function affiche_et_set(el, affiche, valeur) {
  document.getElementById(el).style.visibility = affiche;
  document.getElementById(el).value = valeur;
  return false;
}

// Gestion des cartes
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
    new myol.control.Permalink({
      init: !idPoint, // Garde la position courante en création de point
    }),

    // Haut droit
    new myol.control.LayerSwitcher({
      layers: fondsCarte('modif', mapKeys),
    }),
  ],

  layers: [
    // Les autres points refuges.info
    couchePointsWRI({
        host: host,
        browserClusterMinResolution: null, // Pour ne pas générer de gigue
        noClick: true,
      },
      'modif',
      layerOptions
    ),

    // Le viseur jaune pour modifier la position du point
    new myol.layer.Marker({
      src: host + 'images/viseur.svg',
      prefix: 'marker', // S'interface avec les <TAG id="marker-xxx"...>
      // Prend la position qui est dans <input id="cadre-json">
      dragable: true,
      focus: 15, // Centre la carte sur le curseur
    }),

    // Gère le survol du curseur
    new myol.layer.Hover(),
  ],
});