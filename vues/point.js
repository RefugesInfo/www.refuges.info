<?// Script lié à la page point

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config les données communes à tout WRI

// 19/10/11 Sly : Invention des "templates" js
// 23/10/11 Dominique : Retour ici du code spécifique à la page qui avait été mis dans la bibliothèque
// 15/04/11 Dominique : Passage en OL2.11
// 26/06/12  Dominique : Introduction des traductions de coordonnées
?>
var map; // L'objet de gestion de la carte

window.onload = function () {
    // Crée la carte
    map = new OpenLayers.Map ('vignette', {
        displayProjection: 'EPSG:4326', // Pour le permalink et les cookies en degminsec,
        controls: [
            new OpenLayers.Control.PanZoom (),
            new OpenLayers.Control.PermalinkCookies (null, null, {
                force: {
                    lon: <?=$vue->longitude?>,
                    lat: <?=$vue->latitude?>,
                    scale: <?=$vue->vignette[3]?>,
                }
            }),
            new OpenLayers.Control.LayerSwitcherConditional (),
            new OpenLayers.Control.ScaleLine ({geodesic: true}), // L'échelle n'est pas la bonne pour les projections de type mercator. En effet, dans cette projection, le rapport nombre pixel/distance réél augmente quand on se rapproche des pôles.Pour corriger ça, un simple geodesic:yes fais l'affaire (SLY 29/11/2010)
            new OpenLayers.Control.Navigation (),
            new OpenLayers.Control.FullScreenPanel(),
            new OpenLayers.Control.Attribution ()
        ],
        layers: [
            new OpenLayers.Layer.MRI            ('maps.refuges.info'),
            new OpenLayers.Layer.Velo           ('OpenCycleMap'),
            new OpenLayers.Layer.OSM            ('OSM'),
            new OpenLayers.Layer.IGN            ('IGN', '<?=$config["ign_key"]?>'),
            new OpenLayers.Layer.SwissTopo      ('SwissTopo'),
            new OpenLayers.Layer.IGM            ('Italie'),
            new OpenLayers.Layer.IDEE           ('Espagne')
        ]
    });
    // Les overlays (une fois que la carte est initialisée
    map.addLayers ([
        new OpenLayers.Layer.ImgPosition    ('Cadre', {
            img: OpenLayers._getScriptLocation() + 'img/cadre.png', h: 43, l: 31, 
            pos: map.getCenter (), 
            displayInLayerSwitcher: false
        }),
        new OpenLayers.Layer.GMLSLD         ('WRI', {    
            urlGML: '/exportations/exportations.php?format=gml&icones=50',
            projection: 'EPSG:4326',
            urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
            styleName: 'Points',
            visibility: true, 
            displayInLayerSwitcher: false
        })
    ]);
}

// Actions de la page
function agrandir_vignette () {
    // On masque le contrôle puisqu'il a déjà été activé
    var agrandir_vignette = document.getElementById('agrandir_vignette');
    if (agrandir_vignette)
        agrandir_vignette.style.display = 'none';
        
    // On positionne la couche de second choix
    var layers_alternate = map.getLayersByName ('<?=$vue->vignette[2]?>');
    if (layers_alternate.length)
        map.setBaseLayer (layers_alternate [0]);
    
    // On redimentionne
    map.div.style.width  =
    map.div.style.height = '400px';
    map.updateSize(); // Because mozilla wont let us catch the "onresize" for an element
    
    var agrandir = document.getElementById('agrandir');
    if (agrandir)
        agrandir.style.display = 'none';
}
