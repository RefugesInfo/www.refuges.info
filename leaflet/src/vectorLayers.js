/* global L */

/************************
 * Couches vectorielles *
 * du site refuges.info *
 ************************
  Une icône est une image .png représentant un type de point
  Un point est défini par un position, un nom et une icône destinée à être affiché sur une carte
  Une fiche contient toutes les informations concernant un point, y compris les commentaires

  json est une structure contenant des définitions de points
  geoJson sa représentation en string
*/

//TODO Délai cache api / depuis
// Points d'intérêt refuges.info
/* eslint-disable-next-line no-unused-vars */
function wriPOILayer(serveurAPI, type) {
  const url = serveurAPI + '/api/bbox?nb_points=all&type_points=' + type,
    poiLayer = L.geoJson(null, {
      // Icônes
      pointToLayer: (feature, latlng) =>
        L.marker(latlng, {
          icon: L.icon({
            iconUrl: serveurAPI + '/images/icones/' + feature.properties.type.icone + '.svg',
          }),
        }),

      onEachFeature: (feature, layer) => {
        // Etiquettes
        //TODO BUG ne s'affiche que pour les zooms faibles et ne raffraichi pas après
        layer.bindTooltip(
          feature.properties.nom, {
            permanent: true,
            direction: 'center',
          }
        ).openTooltip();

        layer.on({
          click: () => {
            window.location.href = '/point/' + feature.id;
          },
        });
      },
    });

  // Fetch remote data
  fetch(url)
    .catch((er) => console.error(er + ' fetching ' + url))
    .then((response) => response.json())
    .then((json) => {
      if (json.features.length) {
        poiLayer.addData(json);
        poiLayer.fire('adddata');
      }
    });

  return poiLayer;
}

// Polygones de massifs de refuges.info
/* eslint-disable-next-line no-unused-vars */
function wriPolygonLayer(serveurAPI, typeId) {
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
          window.location.href = '/nav/' + evt.sourceTarget.feature.id;
        },
      });
    },
  });

  fetch(serveurAPI + '/api/polygones?type_polygon=' + typeId)
    .catch((er) => console.error(er + ' fetching ' + serveurAPI + '/api/polygones?type_polygon=1'))
    .then((response) => response.json())
    .then((json) => {
      if (json.features.length)
        polygonLayer.addData(json);
    });

  return polygonLayer;
}