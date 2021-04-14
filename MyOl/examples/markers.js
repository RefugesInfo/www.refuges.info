const cadre = layerEditGeoJson({
		displayPointId: 'fix-marker',
		singlePoint: true,
		geoJson: {
			type: 'Point',
			coordinates: [2, 48],
		},
		styleOptions: {
			image: new ol.style.Icon({
				src: 'cadre.png',
			}),
		},
	}),
	viseur = layerEditGeoJson({
		displayPointId: 'drag-marker',
		geoJsonId: 'drag-marker-json',
		dragPoint: true,
		singlePoint: true,
		styleOptions: {
			image: new ol.style.Icon({
				src: 'viseur.png',
			}),
		},
		// Remove FeatureCollection packing of the point
		saveFeatures: function(coordinates, format) {
			return format.writeGeometry(
				new ol.geom.Point(coordinates.points[0]), {
					featureProjection: 'EPSG:3857',
					decimals: 5,
				}
			);
		},
	});
//BEST cadre et viseur SVG / inline

new ol.Map({
	target: 'map',
	layers: [cadre, viseur],
	controls: controlsCollection({
		baseLayers: layersCollection(),
	}),
});