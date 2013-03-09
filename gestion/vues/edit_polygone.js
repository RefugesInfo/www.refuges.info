var vectors;

window.onload = function () {
	var map =new OpenLayers.Map ('map', {
		numZoomLevels: 20,
		displayProjection: new OpenLayers.Projection ('EPSG:4326'), // Pour le permalink et les cookies en degminsec
		controls: [
			new OpenLayers.Control.PanZoomBar (), // Grande barre de zoom
//			new OpenLayers.Control.PermalinkCookies (), // Ne doit pas être en premier
			new OpenLayers.Control.LayerSwitcherConditional (),
			new OpenLayers.Control.ScaleLine ({geodesic: true}), // L'échelle n'est pas la bonne pour les projections de type mercator. En effet, dans cette projection, le rapport nombre pixel/distance réél augmente quand on se rapproche des pôles.Pour corriger ça, un simple geodesic:yes fais l'affaire (SLY 29/11/2010)
			new OpenLayers.Control.MousePosition ({
				numDigits:5, prefix: 'lon=', separator:' lat='
			}),
			new OpenLayers.Control.Navigation (),
			new OpenLayers.Control.Attribution ()
		],
		layers: [
			new OpenLayers.Layer.Google.Terrain      ('Google'),
			new OpenLayers.Layer.Google              ('Google map',          {visibility: false}),
			new OpenLayers.Layer.Google.Photo        ('Google photo',        {visibility: false}),
	//		new OpenLayers.Layer.Google.Hybrid       ('Google hybrid',       {visibility: false}),
			new OpenLayers.Layer.IGN                 ('IGN',                 '<?=$config['ign_key'];?>'),
	//		new OpenLayers.Layer.IGN.EtatMajor       ('IGN état major 1889', '<?=$config['ign_key'];?>'),
	//		new OpenLayers.Layer.IGN.Cassini         ('Cassini 1789',        '<?=$config['ign_key'];?>'),
			new OpenLayers.Layer.IGN.Photo           ('IGN photo',           '<?=$config['ign_key'];?>'),
			new OpenLayers.Layer.SwissTopo           ('SwissTopo',           {maxViewport: new OpenLayers.Size (600, 500)}),
	//		new OpenLayers.Layer.SwissTopo.Siegfried ('Suisse Siegfried 1949'),
	//		new OpenLayers.Layer.SwissTopo.Dufour    ('Suisse Dufour 1864'),
	//		new OpenLayers.Layer.SwissTopo.Photo     ('SwissTopo photo'),
			new OpenLayers.Layer.IGM                 ('Italie'),
			new OpenLayers.Layer.IDEE                ('Espagne'),
			new OpenLayers.Layer.OB                  ('Germanie'),
			new OpenLayers.Layer.OSM                 ('OSM'),
			new OpenLayers.Layer.WRI                 ('Maps.Refuges.info'),
			new OpenLayers.Layer.Velo                ('OpenCycleMap'),
			new OpenLayers.Layer.GMLSLD ('Massifs', {	
				urlGML: '/exportations/massifs-gml.php',
				projection: 'EPSG:4326', // Le GML est fourni en degminsec
				urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
				styleName: 'Massif'
			}),
			new OpenLayers.Layer.GMLSLD ('Départements', {	
				urlGML: '/exportations/massifs-gml.php?polygone_type=10',
				projection: 'EPSG:4326', // Le GML est fourni en degminsec
				urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
				styleName: 'Massif',
				visibility: false
			}),
			new OpenLayers.Layer.GMLSLD ('Zone réglementée', {	
				urlGML: '/exportations/massifs-gml.php?polygone_type=12',
				projection: 'EPSG:4326', // Le GML est fourni en degminsec
				urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
				styleName: 'Massif',
				visibility: false
			}),
			new OpenLayers.Layer.GMLSLD ('Massifs niveau 1', {	
				urlGML: '/exportations/massifs-gml.php?polygone_type=11',
				projection: 'EPSG:4326', // Le GML est fourni en degminsec
				urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
				styleName: 'Massif',
				visibility: false
			}),
			vectors = new OpenLayers.Layer.Editor (
				'Editor', 
				'/gestion/exportations/polygone-gpx.php?id_polygone=<?=$modele->id_polygone?>&pad',
				{
//					displayInLayerSwitcher: false, 
					format: new OpenLayers.Format.GPX ()
				}
			)
		]
	});
	if (!map.getCenter()) // Valeur par défaut si pas de polygone chargé
		map.setCenter(
			new OpenLayers.LonLat (3, 47) .transform (map.displayProjection, map.getProjectionObject()),
			4 // On centre la France
		);
}
