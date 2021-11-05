/**
 * This file implements various acces to geoJson services
 * using MyOl/src/layerVector.js
 */

/**
 * Site chemineur.fr, alpages.info
 * subLayer: verbose (full data) | cluster (grouped points) | '' (simplified)
 */
function layerGeoBB(options) {
	return layerVectorCluster(Object.assign({
		host: '//c92.fr/test/chem5/', //TODO+ host: 'chemineur.fr',
		urlFunction: function(options, bbox, selection) {
			return options.host + 'ext/Dominique92/GeoBB/gis.php?limit=10000' +
				'&layer=' + (options.subLayer || 'simple') +
				(options.selectorName ? '&' + (options.argSelName || 'cat') + '=' + selection.join(',') : '') +
				'&bbox=' + bbox.join(',');
		},
		convertProperties: function(properties, feature, options) {
			return {
				icon: properties.type ? options.host + 'ext/Dominique92/GeoBB/icones/' + properties.type + '.svg' : null,
				url: properties.id ? options.host + 'viewtopic.php?t=' + properties.id : null,
				attribution: options.attribution,
			};
		},
		styleOptionsFunction: function(feature, properties) {
			return Object.assign({},
				styleOptionsIcon(properties.icon),
				styleOptionsLabel(properties.name, properties), {
					//BEST BUG autant d'étiquettes que de tronçons de ligne
					// Lines
					stroke: new ol.style.Stroke({
						color: 'blue',
						width: 2,
					}),
				},
				// Polygons with color
				styleOptionsPolygon(properties.color, 0.5)
			);
		},
		hoverStyleOptionsFunction: function(feature, properties) {
			return Object.assign({},
				styleOptionsFullLabel(properties), {
					// Lines
					stroke: new ol.style.Stroke({
						color: 'red',
						width: 3,
					}),
				}
			);
		},
	}, options));
}

/**
 * Site refuges.info
 */
function layerWri(options) {
	return layerVectorCluster(Object.assign({
		host: '//www.refuges.info/',
		nb_points: 'all',
		urlFunction: function(options, bbox, selection) {
			return options.host + 'api/bbox' +
				'?nb_points=' + options.nb_points +
				'&type_points=' + selection.join(',') +
				'&bbox=' + bbox.join(',');
		},
		convertProperties: function(properties, feature, options) {
			return {
				type: properties.type.valeur,
				name: properties.nom,
				icon: options.host + 'images/icones/' + properties.type.icone + '.svg',
				ele: properties.coord.alt,
				capacity: properties.places.valeur,
				url: options.noClick ? null : properties.lien,
				attribution: 'Refuges.info'
			};
		},
		styleOptionsFunction: function(feature, properties) {
			return Object.assign({},
				styleOptionsIcon(properties.icon),
				styleOptionsLabel(properties.nom, properties)
			);
		},
		hoverStyleOptionsFunction: function(feature, properties) {
			return styleOptionsFullLabel(properties);
		},
	}, options));
}

function layerWriAreas(options) {
	return layerVector(Object.assign({
		host: '//www.refuges.info/',
		polygon: 1, // Massifs
		urlFunction: function(options) {
			return options.host + 'api/polygones?type_polygon=' + options.polygon;
		},
		convertProperties: function(properties) {
			return {
				name: properties.nom,
				color: properties.couleur,
				url: properties.lien,
				attribution: null,
			};
		},
		styleOptionsFunction: function(feature, properties) {
			return Object.assign({},
				styleOptionsLabel(properties.name, properties),
				styleOptionsPolygon(properties.color, 0.5)
			);
		},
		hoverStyleOptionsFunction: function(feature, properties) {
			return Object.assign({},
				styleOptionsLabel(properties.name, properties, true),
				styleOptionsPolygon(properties.color, 1)
			);
		},
	}, options));
}

/**
 * Site pyrenees-refuges.com
 */
function layerPyreneesRefuges(options) {
	return layerVectorCluster(Object.assign({
		url: 'https://www.pyrenees-refuges.com/api.php?type_fichier=GEOJSON',
		strategy: ol.loadingstrategy.all,
		convertProperties: function(properties) {
			return {
				type: properties.type_hebergement,
				url: properties.url,
				ele: properties.altitude,
				capacity: properties.cap_ete,
				attribution: 'Pyrenees-Refuges',
			};
		},
		styleOptionsFunction: function(feature, properties) {
			return Object.assign({},
				styleOptionsIconChemineur(properties.type_hebergement),
				styleOptionsLabel(properties.name, properties)
			);
		},
		hoverStyleOptionsFunction: function(feature, properties) {
			return styleOptionsFullLabel(properties);
		},
	}, options));
}

/**
 * Site camptocamp.org
 */
