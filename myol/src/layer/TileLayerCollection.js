/**
 * Many simplified display of various tiles layers services
 */

import BingMaps from 'ol/source/BingMaps.js';
import {
  get,
} from 'ol/proj';
import {
  getTopLeft,
  getWidth,
} from 'ol/extent';
import OSM from 'ol/source/OSM.js';
import SourceXYZ from 'ol/source/XYZ.js';
import StadiaMaps from 'ol/source/StadiaMaps.js';
import TilegridWMTS from 'ol/tilegrid/WMTS.js';
import TileLayer from 'ol/layer/Tile';
import TileWMS from 'ol/source/TileWMS.js';
import WMTS from 'ol/source/WMTS.js';

import './TileLayerCollection.css';

/* Makes the attributions chain from:
 {
   contribution: 'link,name',
   attribution: 'link,name',
   licence: 'link,name',
   legend: 'link',
 }
 */
function makeAttributions(options, dataAttribution) {
  const makeLink = args => '<a target="_blank" href="' + args[0] + '">' + args[1] + '</a>',
    ret = [];

  if (options.contribution)
    ret.push(makeLink(options.contribution.split(',')));
  if (options.attribution)
    ret.push(makeLink(options.attribution.split(',')));
  if (options.licence)
    ret.push(makeLink(options.licence.split(',')));
  if (options.legend)
    ret.push(makeLink([options.legend, 'Légende']));
  if (options.dataAttribution)
    ret.push(makeLink(dataAttribution.split(',')));

  if (ret)
    return '&copy' + ret.join(' | ');
}

/**
 * Virtual class to factorise XYZ layers classes
 */
class layerXYZ extends TileLayer {
  constructor(options) {
    super({
      source: new SourceXYZ({
        attributions: makeAttributions(options),

        ...options,
      }),

      ...options,
    });
  }
}

/**
 * OpenStreetMap & co
 * Map : https://www.openstreetmap.org/
 * API : https://wiki.openstreetmap.org/wiki/API/
 */
export class OpenStreetMap extends TileLayer {
  constructor(opt) {
    const options = {
      contribution: 'https://www.openstreetmap.org/copyright,OpenStreetMap',
      legend: 'https://www.openstreetmap.org/panes/legend',

      ...opt,
    };

    super({
      source: new OSM({
        attributions: makeAttributions(options),

        ...options,
      }),
      ...options,
    });
  }
}

/**
 * OSM Topo style OpenTopoMap 
 * Map : Hosted by https://openmaps.fr
 * Doc : https://opentopomap.org/about
 */
export class OpenTopoMap extends OpenStreetMap {
  constructor() {
    super({
      url: 'https://tile.openmaps.fr/opentopomap/{z}/{x}/{y}.png',
      maxZoom: 17,

      attribution: 'https://github.com/sletuffe/OpenTopoMap/,OpenTopoMap-R',
      licence: 'https://creativecommons.org/licenses/by-sa/3.0/,CC-BY-SA',
      legend: 'https://www.geograph.org/leaflet/otm-legend.php',
    });
  }
}

/**
 * Maps of https://openmaps.fr
 * Map : https://openmaps.fr
 * Doc : https://wiki.openstreetmap.org/wiki/OpenHikingMap
 */
export class OpenHikingMap extends OpenStreetMap {
  constructor() {
    super({
      url: 'https://tile.openmaps.fr/openhikingmap/{z}/{x}/{y}.png',
      maxZoom: 18,

      attribution: 'https://wiki.openstreetmap.org/wiki/OpenHikingMap,OpenHikingMap',
      legend: 'https://wiki.openstreetmap.org/wiki/OpenHikingMap#Map_Legend',
    });
  }
}

/**
 * Germany maps
 * Map : https://www.kompass.de/wanderkarte/
 * Doc : https://www.kompass.de/
 */
export class Kompass extends OpenStreetMap { // Austria
  constructor(options = {}) {
    super({
      hidden: !options.key && options.subLayer !== 'osm', // For LayerSwitcher
      url: options.key ?
        'https://map{1-4}.kompass.de/{z}/{x}/{y}/kompass_' + options.subLayer + '?key=' + options.key : // Specific
        'https://map{1-5}.tourinfra.com/tiles/kompass_' + options.subLayer + '/{z}/{x}/{y}.png', // No key
      maxZoom: 17,

      attribution: 'https://www.kompass.de/,Kompass',
      legend: 'https://www.outdooractive.com/fr/knowledgepage/carte-kompass/43778568/#5',

      ...options,
    });
  }
}

/**
 * OSM originated maps
 * Doc : https://www.thunderforest.com/maps/
 * Key : https://manage.thunderforest.com/dashboard
 */
