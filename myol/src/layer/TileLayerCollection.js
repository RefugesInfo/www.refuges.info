/**
 * TileLayerCollection.js
 * Acces to various tiles layers services
 */

import ol from '../ol';

// Virtual class to factorise XYZ layers code
class XYZ extends ol.layer.Tile {
  constructor(options) {
    super({
      source: new ol.source.XYZ(options),
      ...options,
    });
  }
}

// OpenStreetMap & co
export class OpenStreetMap extends ol.layer.Tile {
  constructor(options) {
    super({
      source: new ol.source.OSM(options),
      ...options,
    });
  }
}

export class OpenTopo extends OpenStreetMap {
  constructor() {
    super({
      url: 'https://{a-c}.tile.opentopomap.org/{z}/{x}/{y}.png',
      maxZoom: 17,
      attributions: '<a href="https://opentopomap.org">OpenTopoMap</a> ' +
        '(<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)',
    });
  }
}

export class MRI extends OpenStreetMap {
  constructor() {
    super({
      url: 'https://maps.refuges.info/hiking/{z}/{x}/{y}.png',
      maxZoom: 18,
      attributions: '<a href="//wiki.openstreetmap.org/wiki/Hiking/mri">Refuges.info</a>',
    });
  }
}

export class Kompass extends OpenStreetMap { // Austria
  constructor(options = {}) {
    super({
      url: options.key ?
        'https://map{1-4}.kompass.de/{z}/{x}/{y}/kompass_' + options.subLayer + '?key=' + options.key : // Specific
        'https://map{1-5}.tourinfra.com/tiles/kompass_' + options.subLayer + '/{z}/{x}/{y}.png', // No key
      maxZoom: 17,
      hidden: !options.key && options.subLayer != 'osm', // For LayerSwitcher
      attributions: '<a href="http://www.kompass.de/livemap/">Kompass</a>',
      ...options,
    });
  }
}

export class Thunderforest extends OpenStreetMap {
  constructor(options = {}) {
    super({
      url: 'https://{a-c}.tile.thunderforest.com/' + options.subLayer + '/{z}/{x}/{y}.png?apikey=' + options.key,
      maxZoom: 22,
      // subLayer: 'outdoors', ...
      // key: Get a key at https://manage.thunderforest.com/dashboard
      hidden: !options.key, // For LayerSwitcher
      attributions: '<a href="http://www.thunderforest.com">Thunderforest</a>',
      ...options, // Include key
    });
  }
}

export class Positron extends XYZ {
  constructor(options) {
    super({
      url: 'https://cartodb-basemaps-a.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png',
      attributions: '<a href="https://carto.com/attribution/#basemaps">CartoDB</a>',
      ...options,
    });
  }
}

/**
 * IGN France
 * doc : https://geoservices.ign.fr/services-web
 */
export class IGN extends ol.layer.Tile {
  constructor(options = {}) {
    let IGNresolutions = [],
      IGNmatrixIds = [];

    for (let i = 0; i < 18; i++) {
      IGNresolutions[i] = ol.extent.getWidth(ol.proj.get('EPSG:3857').getExtent()) / 256 / Math.pow(2, i);
      IGNmatrixIds[i] = i.toString();
    }

    super({
      hidden: !options.key, // For LayerSwitcher
      source: new ol.source.WMTS({
        // WMTS options
        url: 'https://wxs.ign.fr/' + options.key + '/wmts',
        layer: 'GEOGRAPHICALGRIDSYSTEMS.MAPS', // Top 25
        style: 'normal',
        matrixSet: 'PM',
        format: 'image/jpeg',
        attributions: '&copy; <a href="http://www.geoportail.fr/" target="_blank">IGN</a>',
        tileGrid: new ol.tilegrid.WMTS({
          origin: [-20037508, 20037508],
          resolutions: IGNresolutions,
          matrixIds: IGNmatrixIds,
        }),

        // IGN options
        // key, Get your own (free) IGN key at https://geoservices.ign.fr/

        ...options, // Include key & layer
      }),
      ...options, // For layer limits
    });
  }
}