function layerC2C(options) {
	const format = new ol.format.GeoJSON({ // Format of received data
		dataProjection: 'EPSG:3857',
	});

	format.readFeatures = function(json, opts) {
		const features = [],
			objects = JSONparse(json);

		for (let o in objects.documents) {
			const properties = objects.documents[o];

			features.push({
				id: properties.document_id,
				type: 'Feature',
				geometry: JSONparse(properties.geometry.geom),
				properties: {
					type: properties.waypoint_type,
					name: properties.locales[0].title,
					ele: properties.elevation,
					url: '//www.camptocamp.org/waypoints/' + properties.document_id,
					attribution: 'CampToCamp',
				},
			});
		}
		return format.readFeaturesFromObject({
				type: 'FeatureCollection',
				features: features,
			},
			format.getReadOptions(json, opts)
		);
	};

	return layerVectorCluster(Object.assign({
		urlFunction: function(options, bbox, selection, extent) {
			return 'https://api.camptocamp.org/waypoints?bbox=' + extent.join(',');
		},
		format: format,
		styleOptionsFunction: function(feature, properties) {
			return Object.assign({},
				styleOptionsIconChemineur(properties.type),
				styleOptionsLabel(properties.name, properties)
			);
		},
		hoverStyleOptionsFunction: function(feature, properties) {
			return styleOptionsFullLabel(properties);
		},
	}, options));
}

/**
 * OSM XML overpass POI layer
 * From: https://openlayers.org/en/latest/examples/vector-osm.html
 * Doc: http://wiki.openstreetmap.org/wiki/Overpass_API/Language_Guide
 */
//BEST BUG IE SCRIPT5007: Impossible d’obtenir la propriété  « toString » d’une référence null ou non définie (lié à n'appelle pas featuresloadend)
function layerOverpass(options) {
	const format = new ol.format.OSMXML(),
		layer = layerVectorCluster(Object.assign({
			//host: 'overpass-api.de',
			//host: 'lz4.overpass-api.de',
			host: 'overpass.openstreetmap.fr',
			//host: 'overpass.kumi.systems',
			//host: 'overpass.nchc.org.tw',

			urlFunction: urlFunction,
			maxResolution: 50,
			format: format,
			convertProperties: convertProperties,
			styleOptionsFunction: function(feature, properties) {
				return Object.assign({},
					styleOptionsIconChemineur(properties.type),
					styleOptionsLabel(properties.name, properties)
				);
			},
			hoverStyleOptionsFunction: function(feature, properties) {
				return styleOptionsFullLabel(properties);
			},
		}, options)),
		statusEl = document.getElementById(options.selectorName),
		selectorEls = document.getElementsByName(options.selectorName);

	// List of acceptable tags in the request return
	let tags = '';
	for (let e in selectorEls)
		tags += selectorEls[e].value;
	tags = tags.replace('private', '');

	function urlFunction(options, bbox, selection) {
		const bb = '(' + bbox[1] + ',' + bbox[0] + ',' + bbox[3] + ',' + bbox[2] + ');',
			args = [];

		// Convert selections on overpass_api language
		for (let l = 0; l < selection.length; l++) {
			const selections = selection[l].split('+');
			for (let ls = 0; ls < selections.length; ls++)
				args.push(
					'node' + selections[ls] + bb + // Ask for nodes in the bbox
					'way' + selections[ls] + bb // Also ask for areas
				);
		}

		return 'https://' + options.host + '/api/interpreter' +
			'?data=[timeout:5];(' + // Not too much !
			args.join('') +
			');out center;'; // Add center of areas
	}

	// Extract features from data when received
	format.readFeatures = function(doc, opt) {
		// Transform an area to a node (picto) at the center of this area
		for (let node = doc.documentElement.firstElementChild; node; node = node.nextSibling)
			if (node.nodeName == 'way') {
				// Create a new 'node' element centered on the surface
				const newNode = doc.createElement('node');
				newNode.id = node.id;
				doc.documentElement.appendChild(newNode);

				// Browse <way> attributes to build a new node
				for (let subTagNode = node.firstElementChild; subTagNode; subTagNode = subTagNode.nextSibling)
					switch (subTagNode.nodeName) {
						case 'center':
							// Set node attributes
							newNode.setAttribute('lon', subTagNode.getAttribute('lon'));
							newNode.setAttribute('lat', subTagNode.getAttribute('lat'));
							newNode.setAttribute('nodeName', subTagNode.nodeName);
							break;

						case 'tag': {
							// Get existing properties
							newNode.appendChild(subTagNode.cloneNode());

							// Add a tag to mem what node type it was (for link build)
							const newTag = doc.createElement('tag');
							newTag.setAttribute('k', 'nodetype');
							newTag.setAttribute('v', node.nodeName);
							newNode.appendChild(newTag);
						}
					}
			}
		// Status 200 / error message
		else if (node.nodeName == 'remark' && statusEl)
			statusEl.textContent = node.textContent;

		return ol.format.OSMXML.prototype.readFeatures.call(this, doc, opt);
	};

	function convertProperties(properties, feature) {
		for (let p in properties)
			if (tags.indexOf(p) !== -1 && tags.indexOf(properties[p]) !== -1)
				return {
					type: properties[p],
					name: properties.name || properties[p],
					ele: properties.ele,
					capacity: properties.capacity,
					url: 'https://www.openstreetmap.org/node/' + feature.getId(),
					attribution: 'osm',
				};
	}

	return layer;
}