export class Thunderforest extends OpenStreetMap {
  constructor(options = {}) {
    super({
      hidden: !options.key, // For LayerSwitcher
      url: 'https://{a-c}.tile.thunderforest.com/' + options.subLayer + '/{z}/{x}/{y}.png?apikey=' + options.key,
      maxZoom: 22,
      // subLayer: 'outdoors', ...
      // key: '...',

      attribution: 'https://www.thunderforest.com/,Thunderforest',

      ...options, // Include key
    });
  }
}

/**
 * IGN France
 * Doc & API : https://geoservices.ign.fr/services-web
 * Key : https://cartes.gouv.fr
 */
export class IGN extends TileLayer {
  constructor(opt) {
    const options = {
      attribution: 'https://www.geoportail.gouv.fr/,IGN',
      legend: '',

      ...opt,
    };

    const IGNresolutions = [],
      IGNmatrixIds = [];

    for (let i = 0; i < 18; i++) {
      IGNresolutions[i] = getWidth(get('EPSG:3857').getExtent()) / 256 / (2 ** i);
      IGNmatrixIds[i] = i.toString();
    }

    super({
      source: new WMTS({
        // WMTS options
        url: options.key ? 'https://data.geopf.fr/private/wmts?apikey=' + options.key : 'https://data.geopf.fr/wmts',
        style: 'normal',
        matrixSet: 'PM',
        format: 'image/jpeg',
        tileGrid: new TilegridWMTS({
          origin: [-20037508, 20037508],
          resolutions: IGNresolutions,
          matrixIds: IGNmatrixIds,
        }),

        attributions: makeAttributions(options),

        // IGN options
        ...options, // Include layer
      }),

      ...options, // For layer limits
    });
  }
}

export class IGNtop25 extends IGN {
  constructor(options) {

    super({
      layer: 'GEOGRAPHICALGRIDSYSTEMS.MAPS',
      legend: 'https://geoservices.ign.fr/sites/default/files/2021-07/DC_SCAN25_3-1.pdf',

      ...options,
    });
  }
}

export class IGNplan extends IGN {
  constructor(options) {

    super({
      layer: 'GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2',
      format: 'image/png',
      legend: 'https://geoservices.ign.fr/sites/default/files/2021-07/DC_Plan_IGN.pdf',

      ...options,
    });
  }
}

/**
 * Swisstopo https://api.geo.admin.ch/
 * Don't need key nor referer
 * API : https://api3.geo.admin.ch/services/sdiservices.html#wmts
 */
export class SwissTopo extends TileLayer {
  constructor(opt) {
    const options = {
      host: 'https://wmts2{0-4}.geo.admin.ch/1.0.0/',
      subLayer: 'ch.swisstopo.pixelkarte-farbe',
      maxResolution: 2000, // Resolution limit above which we switch to a more global service
      extent: [640000, 5730000, 1200000, 6100000],

      attribution: 'https://map.geo.admin.ch/,SwissTopo',
      legend: 'https://prod-swishop-s3.s3.eu-central-1.amazonaws.com/2022-04/symbols_fr_0.pdf',

      ...opt,
    };

    const projectionExtent = get('EPSG:3857').getExtent(),
      resolutions = [],
      matrixIds = [];

    for (let r = 0; r < 18; ++r) {
      resolutions[r] = getWidth(projectionExtent) / 256 / (2 ** r);
      matrixIds[r] = r;
    }

    super({
      source: new WMTS(({
        url: options.host + options.subLayer +
          '/default/current/3857/{TileMatrix}/{TileCol}/{TileRow}.jpeg',
        tileGrid: new TilegridWMTS({
          origin: getTopLeft(projectionExtent),
          resolutions: resolutions,
          matrixIds: matrixIds,
        }),
        requestEncoding: 'REST',

        attributions: makeAttributions(options),

        ...options, // For attributionss
      })),

      ...options, // For layer limits
    });
  }
}

/**
 * Spain IGN
 * Map : https://www.ign.es/iberpix/visor
 * API : https://api-maps.ign.es/
 */
export class IgnES extends layerXYZ {
  constructor(opt) {
    const options = {
      host: 'https://www.ign.es/wmts/',
      server: 'mapa-raster',
      subLayer: 'MTN',
      maxZoom: 20,

      attribution: 'https://www.ign.es/,Instituto Geográfico Nacional',
      legend: 'https://www.ign.es/web/resources/docs/IGNCnig/Especificaciones/catalogo_MTN25.pdf',

      ...opt,
    };

    super({
      url: options.host + options.server +
        '?layer=' + options.subLayer +
        '&Service=WMTS&Request=GetTile&Version=1.0.0' +
        '&Format=image/jpeg' +
        '&style=default&tilematrixset=GoogleMapsCompatible' +
        '&TileMatrix={z}&TileCol={x}&TileRow={y}',

      ...options,
    });
  }
}