/**
 * Swisstopo https://api.geo.admin.ch/
 * Don't need key nor referer
 * API : https://api3.geo.admin.ch/services/sdiservices.html#wmts
 */
export class SwissTopo extends ol.layer.Tile {
  constructor(options) {
    options = {
      host: 'https://wmts2{0-4}.geo.admin.ch/1.0.0/',
      subLayer: 'ch.swisstopo.pixelkarte-farbe',
      maxResolution: 2000, // Resolution limit above which we switch to a more global service
      extent: [640000, 5730000, 1200000, 6100000],
      attributions: '&copy <a href="https://map.geo.admin.ch/">SwissTopo</a>',

      ...options,
    };

    const projectionExtent = ol.proj.get('EPSG:3857').getExtent(),
      resolutions = [],
      matrixIds = [];

    for (let r = 0; r < 18; ++r) {
      resolutions[r] = ol.extent.getWidth(projectionExtent) / 256 / Math.pow(2, r);
      matrixIds[r] = r;
    }

    super({
      source: new ol.source.WMTS(({
        url: options.host + options.subLayer +
          '/default/current/3857/{TileMatrix}/{TileCol}/{TileRow}.jpeg',
        tileGrid: new ol.tilegrid.WMTS({
          origin: ol.extent.getTopLeft(projectionExtent),
          resolutions: resolutions,
          matrixIds: matrixIds,
        }),
        requestEncoding: 'REST',
      })),

      ...options, // For layer limits
    });
  }
}

/**
 * Spain
 */
