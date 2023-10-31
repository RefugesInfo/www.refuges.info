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
    center: ol.proj.transform(centre, 'EPSG:4326', 'EPSG:3857'),
    zoom: 13,
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
    }),
    // Le viseur jaune pour modifier la position du point
    new myol.layer.Marker({
      src: viseur,
      prefix: 'marker', // S'interface avec les <TAG id="marker-xxx"...>
      dragable: true,
      focus: 15,
    }),
    new myol.layer.Hover(), // Gère le survol du curseur
  ],
});