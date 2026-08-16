/* global L */

/************************
 * Couches vectorielles *
 * du site refuges.info *
 ************************
  Une icône est une image .png représentant un type de point
  Un point est défini par une position, un nom et une icône destinée à être affiché sur une carte
  Une fiche contient toutes les informations concernant un point, y compris les commentaires

  json est une structure contenant des définitions de points
  geoJson sa représentation en string

  Le résultat des requêtes API est mis en cache pendant 1 semaine par l'explorateur
  La date de dernière création, édition, suppression de polygone ou point (hors commentaires)
  est fournie à la page HTML qui la passe en argument de l'API pour recharger si nécessaire.
*/

// Points d'intérêt refuges.info
/* eslint-disable-next-line no-unused-vars */
function wriPOILayer(serveurAPI, type, versionFeatures, hideTooltip) {
  //TODO BUG ne s'affiche que pour les zooms faibles et ne rafraîchit pas après
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

// Polygones de massifs de refuges.info
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