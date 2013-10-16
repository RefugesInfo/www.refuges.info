<?// Code Javascript de la page des cartes

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config les données communes à tout WRI

// 17/10/11 Dominique : Création
// 26/10/11 Dominique : Retour ici du code spécifique à la page qui avait été mis dans la bibliothèque
// 20/11/11 Dominique : Quand on démasque le viseur, le replace au centre de la carte si celle-ci a bougé 
// 12/05/12 Dominique : Retour en templates simples
// 16/02/13 jmb : objectif fusion massif.php la dedans.
?>

var map, layerMassifs, layerPoints, pos21781, lc;
var arg_massifs = '?massif=<?=$vue->polygone->id_polygone?>';
var arg_points  = '<?php if(isset($vue->polygone->id_polygone)) echo "&liste_id_massif=".$vue->polygone->id_polygone; ?>';
var limite = 
    '<?=$_GET['limite']?>'
        ? '&limite=<?=$_GET['limite']?>'
        : (navigator.appName == 'Microsoft Internet Explorer'
            ? '&limite=80'
            : ''
        );

// Crée la carte dés que la page est chargée
window.onload = function () {
    map = new OpenLayers.Map ('carte_nav', {
        displayProjection: new OpenLayers.Projection ('EPSG:4326'), // Pour le permalink et les cookies en degminsec
        numZoomLevels: 22,
        controls: [
            new OpenLayers.Control.PanZoomBar (), // Grande barre de zoom
            new OpenLayers.Control.PermalinkCookies (null, null, { // Ne doit pas être en premier
                'defaut': {
                    baseLayer: '<?=$config['carte_base']?>'
                }
            }),
lc =        new OpenLayers.Control.LayerSwitcherConditional ({ // Un premier dans la carte pour les couches de base
                ascending: true
            }),
        <?if ($vue->type_affichage == ''){?>
            new OpenLayers.Control.LayerSwitcher ({ // Un deuxième, externe, pour les overlays
                div: OpenLayers.Util.getElement('switch_nav'),
                ascending: false
            }),
        <?}?>
            new OpenLayers.Control.ScaleLine ({geodesic: true}), // L'échelle n'est pas la bonne pour les projections de type mercator. En effet, dans cette projection, le rapport nombre pixel/distance réél augmente quand on se rapproche des pôles.Pour corriger ça, un simple geodesic:yes fais l'affaire (SLY 29/11/2010)
            new OpenLayers.Control.MousePosition ({
                numDigits:5, prefix: 'lon=', separator:' lat='
            }),
            new OpenLayers.Control.Navigation (),
            new OpenLayers.Control.GPSPanel(),
            new OpenLayers.Control.FullScreenPanel(),
            new OpenLayers.Control.Attribution ()
        ]
    });

    // Doit être mis avant l'ajout des couches pour être efficace quand la baseLayer est choisie par le permalink ou les cookies
    map.initialStyle = {width: map.div.style.width, height: map.div.style.height}; // Mémorise la taille initiale de la carte
    map.events.register("changebaselayer", map, function (e) {
        // Affichage de la position en coordonnées suisses si une carte suisse est affichée
        if (pos21781)
            pos21781.div.style.display =
                map.baseLayer.projection.toString() == 'EPSG:21781'
                ? 'block'
                : 'none';    

        // Limitation de la taille de la carte pour limiter la consommation de quotas sur certains fournisseurs
        if (e.layer.maxViewport) { // Si la nouvelle baselayer à une limitation de taille
            if (map.size.w > e.layer.maxViewport.w || map.size.h > e.layer.maxViewport.h) { // Et si une des dimensions est plus grande que souhaitée
                // On redimensionne la carte
                map.div.style.width  = e.layer.maxViewport.w + 'px';
                map.div.style.height = e.layer.maxViewport.h + 'px';
                map.updateSize(); // Because mozilla wont let us catch the onresize for an element
                
                // Ecrire un petit commentaire
                var comment = document.createElement ('p');
                comment.id = 'avertissement';
                comment.style.color = 'black';
                comment.style.backgroundColor = 'yellow';
                comment.style.fontWeight = 'bold';
                comment.style.paddingLeft = '15px';
                comment.style.marginLeft  =
                comment.style.marginRight = '20%';
                comment.appendChild (document.createTextNode ('La taille de la carte est r'+String.fromCharCode(233)+'duite'));
                map.div.appendChild(comment);
            }
        } else { // La nouvelle baselayer n'à pas de limitation de taille
            var comment = document.getElementById('avertissement');
            if (comment) {
                // On efface le commentaire
                map.div.removeChild(comment);

                // On remet la carte dans ses dimentions initiales
                map.div.style.width  = map.initialStyle.width;
                map.div.style.height = map.initialStyle.height;
                map.updateSize(); // Because mozilla wont let us catch the onresize for an element
            }
        }
    });

    map.addLayers ([
        new OpenLayers.Layer.MRI                 ('Maps.Refuges.info'),
        new OpenLayers.Layer.OCM.Outdoors        ('OpenCycleMap'),
        new OpenLayers.Layer.OSM                 ('OSM'),
        new OpenLayers.Layer.IGN                 ('IGN',       '<?=$config['ign_key'];?>'),
        new OpenLayers.Layer.IGN.Photo           ('IGN photo', '<?=$config['ign_key'];?>'),
        <?if ($config['SwissTopo']){?>
            new OpenLayers.Layer.SwissTopo           ('SwissTopo'),
            new OpenLayers.Layer.SwissTopo.Photo     ('SwissTopo image'),
        <?}?>
        new OpenLayers.Layer.IGM                 ('Italie'),
        new OpenLayers.Layer.IDEE                ('Espagne'),
        new OpenLayers.Layer.OB                  ('Autriche'),
//        new OpenLayers.Layer.Google.Photo        ('Google photo', {visibility: false}),
//        new OpenLayers.Layer.Google.Terrain      ('Google'),
        new OpenLayers.Layer.Bing                ({name: 'Bing',        type: 'Road',             key: '<?=$config['bing_key'];?>'}),
        new OpenLayers.Layer.Bing                ({name: 'Bing photo',  type: 'Aerial',           key: '<?=$config['bing_key'];?>'}),
        new OpenLayers.Layer.Bing                ({name: 'Bing hybrid', type: 'AerialWithLabels', key: '<?=$config['bing_key'];?>'})
    ]);
    
    if (Proj4js.defs['EPSG:21781']) { // Uniquement si une couche SwissTopo est utilisée
        pos21781 =  new OpenLayers.Control.MousePosition ({ // Ajout d'un marqueur de position spécifique pour les cartes Suisses en plus de celui en degrés
                        displayProjection: new OpenLayers.Projection ('EPSG:21781'),
                        numDigits:0, prefix: 'x=',separator:', y='
                    });
        map.addControl (pos21781);
        pos21781.div.style.marginBottom = '40px'; // Au dessus du marqueur permalink
        pos21781.div.style.display =
            map.baseLayer.projection.toString() == 'EPSG:21781'
                ? 'block'
                : 'none';
    }
    // Ajoute les couches vectorielles avec controle
    <?switch ($vue->type_affichage) {
        case 'zone':?>
            map.addLayers ([
                layerMassifs = new OpenLayers.Layer.GMLSLD ('Massifs', {    
                    urlGML: '/exportations/massifs-gml.php',
                    projection: 'EPSG:4326', // Le GML est fourni en degminsec
                    urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
                    styleName: 'Massifs'
                })
            ]);
        <?break;
        case 'edit':?>
            map.addLayers ([
                layerMassifs = new OpenLayers.Layer.GMLSLD ('Massifs', {    
                    urlGML: '/exportations/massifs-gml.php',
                    projection: 'EPSG:4326', // Le GML est fourni en degminsec
                    urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
                    styleName: 'Massif'
                    
                }),
                new OpenLayers.Layer.Editor (
                    'Editeur', 
                    '/exportations/massifs-gml.php' + arg_massifs // Source GML permettant la lecture/ecriture
                )
            ]);
        <?break;
        default:?>
            map.addLayers ([
                layerMassifs = new OpenLayers.Layer.GMLSLD ('Massif', {    
                    urlGML: '/exportations/massifs-gml.php' + arg_massifs,
                    projection: 'EPSG:4326', // Le GML est fourni en degminsec
                    urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
                    styleName: 'Massif',
                    displayInLayerSwitcher: false
                }),
                new OpenLayers.Layer.GMLSLD ('Pyrenees-Refuges.Com', {    
                    urlGML: OpenLayers._getScriptLocation() + 'proxy.php?url=http://chemineur.fr/prod/chem/gml.php&site=prc',
                    projection: 'EPSG:4326', // Le GML est fourni en degminsec
                    urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
                    styleName: 'Points',
                    visibility: false
                }),
                new OpenLayers.Layer.GMLSLD ('Camptocamp.org', {    
                    urlGML: OpenLayers._getScriptLocation() + 'proxy.php?url=http://chemineur.fr/prod/chem/gml.php&site=c2c',
                    projection: 'EPSG:4326', // Le GML est fourni en degminsec
                    urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
                    styleName: 'Points',
                    visibility: false
                }),
                new OpenLayers.Layer.GMLSLD ('Chemineur', {    
                    urlGML: OpenLayers._getScriptLocation() + 'proxy.php?url=http://chemineur.fr/prod/chem/gml.php',
                    projection: 'EPSG:4326', // Le GML est fourni en degminsec
                    urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
                    styleName: 'Points',
                    visibility: false
                }),
                layerPoints = new OpenLayers.Layer.GMLSLD ('Refuges.info', {    
                    urlGML: '/exportations/exportations.php?format=gml&liste_id_point_type=<?=$vue->liste_id_point_type?>' + arg_points + limite,
                    projection: 'EPSG:4326', // Le GML est fourni en degminsec
                    urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
                    styleName: 'Points'
                }),
                layerViseur = new OpenLayers.Layer.ImgDrag ('Viseur', {
                    img: OpenLayers._getScriptLocation() + 'img/viseur.png', h: 30, l: 30, 
                    pos: map.getCenter (), 
                    prefixeId: {
                        titre: 'titre-',
                        decimal: '', // Ces champs seront masqués et remonterons la position du point à créer
                        projected: 'proj-' // ces champs seront visibles et donneront la valeur projetée
                    },
                    displayInLayerSwitcher: false
                })
            ]);
    <?}?>

    // Position et zoom de la carte
    // Si un massif est visé, on s'accorde sur ses limites
    if (<?echo isset ($vue->polygone->bbox) ? 'true' : 'false'?> &&
        !OpenLayers.Util.getParameters (window.location.href).lon) { // Sauf s'il y a un permalink
        var b = new OpenLayers.Bounds (<?=$vue->polygone->bbox?>) 
        .transform (
            new OpenLayers.Projection ('EPSG:4326'), // Données en °
            map.getProjectionObject()
        );
        map.setCenter (
            b.getCenterLonLat (),
            map.getZoomForExtent (b)
        );
    }
    // S'il y a un argument permalink
    else if (OpenLayers.Util.getParameters().zoom)
        ; // On laisse faire OL
    // Sinon, on prend une valeur par défaut
    else if (!map.getCenter()) 
        map.setCenter(
            new OpenLayers.LonLat (6.7, 45.6)
            .transform (map.displayProjection, map.getProjectionObject()), 
            9
        );

    if (typeof layerViseur != 'undefined')
        layerViseur.setVisibility (false); // Rend le curseur invisible

    if (window.FileReader && window.document.getElementById('GPX')) {
        window.document.getElementById('GPX').addEventListener('change', loadGPX, false);
        window.document.getElementById('loadGPX').style.display = 'block';
    }
    // Et pour finir, on repeint en gris les couches non actives dans la zone
    // TODO: avec un peu de ménage sur comment on fixe la position, on devrait pouvoir s'en passer / Dominique 2012 09 13
    lc.greySwitcher ();
}
/*************************************************************************************************************************************/
function switch_massif (combo) {
    var idmassif;
    if (combo.checked) {
        idmassif = 0<?=$vue->polygone->id_polygone?>; 
        document.getElementById ('titrepage') .firstChild.nodeValue = "<?echo addslashes($vue->titre)?>"; 
        arg_massifs = '?massif=<?=$vue->polygone->id_polygone?>';
        arg_points = '&liste_id_massif=<?=$vue->polygone->id_polygone?>';
    } else {
        document.getElementById ('titrepage') .firstChild.nodeValue = "Navigation sur les cartes"; 
        arg_massifs = '?massif=0';
        arg_points = '';
    }
    maj_carte ();
}
/*************************************************************************************************************************************/
function maj_carte () {
    // Calcule l'argument d'extration filtre de points
    var poitypes = document.getElementsByName ('id_point_type[]');
    var listePoints = '0';
    for (var i=0; i < poitypes.length; i++)
        if (poitypes[i].checked)
            listePoints += ',' + poitypes[i].value;
            
    // L'écrit dans un cookie pour se les rappeler auprochain affichage de cette page
    document.cookie = 'liste_id_point_type=' + escape (listePoints) + ';path=/';

    // C'est pas beau: on écrase la valeur interne pour que la modif de paramètre soit pérène lors des appels bbox
    layerMassifs.protocol.options.url = '/exportations/massifs-gml.php' + arg_massifs;
    layerMassifs.refresh ();
    layerPoints.protocol.options.url = '/exportations/exportations.php?format=gml&liste_id_point_type=' + listePoints + arg_points + limite;
    layerPoints.refresh ();
}

