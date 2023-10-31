var host = '<?=$config_wri["sous_dossier_installation"]?>',// Appeler la couche de CE serveur
  initPermalink = <?=$vue->polygone->id_polygone?'false':'true'?>;
  mapKeys = <?=json_encode($config_wri['mapKeys'])?>;

const editorlayer = new myol.layer.Editor({
    geoJsonId: 'edit-json',
    editOnly: 'poly',

    featuresToSave: function(coordinates) {
      return this.format.writeGeometry(
        new ol.geom.MultiPolygon(coordinates.polys), {
          featureProjection: 'EPSG:3857',
          decimals: 5,
        });
    },
  }),

  map = new ol.Map({
    target: 'carte-edit',
    view: new ol.View({
      enableRotation: false,
      constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
    }),
    controls: [
      // Haut gauche
      new ol.control.Zoom(),
      new ol.control.FullScreen(),
      new myol.control.MyGeocoder(),
      new myol.control.MyGeolocation,
      new myol.control.Load(),
      new myol.control.Download({
        savedLayer: editorlayer,
      }),

      // Bas gauche
      new myol.control.MyMousePosition(),
      new ol.control.ScaleLine(),

      // Bas droit
      new ol.control.Attribution({ // Attribution doit être défini avant LayerSwitcher
        collapsed: false,
      }),

      // Haut droit
      new myol.control.LayerSwitcher({
        layers: fondsCarte('edit', mapKeys),
      }),
    ],
    layers: [
      coucheContourMassif({
        host: host,
      }),
      editorlayer,
    ],
  });

// Centrer sur la zone du polygone
<?if ($vue->polygone->id_polygone) { ?>
  map.getView().fit(ol.proj.transformExtent([
    <?=$vue->polygone->ouest?>,
    <?=$vue->polygone->sud?>,
    <?=$vue->polygone->est?>,
    <?=$vue->polygone->nord?>,
  ], 'EPSG:4326', 'EPSG:3857'));
<? } ?>
