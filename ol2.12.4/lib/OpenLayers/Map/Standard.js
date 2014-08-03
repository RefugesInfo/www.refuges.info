/*DCM++ © Dominique Cavailhez 2012
 * Copyright (c) 2006-2012 by OpenLayers Contributors (see authors.txt for 
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */

/**
 * @requires OpenLayers/Map.js
 * @requires OpenLayers/Layer/MRI.js
 * @requires OpenLayers/Layer/OSM.js
 * @requires OpenLayers/Layer/OSM.js
 * @requires OpenLayers/Layer/OCM.js
 * @requires OpenLayers/Layer/SwissTopo.js
 * @requires OpenLayers/Layer/IDEE.js
 * @requires OpenLayers/Layer/IGM.js
 * @requires OpenLayers/Layer/OS.js
 * @requires OpenLayers/Layer/OB.js
 * @requires OpenLayers/Layer/Googles.js
 * @requires OpenLayers/Layer/Bing.js
 * @requires OpenLayers/Control/Navigation.js
 * @requires OpenLayers/Control/PermalinkCookies.js
 * @requires OpenLayers/Control/ScaleLine.js
 * @requires OpenLayers/Control/Attribution.js
 * @requires OpenLayers/Control/MousePosition.js
 * @requires OpenLayers/Control/PanZoom.js
 * @requires OpenLayers/Control/GPSPanel.js
 * @requires OpenLayers/Control/FullScreenPanel.js
 * @requires OpenLayers/Control/LayerSwitcherConditional.js
 */

/**
 * Class: OpenLayers.Map.Standard
 * Instances of the map with all basics baselayers
 * 
 * Inherits from:
 *  - <OpenLayers.Map>
 */
OpenLayers.Map.Standard = OpenLayers.Class(OpenLayers.Map, {

    /**
     * Constructor: OpenLayers.Map.Standard
     * Create a new IGM layer.
     */
    initialize: function (div, options, key, layers) {
        var baseLayers = [
            new OpenLayers.Layer.MRI                 ('Refuges.Info'),
            new OpenLayers.Layer.OSM                 ('OSM'),
            new OpenLayers.Layer.OCM                 ('OpenCycleMap'),
            new OpenLayers.Layer.OCM.Transport       ('Transport'),
            new OpenLayers.Layer.OCM.Landscape       ('Landscape'),
            new OpenLayers.Layer.OCM.Outdoors        ('Outdoors')
        ];
        if (key.IGN != undefined && key.IGN)
            baseLayers = baseLayers.concat ([
                new OpenLayers.Layer.IGN             ('IGN',           key.IGN),
                new OpenLayers.Layer.IGN.Classique   ('IGN classique', key.IGN),
                new OpenLayers.Layer.IGN.Standard    ('IGN Standard',  key.IGN),
                new OpenLayers.Layer.IGN.Photo       ('IGN photo',     key.IGN),
                new OpenLayers.Layer.IGN.Cadastre    ('IGN cadastre',  key.IGN)
            ]);
        baseLayers = baseLayers.concat ([
            new OpenLayers.Layer.SwissTopo           ('SwissTopo'),
            new OpenLayers.Layer.SwissTopo.Siegfried ('Swiss 1949'),
            new OpenLayers.Layer.SwissTopo.Dufour    ('Swiss 1864'),
            new OpenLayers.Layer.SwissTopo.Photo     ('Swiss photo')
        ]);
        baseLayers = baseLayers.concat ([
            new OpenLayers.Layer.IDEE                ('Espa&ntilde;a'), 
            new OpenLayers.Layer.IGM                 ('Italia')
        ]);
        if (key.OS != undefined && key.OS)
            baseLayers = baseLayers.concat ([
                new OpenLayers.Layer.OS                  ('Great Britain', key.OS)
            ]);
        if (key.OB != undefined && key.OB)
            baseLayers = baseLayers.concat ([
                new OpenLayers.Layer.OB                  ('OberBayern') // UK Ordonance Survey Layer
            ]);
        if (key.Google != undefined && key.Google)
            baseLayers = baseLayers.concat ([
                new OpenLayers.Layer.Google.Terrain      ('Google'),
                new OpenLayers.Layer.Google              ('Google map',    {visibility: false}), // Cachées au début sinon, apparaissent fugitivement
                new OpenLayers.Layer.Google.Photo        ('Google photo',  {visibility: false}),
                new OpenLayers.Layer.Google.Hybrid       ('Google hybrid', {visibility: false})
            ]);
        if (key.Bing != undefined && key.Bing)
            baseLayers = baseLayers.concat ([
                new OpenLayers.Layer.Bing                ({name: 'Bing',        type: 'Road',             key: key.Bing}),
                new OpenLayers.Layer.Bing                ({name: 'Bing photo',  type: 'Aerial',           key: key.Bing}),
                new OpenLayers.Layer.Bing                ({name: 'Bing hybrid', type: 'AerialWithLabels', key: key.Bing})
            ]);

        OpenLayers.Map.prototype.initialize.call (this, div, {
            displayProjection: 'EPSG:4326', // Affichage en °
            controls: [
                new OpenLayers.Control.Navigation(),
                new OpenLayers.Control.PermalinkCookies (options), // Ne doit pas être en premier

                new OpenLayers.Control.ScaleLine({geodesic: true}), // L'échelle n'est pas la bonne pour les projections de type mercator. En effet, dans cette projection, le rapport nombre pixel/distance réél augmente quand on se rapproche des pôles.Pour corriger ça, un simple geodesic:yes fait l'affaire (SLY 29/11/2010)
                new OpenLayers.Control.Attribution(),
                new OpenLayers.Control.MousePosition(),
				new OpenLayers.Control.PanZoom(),
                new OpenLayers.Control.GPSPanel(),
                new OpenLayers.Control.FullScreenPanel(),
                new OpenLayers.Control.LayerSwitcherConditional()
            ],
            layers: baseLayers,
            numZoomLevels: 22
        });

        if (layers != undefined)
            this.addLayers (layers);
    },

    CLASS_NAME: "OpenLayers.Map.Standard"
});