/**
 * Italy IGM
 * Doc : https://gn.mase.gov.it/
 * Map : http://www.pcn.minambiente.it/viewer/
 */
export class IGM extends TileLayer {
  constructor() {
    super({
      source: new TileWMS({
        url: 'https://chemineur.fr/assets/proxy/?s=minambiente.it', // Not available via https
        attributions: '&copy <a href="https://gn.mase.gov.it/">IGM</a>',
      }),

      maxResolution: 120,
      extent: [720000, 4380000, 2070000, 5970000],
    });
  }

  setMapInternal(map) {
    const view = map.getView();

    view.on('change:resolution', () => this.updateResolution(view));
    this.updateResolution(view);

    return super.setMapInternal(map);
  }

  updateResolution(view) {
    const mapResolution = view.getResolutionForZoom(view.getZoom());
    let layerResolution = 25000; // mapResolution < 10

    if (mapResolution > 10) layerResolution = 100000;
    if (mapResolution > 30) layerResolution = 250000;

    this.getSource().updateParams({
      type: 'png',
      map: '/ms_ogc/WMS_v1.3/raster/IGM_' + layerResolution + '.map',
      layers: (layerResolution === 100000 ? 'MB.IGM' : 'CB.IGM') + layerResolution,
    });
  }
}

/**
 * Ordnance Survey : Great Britain
 * API & key : https://osdatahub.os.uk/
 */
export class OS extends layerXYZ {
  constructor(opt) {
    const options = {
      hidden: !opt.key, // For LayerSwitcher
      subLayer: 'Outdoor_3857',
      minZoom: 7,
      maxZoom: 16,
      extent: [-1198263, 6365000, 213000, 8702260],

      attribution: 'https://explore.osmaps.com/,UK Ordnancesurvey maps',
      legend: 'https://www.ordnancesurvey.co.uk/mapzone/assets/doc/Explorer-25k-Legend-en.pdf',

      ...opt,
    };

    super({
      url: 'https://api.os.uk/maps/raster/v1/zxy/' +
        options.subLayer +
        '/{z}/{x}/{y}.png' +
        '?key=' + options.key,

      ...options,
    });
  }
}

/**
 * ArcGIS (Esri)
 * Map : https://www.arcgis.com/home/webmap/viewer.html
 * API : https://developers.arcgis.com/javascript/latest/
 * No key
 */
export class ArcGIS extends layerXYZ {
  constructor(opt) {
    const options = {
      host: 'https://server.arcgisonline.com/ArcGIS/rest/services/',
      subLayer: 'World_Imagery',
      maxZoom: 19,

      attribution: 'https://www.arcgis.com/,ArcGIS (Esri)',

      ...opt,
    };

    super({
      url: options.host + options.subLayer + '/MapServer/tile/{z}/{y}/{x}',
      ...options,
    });
  }
}

/**
 * Maxbox (Maxar)
 * Key : https://www.mapbox.com/
 */
export class Maxbox extends layerXYZ {
  constructor(options = {}) {
    super({
      hidden: !options.key, // For LayerSwitcher
      url: 'https://api.mapbox.com/v4/' + options.tileset + '/{z}/{x}/{y}@2x.webp?access_token=' + options.key,
      // No maxZoom

      attribution: 'https://www.mapbox.com/,Mapbox',
    });
  }
}

/**
 * Google
 */
export class Google extends layerXYZ {
  constructor(opt) {
    const options = {
      subLayers: 'p', // Terrain
      maxZoom: 22,

      attribution: 'https://www.google.com/maps,Google',

      ...opt,
    };

    super({
      url: 'https://mt{0-3}.google.com/vt/lyrs=' + options.subLayers + '&hl=fr&x={x}&y={y}&z={z}',

      ...options,
    });
  }
}

/**
 * Bing (Microsoft)
 * Doc: https://docs.microsoft.com/en-us/bingmaps/getting-started/
 * Key : https://www.bingmapsportal.com/
 */
export class Bing extends TileLayer {
  constructor(options = {}) {
    super({
      hidden: !options.key, // For LayerSwitcher
      imagerySet: 'Road',
      // Mandatory 'key',
      // No explicit zoom
      // attributions, defined by ol.source.BingMaps

      ...options,
    });

    //HACK : Avoid to call https://dev.virtualearth.net/... if no bing layer is visible
    this.on('change:visible', evt => {
      if (evt.target.getVisible() && // When the layer becomes visible
        !this.getSource()) // Only once
        this.setSource(new BingMaps(options));
    });
  }
}