export class IgnES extends XYZ {
  constructor(options) {
    options = {
      host: 'https://www.ign.es/wmts/',
      server: 'mapa-raster',
      subLayer: 'MTN',
      maxZoom: 20,
      attributions: '&copy; <a href="http://www.ign.es/">IGN España</a>',
      ...options,
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
 */
export class IGM extends ol.layer.Tile {
  constructor() {
    super({
      source: new ol.source.TileWMS({
        url: 'https://chemineur.fr/assets/proxy/?s=minambiente.it', // Not available via https
        attributions: '&copy <a href="http://www.pcn.minambiente.it/viewer/">IGM</a>',
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
    const mapResolution = view.getResolutionForZoom(view.getZoom()),
      layerResolution = mapResolution < 10 ? 25000 : mapResolution < 30 ? 100000 : 250000;

    this.getSource().updateParams({
      type: 'png',
      map: '/ms_ogc/WMS_v1.3/raster/IGM_' + layerResolution + '.map',
      layers: (layerResolution == 100000 ? 'MB.IGM' : 'CB.IGM') + layerResolution,
    });
  }
}

/**
 * Ordnance Survey : Great Britain
 * key: Get your own (free) key at https://osdatahub.os.uk/
 */
export class OS extends XYZ {
  constructor(options = {}) {
    options = {
      hidden: !options.key, // For LayerSwitcher
      subLayer: 'Outdoor_3857',
      minZoom: 7,
      maxZoom: 16,
      extent: [-1198263, 6365000, 213000, 8702260],
      attributions: '&copy <a href="https://explore.osmaps.com">UK Ordnancesurvey maps</a>',

      ...options,
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
 */
export class ArcGIS extends XYZ {
  constructor(options) {
    options = {
      host: 'https://server.arcgisonline.com/ArcGIS/rest/services/',
      subLayer: 'World_Imagery',
      maxZoom: 19,
      attributions: '&copy; <a href="https://www.arcgis.com/home/webmap/viewer.html">ArcGIS (Esri)</a>',
      ...options,
    };

    super({
      url: options.host + options.subLayer + '/MapServer/tile/{z}/{y}/{x}',
      ...options,
    });
  }
}

/**
 * Maxbox (Maxar)
 * Get your own (free) key at https://www.mapbox.com/
 */
export class Maxbox extends XYZ {
  constructor(options = {}) {
    super({
      url: 'https://api.mapbox.com/v4/' + options.tileset + '/{z}/{x}/{y}@2x.webp?access_token=' + options.key,
      // No maxZoom
      attributions: '&copy; <a href="https://mapbox.com/">Mapbox</a>',
    });
  }
}

/**
 * Google
 */
export class Google extends XYZ {
  constructor(options) {
    options = {
      subLayers: 'p', // Terrain
      maxZoom: 22,
      attributions: '&copy; <a href="https://www.google.com/maps">Google</a>',
      ...options,
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
 * Get your own (free) key at https://www.bingmapsportal.com
 */
export class Bing extends ol.layer.Tile {
  constructor(options = {}) {
    super({
      // Mandatory
      // 'key',
      imagerySet: 'Road',

      hidden: !options.key, // For LayerSwitcher
      // No explicit zoom
      // attributions, defined by ol.source.BingMaps

      ...options,
    });

    //HACK : Avoid to call https://dev.virtualearth.net/... if no bing layer is visible
    this.on('change:visible', evt => {
      if (evt.target.getVisible() && // When the layer becomes visible
        !this.getSource()) // Only once
        this.setSource(new ol.source.BingMaps(options));
    });
  }
}

/**
 * RGB elevation (Mapbox)
 * Doc: https://docs.mapbox.com/data/tilesets/guides/access-elevation-data/
 * elevation = -10000 + (({R} * 256 * 256 + {G} * 256 + {B}) * 0.1)
 * Get your own (free) key at https://www.mapbox.com/
 */
export class MapboxElevation extends Maxbox {
  constructor(options) {
    super({
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
 * Get your own (free) key at https://cloud.maptiler.com/account/keys/
 */
/*// Opportunity : backup of Maxbox elevation 
export class MapTilerElevation extends XYZ {
  constructor(options = {}) {
    super({
      url: 'https://api.maptiler.com/tiles/terrain-rgb/{z}/{x}/{y}.png?key=' + options.key,
      hidden: !options.key, // For LayerSwitcher
      maxZoom: 12,
      attributions: '<a href="https://www.maptiler.com/copyright/"">&copy; MapTiler</a> ' + '<a href="https://www.openstreetmap.org/copyright"">&copy; OpenStreetMap contributors</a>',
      ...options,
    });
  }
}*/

export class NoTile extends XYZ {
  constructor(options) {
    super({
      url: 'https://ecn.t0.tiles.virtualearth.net/tiles/r000000000000000000.jpeg?g=13897&mkt=en-us&shading=hill',
      attributions: 'Out of zoom',
      ...options,
    });
  }
}

// Tile layers examples
export function collection(options = {}) {
  return {
    'OSM fr': new OpenStreetMap({
      url: 'https://{a-c}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png',
    }),
    'OpenTopo': new OpenTopo(),
    'OSM outdoors': new Thunderforest({
      ...options.thunderforest, // Include key
      subLayer: 'outdoors',
    }),
    'OSM transports': new Thunderforest({
      ...options.thunderforest, // Include key
      subLayer: 'transport',
    }),
    'OSM cyclo': new OpenStreetMap({
      url: 'https://{a-c}.tile-cyclosm.openstreetmap.fr/cyclosm/{z}/{x}/{y}.png',
    }),
    'Refuges.info': new MRI(),

    'IGN TOP25': new IGN(options.ign), // options include key
    'IGN V2': new IGN({
      layer: 'GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2',
      key: 'essentiels',
      format: 'image/png',
    }),
    'IGN cartes 1950': new IGN({
      layer: 'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN50.1950',
      key: 'cartes/geoportail',
      extent: [-580000, 506000, 1070000, 6637000],
      minZoom: 6,
    }),

    'SwissTopo': new SwissTopo(),
    'Österreich Kompass': new Kompass({
      subLayer: 'osm', // No key
    }),
    'Kompas winter': new Kompass({
      ...options.kompass, // Include key
      subLayer: 'winter',
      maxZoom: 22,
    }),
    'England': new OS(options.os), // options include key
    'Italie': new IGM(),

    'España': new IgnES(),
    'Google': new Google(),

    'Maxar': new Maxbox({
      tileset: 'mapbox.satellite',
      ...options.mapbox,
    }),
    'Photo Google': new Google({
      subLayers: 's',
    }),
    'Photo ArcGIS': new ArcGIS(),
    'Photo Bing': new Bing({
      ...options.bing, // Include key
      imagerySet: 'Aerial',
    }),
    'Photo IGN': new IGN({
      layer: 'ORTHOIMAGERY.ORTHOPHOTOS',
      key: 'essentiels',
    }),

    'Photo IGN 1950-65': new IGN({
      layer: 'ORTHOIMAGERY.ORTHOPHOTOS.1950-1965',
      key: 'orthohisto/geoportail',
      style: 'BDORTHOHISTORIQUE',
      format: 'image/png',
      extent: [-580000, 506000, 1070000, 6637000],
      minZoom: 12,
    }),

    'IGN E.M. 1820-66': new IGN({
      layer: 'GEOGRAPHICALGRIDSYSTEMS.ETATMAJOR40',
      key: 'cartes/geoportail',
      extent: [-580000, 506000, 1070000, 6637000],
      minZoom: 6,
    }),
    'Cadastre': new IGN({
      layer: 'CADASTRALPARCELS.PARCELLAIRE_EXPRESS',
      key: 'essentiels',
      format: 'image/png',
      extent: [-580000, 506000, 1070000, 6637000],
      minZoom: 6,
    }),
    /*'IGN Cassini': new IGN({ //BEST BUG what key for Cassini ?
    	...options.ign,
    	layer: 'GEOGRAPHICALGRIDSYSTEMS.CASSINI',
    }),*/
  };
}

export function demo(options = {}) {
  return {
    ...collection(options),

    'OSM': new OpenStreetMap(),
    'OSM orthos FR': new OpenStreetMap({
      url: 'http://wms.openstreetmap.fr/tms/1.0.0/tous_fr/{z}/{x}/{y}',
    }),
    'Positron': new Positron(),

    'ThF cycle': new Thunderforest({
      ...options.thunderforest, // Include key
      subLayer: 'cycle',
      maxZoom: 14,
    }),
    'ThF trains': new Thunderforest({
      ...options.thunderforest, // Include key
      subLayer: 'pioneer',
    }),
    'ThF villes': new Thunderforest({
      ...options.thunderforest, // Include key
      subLayer: 'neighbourhood',
    }),
    'ThF landscape': new Thunderforest({
      ...options.thunderforest, // Include key
      subLayer: 'landscape',
    }),
    'ThF contraste': new Thunderforest({
      ...options.thunderforest, // Include key
      subLayer: 'mobile-atlas',
    }),

    'OS light': new OS({
      ...options.os, // Include key
      subLayer: 'Light_3857',
    }),
    'OS road': new OS({
      ...options.os, // Include key
      subLayer: 'Road_3857',
    }),
    'Kompas topo': new Kompass({
      ...options.kompass, // Include key
      subLayer: 'topo',
    }),

    'Bing': new Bing({
      ...options.bing, // Include key
      imagerySet: 'Road',
    }),
    'Bing hybrid': new Bing({
      ...options.bing, // Include key
      imagerySet: 'AerialWithLabels',
    }),

    'Photo Swiss': new SwissTopo({
      subLayer: 'ch.swisstopo.swissimage',
    }),
    'Photo España': new IgnES({
      server: 'pnoa-ma',
      subLayer: 'OI.OrthoimageCoverage',
    }),

    'Google road': new Google({
      subLayers: 'm', // Roads
    }),
    'Google hybrid': new Google({
      subLayers: 's,h',
    }),

    'MapBox elevation': new MapboxElevation(options.mapbox), // options include key

    'No tile': new NoTile(),
    'Blank': new ol.layer.Tile(),
  };
}