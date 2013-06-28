<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//FR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
    <head>
        <title>Test de la librairie modifiée Openlayers</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />

        <script src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
        <script type="text/javascript" src="../lib/OpenLayers.js"></script>
        <script type="text/javascript">

            var map, cadre, viseur, editeur, displayPosition;
            window.onload = function () {
                // Crée la carte
                map = new OpenLayers.Map ('map', {
                    displayProjection: 'EPSG:4326', // Affichage en °
                    controls: [
                        new OpenLayers.Control.Navigation(),
                        new OpenLayers.Control.PanZoomBar (),
                        new OpenLayers.Control.ScaleLine ({geodesic: true}), // L'échelle n'est pas la bonne pour les projections de type mercator. En effet, dans cette projection, le rapport nombre pixel/distance réél augmente quand on se rapproche des pôles.Pour corriger ça, un simple geodesic:yes fais l'affaire (SLY 29/11/2010)
                        new OpenLayers.Control.LayerSwitcherConditional (),
                        new OpenLayers.Control.MousePosition (),
                        new OpenLayers.Control.GPSPanel(),
                        new OpenLayers.Control.FullScreenPanel(),
                        new OpenLayers.Control.PermalinkCookies ({ // Un lien permalink conservé dans un cookie qui reporte les paramètres d'une page à l'autre
                            defaut: { // La position par défaut s'il n'y a pas de cookie ou de permalink
                                lon: 5.7,
                                lat: 45.2,
                                scale: 500000
                            },
                            WWpermalink: { // Les paramètres forcés dans tous les cas sauf quand on a des arguments de permalink dans l'url
                                baseLayer: 'OSM',
                                scale: 500000
                            }
                        }),
                        new OpenLayers.Control.Attribution ()
                    ],
                    layers: [
//                        new OpenLayers.Layer.MRI                 ('Maps.Refuges.Info'),
                        new OpenLayers.Layer.OCM                 ('OpenCycleMap'),
                        new OpenLayers.Layer.OCM.Transport       ('Transport'),
                        new OpenLayers.Layer.OCM.Landscape       ('Landscape'),
                        new OpenLayers.Layer.OCM.Outdoors        ('Outdoors'),
                        new OpenLayers.Layer.OSM                 ('OSM'),
    
                        new OpenLayers.Layer.IGN                 ('IGN',          'rjvdd0zkal6czbu4mop37x7r'),
                        new OpenLayers.Layer.IGN.Photo           ('IGN photo',    'rjvdd0zkal6czbu4mop37x7r'),
                        new OpenLayers.Layer.IGN.Cadastre        ('IGN Cadastre', 'rjvdd0zkal6czbu4mop37x7r'),
                        
                        new OpenLayers.Layer.SwissTopo           ('SwissTopo'),
                        new OpenLayers.Layer.SwissTopo.Siegfried ('Swiss 1949'),
                        new OpenLayers.Layer.SwissTopo.Dufour    ('Swiss 1864'),
                        new OpenLayers.Layer.SwissTopo.Photo     ('Swiss photo'),
                        
                        // Automatiquement autorisé sur //localhost
                        // Demande pour autoriser le domaine à accéder aux données:
                        // http://swisstopo.admin.ch/internet/swisstopo/fr/home/products/services/web_services/webaccess.html => Accès au formulaire de commande
                        
                        new OpenLayers.Layer.IDEE                ('EspaÃ±a'), 
                        new OpenLayers.Layer.IGM                 ('Italia'),
                        
                        new OpenLayers.Layer.Bing                ({name: 'Bing',        type: 'Road',             key: 'AqTGBsziZHIJYYxgivLBf0hVdrAk9mWO5cQcb8Yux8sW5M8c8opEC2lZqKR1ZZXf'}),
                        new OpenLayers.Layer.Bing                ({name: 'Bing photo',  type: 'Aerial',           key: 'AqTGBsziZHIJYYxgivLBf0hVdrAk9mWO5cQcb8Yux8sW5M8c8opEC2lZqKR1ZZXf'}),
                        new OpenLayers.Layer.Bing                ({name: 'Bing hybrid', type: 'AerialWithLabels', key: 'AqTGBsziZHIJYYxgivLBf0hVdrAk9mWO5cQcb8Yux8sW5M8c8opEC2lZqKR1ZZXf'}),
                        
                        new OpenLayers.Layer.Google.Terrain      ('Google'),
                        new OpenLayers.Layer.Google              ('Google map',    {visibility: false}), // Cachées au début sinon, apparaissent fugitivement
                        new OpenLayers.Layer.Google.Photo        ('Google photo',  {visibility: false}),
                        new OpenLayers.Layer.Google.Hybrid       ('Google hybrid', {visibility: false}),
                        
                        new OpenLayers.Layer.OB( "OberBayern"),
                        new OpenLayers.Layer.XYZ( "ESRI",
//                    "http://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/${z}/${y}/${x}",   
       "http://at0.cdn.ecmaps.de/WmsGateway.ashx.jpg?Experience=oberbayern&MapStyle=KOMPASS&TileX=${x}&TileY=${y}&ZoomLevel=${z}",
                    {sphericalMercator: true} ),
                        
                    
                        // Demander une clé de production sur: http://pro.ign.fr/api-web => Service en ligne => S'ABONNER
                        // localhost    : rjvdd0zkal6czbu4mop37x7r
                        // refuges.info : ev2w14tv2ez4wpypux2ael39
                        // chemineur.fr : y07s87qyij0i6yhj8nzi66ww
                        // chemineur.fr : CBE047F823B5E83CE0405F0ACA6042AB
                        new OpenLayers.Layer.OS                  ('Great Britain', 'CBE047F823B5E83CE0405F0ACA6042AB') // UK Ordonance Survey Layer
                    ],
                    numZoomLevels: 22
                });
/*
                if (!map.getCenter()) // Valeur par défaut si pas de permalink ni cookie
                    map.setCenter (
                        new OpenLayers.LonLat (5,45) .transform (map.displayProjection, map.getProjectionObject()), // France
//                        new OpenLayers.LonLat (8.3,47.25) .transform (map.displayProjection, map.getProjectionObject()), // Suisse
//                        new OpenLayers.LonLat (-3,40) .transform (map.displayProjection, map.getProjectionObject()), // Espagne
                        8
                    );
*/
                // Les couches superposées
                map.addLayers ([
            cadre = new OpenLayers.Layer.ImgPosition ('TEST cadre', { // Une image fixée à une position sur la carte
                        img: OpenLayers._getScriptLocation() + 'img/cadre.png', h: 43, l: 31, 
                        pos: map.getCenter (),
                        idll: {
                            lon: 'long', // Ici, on spécifie des id différents pour afficher les lon & lat
                            lat: 'lati'
                        },
                        idSelect: 'select-proj',
                        displayInLayerSwitcher: false
                    }),
                    new OpenLayers.Layer.GMLSLD ('MRI', { // Une couche au format GML et sa feuille de style SDL avec des actions de survol et de click
                        urlGML: OpenLayers._getScriptLocation() + 'proxy.php?url=http://www.refuges.info/exportations/exportations.php?format=gml',
                        projection: 'EPSG:4326',
                        urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
                        styleName: 'Points'
                    }),
                    new OpenLayers.Layer.GMLSLD ('Massifs', {    
                        urlGML: OpenLayers._getScriptLocation() + 'proxy.php?url=http://www.refuges.info/exportations/massifs-gml.php',
                        projection: 'EPSG:4326', // Le GML est fourni en degminsec
                        urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
                        styleName: 'Massifs'
                    }),
            viseur = new OpenLayers.Layer.ImgDrag ('Viseur', { // Une image que l'on peut déplacer et qui met à jour des éléments lon lat de la page
                        img: OpenLayers._getScriptLocation() + 'img/viseur.png', h: 30, l: 30, 
                        pos: map.getCenter (), 
                        displayInLayerSwitcher: false
                    })
                ]);
                
                // Crée une deuxième carte
                new OpenLayers.Map ('map2', {
                    displayProjection: 'EPSG:4326', // Affichage en °
                    controls: [
                        new OpenLayers.Control.Navigation(),
                        new OpenLayers.Control.PanZoom (),
                        new OpenLayers.Control.LayerSwitcher (),
//                        new OpenLayers.Control.LayerSwitcher ({
//                            div: OpenLayers.Util.getElement('externSwitcher')
//                        }),
                        new OpenLayers.Control.FullScreenPanel(),
                        new OpenLayers.Control.Attribution (),
                        new OpenLayers.Control.ArgParserCookies ({
                            force: { // Initialise la position de la carte
                                lon: 2,
                                lat: 46,
                                baseLayer: 'Google',
                                scale: 20000000
                            }
                        })
                    ],
                    layers: [
                        new OpenLayers.Layer.Google.Terrain      ('Google'),
                        new OpenLayers.Layer.Google              ('Google map',    {visibility: false}), // Cachées au début sinon, apparaissent fugitivement
                        new OpenLayers.Layer.Google.Photo        ('Google photo',  {visibility: false}),
                        new OpenLayers.Layer.OSM                 ('OSM'),
                        new OpenLayers.Layer.MRI                 ('maps.refuges.info'),
                        new OpenLayers.Layer.IGN                 ('IGN', 'rjvdd0zkal6czbu4mop37x7r'),
//                        new OpenLayers.Layer.SwissTopo           ('SwissTopo'),
                        // Les couches superposées
                        new OpenLayers.Layer.GMLSLD ('MRI', {    
                            urlGML: OpenLayers._getScriptLocation() + 'proxy.php?url=http://www.refuges.info/exportations/exportations.php?format=gml',
                            projection: 'EPSG:4326',
                            urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
                            styleName: 'Points'
                        })
                    ]
                });
//add_edit ();
            }
            function add_edit () {
                editeur = new OpenLayers.Layer.Editor (
                    'Editeur', 
                    'serveur_gml.php?trace=123&', // Source GML permettant la lecture/ecriture
                    {
                        format: new OpenLayers.Format.GPX (),
                        WWcontrols: [
                        //    new OpenLayers.Control.SaveFeature (),
                            new OpenLayers.Control.DownloadFeature (),
                            new OpenLayers.Control.LoadFeature ()
                        ]
                    }
                );
                editeur.addControls ([
                    new OpenLayers.Control.VisuGPXViewFeature ()
                ]);
                map.addLayer (editeur);
            }
        </script>
    </head>
    <body style="margin:0;padding:0">
        <div id="map" style="height:600px;width:800px"></div>
        <p>
            <span id="titre-lon">Longitude</span>: <em id="long">xxxx</em>
            <span id="titre-lat">Latitude</span>: <em id="lati">yyyy</em>,
            <select id="select-proj">
                <option>DegrÃ©s dÃ©cimaux</option>
            </select>
        </p>
        <p style="margin:0 0 0 50px">
            <form method="post" action="/point_modification.php">
                <span id="coordonnees-value">
                    <span id="titre-lon">Longitude</span>:
                    <input type="text" id="lon" name="longitude" size="12" maxlength="12" />

                    <span id="titre-lat">Latitude</span>:
                    <input type="text" id="lat" name="latitude" size="12" maxlength="12" />
                </span>
                <select id="select-projection">
                    <option>DegrÃ©s dÃ©cimaux</option><?/* Initialise le champ au chargement de la page. Sera écrasé par innerHTML */?>
                </select>
            </form>
        </p>
        <p>
            <a onclick="viseur.centre()" style="cursor:pointer">Recentrer le viseur sur la carte</a>
        </p>
        <p>
            <a onclick="viseur.recentre()" style="cursor:pointer">Recentrer la carte sur le viseur</a>
        </p>
        <p>
            <a onclick="viseur.efface()" style="cursor:pointer">Efface la position</a>
        </p>
        <hr/>
            EDITEUR
            <p style="margin:0 0 0 50px">
                <a onclick="add_edit()" style="cursor:pointer">Ajouter l'Ã©diteur de trace</a>
            </p>
        <hr/>
        Test multicartes
        <div id="map2" style="height:300px;width:400px"></div>
        <div id="externSwitcher"></div>
        
        <h1>Test d'une page avec scrool</h1>
        <img class="photos" src="http://www.refuges.info/photos_points/16512.jpeg" alt="Photo" />
        <img class="photos" src="http://www.refuges.info/photos_points/16511.jpeg" alt="Photo" />
    </body>
</html>