/**
 * Simple layers
 * Doc : https://maps.stamen.com/
 */
export class Stamen extends TileLayer {
  constructor(options) {
    super({
      source: new StadiaMaps({
        layer: 'stamen_watercolor', // Default
        // attributions: defined by ol.source.StadiaMaps

        ...options,
      }),

      ...options,
    });
  }
}

/**
 * Simple shematic layer
 * API : https://api-docs.carto.com/
 */
export class CartoDB extends layerXYZ {
  constructor(options) {
    super({
      url: 'https://basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png',
      attribution: 'https://carto.com/attribution/,CartoDB',

      ...options,
    });
  }
}

/**
 * Simple layer displaying a zoom error
 */
export class NoTile extends layerXYZ {
  constructor(options) {
    super({
      url: 'https://ecn.t0.tiles.virtualearth.net/tiles/r000000000000000000.jpeg?g=1',
      attributions: 'No tile',

      ...options,
    });
  }
}

/**
 * RGB elevation (Mapbox)
 * Each pixel color encode the elevation
 * Doc: https://docs.mapbox.com/data/tilesets/guides/access-elevation-data/
 * elevation = -10000 + (({R} * 256 * 256 + {G} * 256 + {B}) * 0.1)
 * Key : https://www.mapbox.com/
 */
export class MapboxElevation extends Maxbox {
  constructor(options = {}) {
    super({
      hidden: !options.key, // For LayerSwitcher
      ...options,
      tileset: 'mapbox.terrain-rgb',
    });
  }
}

/**
 * RGB elevation (MapTiler)
 * Doc: https://cloud.maptiler.com/tiles/terrain-rgb-v2/
 * Doc: https://documentation.maptiler.com/hc/en-us/articles/4405444055313-RGB-Terrain-by-MapTiler
 * elevation = -10000 + ((R * 256 * 256 + G * 256 + B) * 0.1
 * Key : https://cloud.maptiler.com/account/keys/
 */
/*// Backup of Maxbox elevation
export class MapTilerElevation extends layerXYZ {
  constructor(options = {}) {
    super({
      hidden: !options.key, // For LayerSwitcher
      url: 'https://api.maptiler.com/tiles/terrain-rgb/{z}/{x}/{y}.png?key=' + options.key,
      maxZoom: 12,
	  
      ...options,
    });
  }
}*/

/**
 * Tile layers examples
 */
export function wriNavLayers(options = {}) {
  return {
    // Carte refuges.info
    'OpenHikingMap': new OpenHikingMap(),
    'OpenStreetMap': new OpenStreetMap(),
    'OpenTopoMap': new OpenTopoMap(),
    'Outdoors': new Thunderforest({
      key: options.thunderforest, // For simplified options
      ...options.thunderforest, // Include key
      subLayer: 'outdoors',
      legend: '',
    }),

    'IGN TOP25': new IGNtop25({
      key: options.ign, // Include key
      ...options.ign, // Include key
    }),
    'IGN plan': new IGNplan(),

    'SwissTopo': new SwissTopo(),
    'Österreich Kompass': new Kompass({
      subLayer: 'osm', // No key
    }),
    'España': new IgnES(),

    'Photo IGN': new IGN({
      layer: 'ORTHOIMAGERY.ORTHOPHOTOS',
    }),

    'Photo ArcGIS': new ArcGIS(),
    'Photo Google': new Google({
      subLayers: 's',
    }),
    'Photo Maxar': new Maxbox({
      key: options.mapbox, // For simplified options
      ...options.mapbox, // Include key
      tileset: 'mapbox.satellite',
    }),
  }
}

