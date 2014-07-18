<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//FR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
    <head>
        <title>Test de la librairie modifiée Openlayers</title>
        <link rel="shortcut icon" href="openlayers.ico" />
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />

        <script src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
        <script type="text/javascript" src="../lib/OpenLayers.js?<?=filemtime('../lib/OpenLayers.js')?>"></script>
        <script type="text/javascript">

            var map, mri, massifs, cadre, viseur, editeur, displayPosition;
            window.onload = function () {
                // Crée la carte
                map = new OpenLayers.Map.Standard ('map', {
                    defaut: { // La position par défaut s'il n'y a pas de cookie ou de permalink
                        lon: 5.7,
                        lat: 45.2,
                        scale: 500000
                    },
                    WWpermalink: { // Les paramètres forcés dans tous les cas sauf quand on a des arguments de permalink dans l'url
                        baseLayer: 'OSM',
                        scale: 500000
                    }
                },{
                    IGN: 'rjvdd0zkal6czbu4mop37x7r',
                    Bing: 'AqTGBsziZHIJYYxgivLBf0hVdrAk9mWO5cQcb8Yux8sW5M8c8opEC2lZqKR1ZZXf',
                    OS: 'CBE047F823B5E83CE0405F0ACA6042AB',
                    OB: true,
                    Google: true
                },[
                    mri = new OpenLayers.Layer.GMLSLD ('MRI', { // Une couche au format GML et sa feuille de style SDL avec des actions de survol et de click
                        urlGML: OpenLayers._getScriptLocation() + 'proxy.php?url=http://www.refuges.info/exportations/exportations.php?format=gml',
                        projection: 'EPSG:4326',
                        urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
                        styleName: 'Points'
                    }),
                    massifs = new OpenLayers.Layer.GMLSLD ('Massifs', {    
                        urlGML: OpenLayers._getScriptLocation() + 'proxy.php?url=http://www.refuges.info/exportations/massifs-gml.php',
                        projection: 'EPSG:4326', // Le GML est fourni en degminsec
                        urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
                        styleName: 'Massifs'
                    })
                ]);
                
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
                        snap: [mri],
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
        <div id="map" style="height:600px;width:800px;float:right"></div>
        <p>
            <span id="titre-lon">Longitude</span>: <em id="long">xxxx</em>
            <span id="titre-lat">Latitude</span>: <em id="lati">yyyy</em>,
            <select id="select-proj">
                <option>Degrés décimaux</option>
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
                    <option>Degrés décimaux</option><?/* Initialise le champ au chargement de la page. Sera écrasé par innerHTML */?>
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
                <a onclick="add_edit()" style="cursor:pointer">Ajouter l'éditeur de trace</a>
            </p>
        <hr/>
        <p>
            <a href="../build" target="_blank">BUILD</a>
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