/*************************************************************************************************************************************/
// Chargement d'un fichier GPX
function loadGPX (evt) {
    if (!window.FileReader)
        alert ('Interface non supporté par votre explorateur. Utilisez Chrome ou FireFox');
    else {
        var files = evt.target.files; // FileList object
        // files is a FileList of File objects. List some properties.
        var output = [];
        var bounds;
        for (var i = 0, f; f = files[i]; i++) {
            if (f) {
                var fr = new FileReader();
                fr.file = f; // Pour référence dans le callback
                fr.bounds = bounds; // Pour référence dans le callback
                fr.onload = function (evt) { 
                    var contents = evt.target.result;
                    var in_options = {
                        'internalProjection': map.baseLayer.projection,
                        'externalProjection': new OpenLayers.Projection('EPSG:4326')
                    };   
                    var format = new OpenLayers.Format.GPX(in_options);
                    var features = format.read(contents);
                    if (features) {
                        if (features.constructor != Array)
                            features = [features];
                        for (var i=0; i<features.length; ++i)
                            if (!this.bounds)
                                this.bounds = features[i].geometry.getBounds();
                            else
                                this.bounds.extend(features[i].geometry.getBounds());
                        OpenLayers.Feature.Vector.style['default'].strokeColor = 'red';
                        OpenLayers.Feature.Vector.style['default'].strokeWidth = 3;
                        var l = new OpenLayers.Layer.Vector (this.file.name, {});
                        l.addFeatures (features);
                        map.addLayer (l);
                        map.zoomToExtent (this.bounds);
                    }
                }
                fr.readAsText(f);
            } else 
                alert("Failed to load file");
        }
    }
}
