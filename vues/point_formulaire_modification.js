<?// Script lié à la page de modification de fiche

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config les données communes à tout WRI

// 29/10/11 Dominique : Création
// 27/04/11 Dominique : Passage en OL2.11
?>
var map, viseur; // L'objet de gestion de la carte
window.onload = function () {
    // Crée la carte
    map = new OpenLayers.Map ('carte-edit', {
        displayProjection: new OpenLayers.Projection ('EPSG:4326'), // Pour le permalink et les cookies en degminsec
        numZoomLevels: 20,
        controls: [
            new OpenLayers.Control.PanZoom (),
            new OpenLayers.Control.PermalinkCookies (null, null, {
                cookie: {
                    lat: <?=$point->latitude?>, 
                    lon: <?=$point->longitude?>, 
                    scale: <?=$vue->serie[3]?>,
                    baseLayer: '<?=$vue->serie[2]?>' 
                }
            }),
            new OpenLayers.Control.LayerSwitcherConditional (),
            new OpenLayers.Control.MousePosition (),
            new OpenLayers.Control.ScaleLine ({geodesic: true}), // L'échelle n'est pas la bonne pour les projections de type mercator. En effet, dans cette projection, le rapport nombre pixel/distance réél augmente quand on se rapproche des pôles.Pour corriger ça, un simple geodesic:yes fais l'affaire (SLY 29/11/2010)
            new OpenLayers.Control.Navigation (),
            new OpenLayers.Control.Attribution ()
        ]
    });

    map.addLayers ([
        new OpenLayers.Layer.Bing                ({name: 'Bing photo', type: 'Aerial', key: '<?=$config['bing_key'];?>'}),
        new OpenLayers.Layer.MRI                 ('Maps.Refuges.info'),
        new OpenLayers.Layer.Velo                ('OpenCycleMap'),
        new OpenLayers.Layer.OSM                 ('OSM')
    ]);

    map.addLayers ([
        new OpenLayers.Layer.GMLSLD ('WRI', {    
            urlGML: '/exportations/exportations.php?format=gml',
            projection: 'EPSG:4326',
            urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
            styleName: 'Points',
            displayInLayerSwitcher: false, 
            visibility: true
        }),
        viseur = new OpenLayers.Layer.ImgDrag ('Viseur', {
            img: OpenLayers._getScriptLocation() + 'img/viseur.png', h: 30, l: 30, 
            pos: map.getCenter (), 
            prefixeId: {
                titre: 'titre-',
                decimal: '', // Ces champs seront masqués et remonterons la position du point à créer
                projected: 'proj-', // ces champs seront visibles et donneront la valeur projetée
            },
            displayInLayerSwitcher: false
        })
    ]);
}


function validation() {
    // variable choix est a "supprimer" "ajouter"...
    // elle est mise en place par les boutons
    switch ( choix )
    {
        case 'supprimer':
            return confirm("Etes vous sur de SUPPRIMER la fiche ?");
        case 'Ajouter':
        case 'Modifier':
            // valide les champs
            return true;
        default:
            return true;
    }
}

function affiche_et_set( el , affiche, valeur ) {
  document.getElementById(el).style.visibility = affiche ;
  document.getElementById(el).value = valeur ;
  
  return false;
}
