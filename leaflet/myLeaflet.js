/*************************************************
 * Personnal adaptations & addOns for leaflet    *
 * This file contains all the generic comon code *
 * related to leaflet functions                  *
 * © Dominique Cavailhez 2026                    *
 *************************************************/

/*********************************************
 * Couches vectorielles du site refuges.info *
 *********************************************
  Une icône est une image .png représentant un type de point
  Un point est défini par une position, un nom et une icône destinée à être affiché sur une carte
  Une fiche contient toutes les informations concernant un point, y compris les commentaires

  json est une structure contenant des définitions de points
  geoJson sa représentation en string

  Le résultat des requêtes API est mis en cache pendant 1 semaine par l'explorateur
  La date de dernière création, édition, suppression de polygone ou point (hors commentaires)
  est fournie à la page HTML qui la passe en argument de l'API pour recharger si nécessaire.
*/

/*********************************
 * Points d'intérêt refuges.info *
 *********************************/
/* eslint-disable-next-line no-unused-vars */
class WriPOILayer extends L.geoJson {
  constructor(serveurAPI, type, versionFeatures, hideTooltip) {
    const iconList = [],
      url = serveurAPI + '/api/bbox?' +
      'nb_points=all&type_points=' + type +
      '&version=' + versionFeatures + '&cache=' + (7 * 24 * 3600);
    //TODO Délai cache api / depuis

    super(null, {
      // Icônes
      pointToLayer: (feature, latlng) =>
        L.marker(latlng, {
          icon: L.icon({
            iconUrl: serveurAPI + '/images/icones/' + feature.properties.type.icone + '.svg',
            iconSize: [24, 24],
            iconAnchor: [12, 12],
          }),
        }),

      onEachFeature: (feature, layer) => {
        // Etiquettes
        if (!hideTooltip)
          layer.bindTooltip(
            feature.properties.nom, {
              permanent: true,
              direction: 'center',
            }).openTooltip();

        layer.on({
          click: () => {
            location.href = '/point/' + feature.id;
          },
        });

        // For icons prelaod
        iconList[feature.properties.type.icone] = true;
      },
    });

    // Fetch remote data
    fetch(url)
      .catch((er) => console.error(er + ' fetching ' + url))
      .then((response) => response.json())
      .then((json) => {
        if (json.features.length) {
          this.addData(json);
          this.fire('adddata');

          // Preload icons
          //TODO don't do it twice
          for (const name in iconList)
            document.body.insertAdjacentHTML('beforeend', '<img style="display:none" src="/images/icones/' + name + '.svg"/>')
        }

        // Trigger for who needs it
        this.fire('load');
      });
  }
}

/*****************************
 * Polygones de refuges.info *
 *****************************/
/* eslint-disable-next-line no-unused-vars */
class WriPolygonLayer extends L.geoJson {
  constructor(serveurAPI, typeId, versionFeatures, clickEnabled) {
    const url = serveurAPI + '/api/polygones?' +
      'type_polygon=' + typeId +
      '&version=' + versionFeatures +
      '&cache=' + (7 * 24 * 3600);

    super(null, {
      style: (feature) => ({
        stroke: false,
        color: feature.properties.couleur,
      }),

      onEachFeature: (feature, layer) => {
        // Etiquettes
        layer.bindTooltip(
          feature.properties.nom
          .replace(/ ([a-z]?[a-z]?[a-z]) /gui, ' $1&nbsp;')
          .replace(/ /gu, '<br/>'), {
            permanent: true,
            direction: 'center',
          }).openTooltip();

        layer.on('mouseover mouseout', (evt) => {
          evt.target.setStyle({
            stroke: evt.type === 'mouseover',
          });
        });

if(clickEnabled)
        layer.on({
          click: (evt) => {
            location.href = '/nav/' + evt.sourceTarget.feature.id;
          },
        });
      },
    });

    fetch(url)
      .catch((er) => console.error(er + ' fetching ' + url))
      .then((response) => response.json())
      .then((json) => {
        if (json.features.length)
          this.addData(json);
      });
  }
}

/**********************************************
 * Couches IGN                                *
 * Remplace avantageusement 663 Ko de lib IGN *
 **********************************************/
