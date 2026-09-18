/* global L, confirm, setInterval, clearInterval */

/***************************************************
 * Personnal adaptations & turn around for leaflet *
 * © Dominique Cavailhez 2026                      *
 ***************************************************/

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

// POINTS D'INTÉRÊT REFUGES.INFO
/* eslint-disable-next-line no-unused-vars */
function wriPOILayer(serveurAPI, type, versionFeatures, hideTooltip) {
  //TODO BUG l'étiquette ne s'affiche que pour les zooms faibles et ne rafraîchit pas après
  const iconList = [],
    poiLayer = L.geoJson(null, {
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

        iconList[feature.properties.type.icone] = true;
      },
    }),
    url = serveurAPI + '/api/bbox?' +
    'nb_points=all&type_points=' + type +
    '&version=' + versionFeatures + '&cache=' + (7 * 24 * 3600);
  //TODO Délai cache api / depuis

  // Fetch remote data
  fetch(url)
    .catch((er) => console.error(er + ' fetching ' + url))
    .then((response) => response.json())
    .then((json) => {
      if (json.features.length) {
        poiLayer.addData(json);
        poiLayer.fire('adddata');

        // Preload icons
        for (const name in iconList)
          document.body.insertAdjacentHTML('beforeend', '<img style="display:none" src="/images/icones/' + name + '.svg"/>')
      }
    });

  return poiLayer;
}

// POLYGONES DE MASSIFS DE REFUGES.INFO
/* eslint-disable-next-line no-unused-vars */
function wriPolygonLayer(serveurAPI, typeId, versionFeatures) {
  const polygonLayer = L.geoJson(null, {
      style: function(feature) {
        return {
          stroke: false,
          color: feature.properties.couleur,
        };
      },
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

        layer.on({
          click: (evt) => {
            location.href = '/nav/' + evt.sourceTarget.feature.id;
          },
        });
      },
    }),
    url = serveurAPI + '/api/polygones?' +
    'type_polygon=' + typeId +
    '&version=' + versionFeatures + '&cache=' + (7 * 24 * 3600); // version tient compte des polygones

  fetch(url)
    .catch((er) => console.error(er + ' fetching ' + url))
    .then((response) => response.json())
    .then((json) => {
      if (json.features.length)
        polygonLayer.addData(json);
    });

  return polygonLayer;
}

/**********************************************
 * Couches IGN                                *
 * Remplace avantageusement 663 Ko de lib IGN *
 **********************************************/
/* eslint-disable-next-line no-unused-vars */
function tileLayerIGN(url, paramsIGN, paramsLayer) {
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

  return L.tileLayer(
    url + Object.entries(params).map(e => e.join('=')).join('&'), {
      bounds: [
        [-75, -180],
        [81, 180],
      ],
      attribution: '<a href="https://www.geoportail.gouv.fr/">IGN Geoportail</a>',
      ...paramsLayer,
    });
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

//DCMM FUTUR HORS RESEAU
/****************************************************
 * Bouton de préchargement des tuiles OpenHikingMap *
 ****************************************************/
const controlPreload = L.control({
  position: 'topleft',
});

controlPreload.onAdd = (map) => {
  const minZoom = 10,
    maxZoom = 16,
    edgeBuffer = 3,
    buttonDiv = L.DomUtil.create('div', 'button-wrapper leaflet-control-preload'),
    avertissement = 'Vous êtes sur le point de précharger le fond de carte OpenHikingMap ' +
    'dans un rayon de ' + (edgeBuffer + 1) + ' largeurs de la carte autour de sa position médiane ' +
    'pour les zooms ' + minZoom + ' à ' + maxZoom + '.\n' +
    'Cela peut engendrer une consommation réseau et mémoire de l\'ordre de 15 Mo.';

  buttonDiv.innerHTML = '<button title="Précharger le fond de carte OpenHikingMap">&#127760;</button>';
  buttonDiv.addEventListener('click', () => {
    if (confirm(avertissement)) {
      const pos = map.getCenter(),
        loadingLayer = L.tileLayer(
          'https://tile.openmaps.fr/openhikingmap/{z}/{x}/{y}.png', {
            edgeBufferTiles: edgeBuffer,
          });

      map.setZoom(minZoom);
      loadingLayer.addTo(map);

      const timer = setInterval(() => {
        if (!loadingLayer.isLoading()) {
          map.setZoom(map.getZoom() + 1);
          localStorage.permalink = minZoom + '/' + pos.lat + '/' + pos.lng + '/OpenHikingMap';

          if (map.getZoom() > maxZoom) {
            clearInterval(timer);
            alert('Téléchargement terminé.\nRéinitialisation de la page.');
            location.reload();
          }
        }
      }, 100);
    };
  });

  return buttonDiv;
};;