export function collection(options = {}) {
  return {
    ...wriNavLayers(options),

    'OSM transports': new Thunderforest({
      key: options.thunderforest, // For simplified options
      ...options.thunderforest, // Include key
      subLayer: 'transport',
      legend: '',
    }),
    'CyclOSM': new OpenStreetMap({
      url: 'https://{a-c}.tile-cyclosm.openstreetmap.fr/cyclosm/{z}/{x}/{y}.png',
      legend: 'https://www.cyclosm.org/legend.html',
    }),

    'IGN cartes 1950': new IGN({
      layer: 'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN50.1950',
      extent: [-580000, 506000, 1070000, 6637000],
      minZoom: 6,
    }),

    'Kompas winter': new Kompass({
      key: options.kompass, // For simplified options
      ...options.kompass, // Include key
      subLayer: 'winter',
      maxZoom: 22,
    }),
    'England': new OS({
      key: options.os, // For simplified options
      ...options.os, // Include key
    }),
    'Italie': new IGM(),

    'Google': new Google(),
    'Photo Bing': new Bing({
      key: options.bing, // For simplified options
      ...options.bing, // Include key
      imagerySet: 'Aerial',
    }),

    'Photo IGN 1950-65': new IGN({
      layer: 'ORTHOIMAGERY.ORTHOPHOTOS.1950-1965',
      style: 'BDORTHOHISTORIQUE',
      format: 'image/png',
      extent: [-580000, 506000, 1070000, 6637000],
      minZoom: 12,
    }),
    'IGN E.M. 1820-66': new IGN({
      layer: 'GEOGRAPHICALGRIDSYSTEMS.ETATMAJOR40',
      extent: [-580000, 506000, 1070000, 6637000],
      minZoom: 6,
    }),
    'Cadastre': new IGN({
      layer: 'CADASTRALPARCELS.PARCELLAIRE_EXPRESS',
      format: 'image/png',
      extent: [-580000, 506000, 1070000, 6637000],
      minZoom: 6,
    }),

    /* //BEST Cassini ? clé
	'IGN Cassini': new IGN({
      ...options.ign,
      layer: 'GEOGRAPHICALGRIDSYSTEMS.CASSINI',
      key: 'an7nvfzojv5wa96dsga5nk8w', //BEST use owner key
    }),
	*/
  };
}

export function examples(options = {}) {
  return {
    ...collection(options),

    'OpenStreetMap FR': new OpenStreetMap({
      url: 'https://{a-c}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png',
      legend: '',
    }),
    'OSM orthos FR': new OpenStreetMap({
      url: 'https://wms.openstreetmap.fr/tms/1.0.0/tous_fr/{z}/{x}/{y}',
      legend: '',
    }),

    'OpenCycleMap': new Thunderforest({
      key: options.thunderforest, // For simplified options
      ...options.thunderforest, // Include key
      subLayer: 'cycle',
      legend: 'https://www.opencyclemap.org/docs/',
      maxZoom: 14,
    }),
    'ThF trains': new Thunderforest({
      key: options.thunderforest, // For simplified options
      ...options.thunderforest, // Include key
      subLayer: 'pioneer',
    }),
    'ThF villes': new Thunderforest({
      key: options.thunderforest, // For simplified options
      ...options.thunderforest, // Include key
      subLayer: 'neighbourhood',
    }),
    'ThF landscape': new Thunderforest({
      key: options.thunderforest, // For simplified options
      ...options.thunderforest, // Include key
      subLayer: 'landscape',
    }),
    'ThF contraste': new Thunderforest({
      key: options.thunderforest, // For simplified options
      ...options.thunderforest, // Include key
      subLayer: 'mobile-atlas',
    }),

    'OS light': new OS({
      key: options.os, // For simplified options
      ...options.os, // Include key
      subLayer: 'Light_3857',
    }),
    'OS road': new OS({
      key: options.os, // For simplified options
      ...options.os, // Include key
      subLayer: 'Road_3857',
    }),
    'Kompas topo': new Kompass({
      key: options.kompass, // For simplified options
      ...options.kompass, // Include key
      subLayer: 'topo',
    }),

    'Bing': new Bing({
      key: options.bing, // For simplified options
      ...options.bing, // Include key
      imagerySet: 'Road',
    }),
    'Bing hybrid': new Bing({
      key: options.bing, // For simplified options
      ...options.bing, // Include key
      imagerySet: 'AerialWithLabels',
    }),

    'Photo Swiss': new SwissTopo({
      subLayer: 'ch.swisstopo.swissimage',
      legend: '',
    }),
    'Photo España': new IgnES({
      server: 'pnoa-ma',
      subLayer: 'OI.OrthoimageCoverage',
      legend: '',
    }),

    'Google road': new Google({
      subLayers: 'm', // Roads
    }),
    'Google hybrid': new Google({
      subLayers: 's,h',
    }),

    'MapBox elevation': new MapboxElevation({
      key: options.mapbox, // For simplified options
      ...options.mapbox, // Include key
    }),

    'CartoDB': new CartoDB(),
    'Stamen watercolor': new Stamen(),
    'Stamen terrain': new Stamen({
      layer: 'stamen_terrain',
    }),
    'Stamen toner': new Stamen({
      layer: 'stamen_toner',
    }),
    'Stamen toner lite': new Stamen({
      layer: 'stamen_toner_lite',
    }),
    'No tile': new NoTile(),
    'Blank': new TileLayer(),
  };
}