/* eslint-disable-next-line no-unused-vars */
class IGNTileLayer extends L.tileLayer {
  constructor(url, paramsIGN, paramsLayer) {
    const params = {
      request: 'GetTile',
      service: 'WMTS',
      version: '1.0.0',
      tilematrixset: 'PM',
      style: 'normal',
      format: 'image/jpeg',
      tilematrix: '{z}',
      tilerow: '{y}',
      tilecol: '{x}',
      ...paramsIGN,
    };

    super(url + Object.entries(params).map(e => e.join('=')).join('&'), {
      bounds: [
        [-75, -180],
        [81, 180],
      ],
      attribution: '<a href="https://www.geoportail.gouv.fr/">IGN Geoportail</a>',
      ...paramsLayer,
    });
  }
}

/*********************************************************
 * Rotating marker to be used in L.Control.Gps           *
 * which indicates the direction in which we are looking *
 *********************************************************/
/* eslint-disable-next-line no-unused-vars */
class MarkerCompass extends L.Marker {
  constructor() {
    // Fix icon
    const iconMarker = L.divIcon({
        iconSize: [16, 16],
        iconAnchor: [8, 8],
        className: '', // To clean default class
        html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" height="16" width="16">\
          <circle cx="8" cy="8" r="6" fill="#ff0" stroke="#f00" stroke-width="2" />\
        </svg>',
      }),

      // Direction icon
      iconCompas = L.divIcon({
        iconSize: [16, 16],
        iconAnchor: [8, 8],
        className: '',
        html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" height="16" width="16">\
          <circle cx="8" cy="8" r="6" fill="#ff0" stroke="#f00" stroke-width="2" />\
          <path d="M0,0 8,1 8,8 1,8" fill="#f00" />\
        </svg>',
      });

    super([0, 0], {
      icon: iconMarker,
    });

    // Rotate the marker following the orientation sensors
    window.addEventListener('deviceorientationabsolute', (evt) => {
      this.heading = evt.alpha || evt.webkitCompassHeading; // Android || iOS

      if (this._icon && this.heading) { // If gps enabled
        // Add the direction to the icon if it is not already done.
        this.setIcon(iconCompas);
        this._icon.style.transformOrigin = 'center';
        this.rotateIcon();
      }
    });
  }

  // Prevents zoom from affecting the marker's direction.
  _setPos(pos) {
    super._setPos(pos);

    if (this.heading)
      this.rotateIcon();
  }

  // Add or replace the icon rotation style
  rotateIcon() {
    this._icon.style.transform =
      this._icon.style.transform.replace(/rotateZ\([^)]+\)/u, '') +
      ' rotateZ(' + (45 - parseInt(this.heading, 10)) + 'deg)';
  }
}

/*****************************
 * Saving the map position   *
 * Lon, lat, zoom, baselayer *
 *****************************/
let positionMemoryArray = []; // For use during the page lifetime.

// Store lon/lat/zoom/baselayer in sessionStorage 
/* eslint-disable-next-line no-unused-vars */
function positionMemoryControl(map) {
  ['baselayerchange', 'zoom', 'moveend'].forEach((evtName) => {
    map.on(evtName, () => {
      const baselayerSelector = document.querySelectorAll('.leaflet-control-layers-base input'),
        pos = map.getCenter();
      let baseLayerName = null;

      for (const lsInputEl of baselayerSelector)
        if (lsInputEl.checked || !baseLayerName)
          baseLayerName = lsInputEl.parentElement.lastChild.innerText.trim();

      // To restart from this position at the next map change
      positionMemoryArray = [
        map.getZoom().toFixed(1),
        pos.lat.toFixed(5),
        pos.lng.toFixed(5),
        encodeURI(baseLayerName),
      ];
      sessionStorage.positionMemory = positionMemoryArray.join('/');

      // To resume from the last position at the start of the next session
      const pa2 = Array.from(positionMemoryArray);
      pa2[0] = Math.max(5, Math.min(10, pa2[0])); // In zoom limits
      localStorage.positionMemory = pa2.join('/');

      // Hides labels for large scales
      map.getContainer().classList[map.getZoom() < 8 ? 'add' : 'remove']('hide-tooltips');
    });
  });
}