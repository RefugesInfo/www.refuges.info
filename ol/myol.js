/** OPENLAYERS ADAPTATION
 * © Dominique Cavailhez 2017
 * https://github.com/Dominique92/MyOl
 * Based on https://openlayers.org
 *
 * I have designed this openlayers adaptation as simple as possible to make it maintained with basics JS skills
 * You only have to include openlayers/dist.js & .css files & myol.js & .css & that's it !
 * You can use any of these functions independantly (except documented dependencies)
 * No JS classes, no jquery, no es6 modules, no nodejs build, no minification, no npm repository, ... only one file of JS functions & CSS
 * I know, I know, it's not a modern programming method but it's my choice & you're free to take, modifiy & adapt it as you wish
 */

/* jshint esversion: 6 */

//TODO avoid fetch / PWA error on IE
//TODO ranger les blocs dans l'ordre déclaration puis utilisation & noter les dendancies

/**
 * Debug facilities on mobile
 */
// use hash ## for error alerts
if (!window.location.hash.indexOf('##'))
	window.addEventListener('error', function(evt) {
		alert(evt.filename + ' ' + evt.lineno + ':' + evt.colno + '\n' + evt.message);
	});
// use hash ### to route all console logs on alerts
if (window.location.hash == '###')
	console.log = function(message) {
		alert(message);
	};

/**
 * Global openlayers hacks
 */
ol.Map.prototype.renderFrame_ = function(time) {
	//HACK add map_ to each layer
	const map = this;
	map.getLayers().forEach(function(target) {
		target.map_ = map;
	});

	return ol.PluggableMap.prototype.renderFrame_.call(this, time);
};

//HACK log json parsing errors
function JSONparse(json) {
	try {
		return JSON.parse(json);
	} catch (returnCode) {
		console.log(returnCode + ' parsing : "' + json + '" ' + new Error().stack);
	}
}

//HACK IE Object.assign polyfill
// You can also use <script nomodule src="https://cdn.polyfill.io/v3/polyfill.min.js"></script>
if (!Object.assign)
	Object.assign = function() {
		let r = {};
		for (let a in arguments)
			for (let m in arguments[a])
				r[m] = arguments[a][m];
		return r;
	};

/**
 * TILE LAYERS
 */
/**
 * Openstreetmap
 */
function layerOSM(url, attribution, maxZoom) {
	return new ol.layer.Tile({
		source: new ol.source.XYZ({
			url: url,
			maxZoom: maxZoom || 21,
			attributions: [
				attribution || '',
				ol.source.OSM.ATTRIBUTION,
			],
		}),
	});
}

/**
 * Kompas (Austria)
 * Requires layerOSM
 */
function layerKompass(layer) {
	return layerOSM(
		'http://ec{0-3}.cdn.ecmaps.de/WmsGateway.ashx.jpg?' + // Not available via https
		'Experience=ecmaps&MapStyle=' + layer + '&TileX={x}&TileY={y}&ZoomLevel={z}',
		'<a href="http://www.kompass.de/livemap/">KOMPASS</a>'
	);
}

/**
 * Thunderforest
 * Requires layerOSM
 * Get your own (free) THUNDERFOREST key at https://manage.thunderforest.com
 */
function layerThunderforest(key, layer) {
	return layerOSM(
		'//{a-c}.tile.thunderforest.com/' + layer + '/{z}/{x}/{y}.png?apikey=' + key,
		'<a href="http://www.thunderforest.com">Thunderforest</a>'
	);
}

/**
 * Google
 */
function layerGoogle(layer) {
	return new ol.layer.Tile({
		source: new ol.source.XYZ({
			url: '//mt{0-3}.google.com/vt/lyrs=' + layer + '&hl=fr&x={x}&y={y}&z={z}',
			attributions: '&copy; <a href="https://www.google.com/maps">Google</a>',
		})
	});
}

/**
 * Stamen http://maps.stamen.com
 */
function layerStamen(layer) {
	return new ol.layer.Tile({
		source: new ol.source.Stamen({
			layer: layer,
		})
	});
}

/**
 * IGN France
 * Doc on http://api.ign.fr
 * Get your own (free) IGN key at http://professionnels.ign.fr/user
 */
function layerIGN(key, layer, format) {
	let IGNresolutions = [],
		IGNmatrixIds = [];
	for (let i = 0; i < 18; i++) {
		IGNresolutions[i] = ol.extent.getWidth(ol.proj.get('EPSG:3857').getExtent()) / 256 / Math.pow(2, i);
		IGNmatrixIds[i] = i.toString();
	}
	return new ol.layer.Tile({
		source: new ol.source.WMTS({
			url: '//wxs.ign.fr/' + key + '/wmts',
			layer: layer,
			matrixSet: 'PM',
			format: 'image/' + (format || 'jpeg'),
			tileGrid: new ol.tilegrid.WMTS({
				origin: [-20037508, 20037508],
				resolutions: IGNresolutions,
				matrixIds: IGNmatrixIds,
			}),
			style: 'normal',
			attributions: '&copy; <a href="http://www.geoportail.fr/" target="_blank">IGN</a>',
		})
	});
}

/**
 * Spain
 */
function layerSpain(serveur, layer) {
	return new ol.layer.Tile({
		source: new ol.source.XYZ({
			url: '//www.ign.es/wmts/' + serveur + '?layer=' + layer +
				'&Service=WMTS&Request=GetTile&Version=1.0.0&Format=image/jpeg' +
				'&style=default&tilematrixset=GoogleMapsCompatible' +
				'&TileMatrix={z}&TileCol={x}&TileRow={y}',
			attributions: '&copy; <a href="http://www.ign.es/">IGN España</a>',
		})
	});
}

/**
 * Layers with not all resolutions or area available
 * Virtual class
 * Displays Stamen outside the layer zoom range or extend
 * Requires HACK map_
 */
function layerTileIncomplete(options) {
	const layer = options.extraLayer || layerStamen('terrain');
	options.sources[999999] = layer.getSource(); // Add extrabound source on the top of the list

	layer.once('prerender', function() {
		if (typeof options.addSources == 'function')
			options.sources = Object.assign(
				options.sources,
				options.addSources()
			);
		layer.map_.getView().on('change:resolution', change);
		change(); // At init
	});

	// Zoom has changed
	function change() {
		const view = layer.map_.getView();
		let currentResolution = 999999; // Init loop at max resolution

		// Search for sources according to the map resolution
		if (ol.extent.intersects(options.extent, view.calculateExtent(layer.map_.getSize())))
			currentResolution = Object.keys(options.sources).filter(function(evt) { //HACK : use of filter to perform an action
				return evt > view.getResolution();
			})[0];

		// Update layer if necessary
		if (layer.getSource() != options.sources[currentResolution])
			layer.setSource(options.sources[currentResolution]);
	}
	return layer;
}

/**
 * Swisstopo https://api.geo.admin.ch/
 * Register your domain: https://shop.swisstopo.admin.ch/fr/products/geoservice/swisstopo_geoservices/WMTS_info
 * Requires layerTileIncomplete
 */
function layerSwissTopo(layer, extraLayer) {
	const projectionExtent = ol.proj.get('EPSG:3857').getExtent();
	let resolutions = [],
		matrixIds = [];
	for (let r = 0; r < 18; ++r) {
		resolutions[r] = ol.extent.getWidth(projectionExtent) / 256 / Math.pow(2, r);
		matrixIds[r] = r;
	}
	return layerTileIncomplete({
		extraLayer: extraLayer,
		extent: [664577, 5753148, 1167741, 6075303], // EPSG:21781 (Swiss CH1903 / LV03)
		sources: {
			500: new ol.source.WMTS(({
				crossOrigin: 'anonymous',
				url: '//wmts2{0-4}.geo.admin.ch/1.0.0/' + layer + '/default/current/3857/{TileMatrix}/{TileCol}/{TileRow}.jpeg',
				tileGrid: new ol.tilegrid.WMTS({
					origin: ol.extent.getTopLeft(projectionExtent),
					resolutions: resolutions,
					matrixIds: matrixIds,
				}),
				requestEncoding: 'REST',
				attributions: '&copy <a href="https://map.geo.admin.ch/">SwissTopo</a>',
			}))
		},
	});
}

/**
 * Italy IGM
 * Requires layerTileIncomplete
 */
function layerIGM() {
	function igmSource(url, layer) {
		return new ol.source.TileWMS({
			url: 'http://wms.pcn.minambiente.it/ogc?map=/ms_ogc/WMS_v1.3/raster/' + url + '.map',
			params: {
				layers: layer,
			},
			attributions: '&copy <a href="http://www.pcn.minambiente.it/viewer">IGM</a>',
		});
	}
	return layerTileIncomplete({
		extent: [660124, 4131313, 2113957, 5958411], // EPSG:6875 (Italie)
		sources: {
			100: igmSource('IGM_250000', 'CB.IGM250000'),
			25: igmSource('IGM_100000', 'MB.IGM100000'),
			5: igmSource('IGM_25000', 'CB.IGM25000'),
		},
	});
}

/**
 * Ordnance Survey : Great Britain
 * Requires layerTileIncomplete
 * Get your own (free) key at http://www.ordnancesurvey.co.uk/business-and-government/products/os-openspace/
 */
function layerOS(key) {
	return layerTileIncomplete({
		extent: [-841575, 6439351, 198148, 8589177], // EPSG:27700 (G.B.)
		sources: {},
		addSources: function() { //HACK : Avoid to call https://dev.virtualearth.net/... if no bing layer is required
			return {
				75: new ol.source.BingMaps({
					imagerySet: 'OrdnanceSurvey',
					key: key,
				})
			};
		},
	});
}

/**
 * Bing (Microsoft)
 * Get your own (free) BING key at https://www.microsoft.com/en-us/maps/create-a-bing-maps-key
 */
function layerBing(key, subLayer) {
	const layer = new ol.layer.Tile();

	//HACK : Avoid to call https://dev.virtualearth.net/... if no bing layer is required
	layer.once('change:opacity', function() {
		if (layer.getVisible() && !layer.getSource()) {
			layer.setSource(new ol.source.BingMaps({
				imagerySet: subLayer,
				key: key,
			}));
		}
	});
	return layer;
}


/**
 * VECTORS, GEOJSON & AJAX LAYERS
 */
/**
 * Popup label
 * Manages a feature hovering per map common to all features & layers
 */
function popupLabel(map) {
	if (!map.popupLabel_) { // Only one per map
		const element = document.createElement('div'),
			popup = map.popupLabel_ = new ol.Overlay({
				element: element,
			}),
			viewStyle = map.getViewport().style;
		map.addOverlay(popup);

		// Go to feature.property.link when click on the feature (icon or area)
		map.on('click', function(evt) {
			let done = false;
			evt.target.forEachFeatureAtPixel(
				evt.pixel,
				function(feature) {
					if (done) return;
					done = true;
					const link = feature.getProperties().link;
					if (link) {
						if (evt.pointerEvent.ctrlKey) {
							var win = window.open(link, '_blank');
							if (evt.pointerEvent.shiftKey)
								win.focus();
						} else
							window.location = link;
					}
				}
			);
		});

		let hoveredFeature = null;
		map.on('pointermove', function(evt) {
			let nbFeaturesAtPixel = 0;
			map.forEachFeatureAtPixel(
				evt.pixel,
				function(feature, layer) {
					if (feature.getKeys().length > 1 && // Avoid doubled feature (E.G. style changed)
						!(nbFeaturesAtPixel++) && // Only the first hovered
						(!hoveredFeature || feature.ol_uid != hoveredFeature.ol_uid)) { // The feature has changed
						deselectFeature();
						selectFeature(feature, layer, evt.pixel);
						hoveredFeature = feature;
						hoveredFeature.layer_ = layer;
					}
				}
			);
			if (!nbFeaturesAtPixel && hoveredFeature)
				deselectFeature();
		});

		//TODO Function declarations should not be placed in blocks.
		// Hide popup when the cursor is out of the map
		window.addEventListener('mousemove', function(evtMm) {
			const divRect = map.getTargetElement().getBoundingClientRect();
			if (evtMm.clientX < divRect.left || evtMm.clientX > divRect.right ||
				evtMm.clientY < divRect.top || evtMm.clientY > divRect.bottom)
				deselectFeature();
		});

		function selectFeature(feature, layer, pixel) {
			// Change the cursor
			//TODO BUG pointer on the label (but no click)
			const properties = feature.getProperties();
			if (properties.link)
				viewStyle.cursor = 'pointer';
			if (properties.draggable)
				viewStyle.cursor = 'move';

			if (layer && layer.options) {
				element.className = 'myol-popup';

				// Apply layer hover style to the feature
				feature.setStyle(escapedStyle(
					layer.options.styleOptions,
					layer.options.hoverStyleOptions,
					layer.options.editStyleOptions
				));

				// Set the text & label position
				element.innerHTML = formatLabel(
					layer.options.label,
					'<br/>',
					properties,
					feature
				);
				let geometry = feature.getGeometry();

				// If it's a GeometryCollection, take the fisrt feature
				if (typeof geometry.getGeometries == 'function')
					geometry = geometry.getGeometries()[0];

				// If it's a point, the icon is stable above it
				if (geometry.flatCoordinates.length == 2)
					pixel = map.getPixelFromCoordinate(geometry.flatCoordinates);

				//TODO BUG quelquefois, ne mesure pas la bonne étiquette
				// Shift of the label to stay into the map regarding the pointer position
				if (pixel[1] < element.clientHeight + 12) { // On the top of the map (not enough space for it)
					pixel[0] += pixel[0] < map.getSize()[0] / 2 ? 10 : -element.clientWidth - 10;
					pixel[1] = 2;
				} else {
					pixel[0] -= element.clientWidth / 2;
					pixel[0] = Math.max(pixel[0], 0); // Bord gauche
					pixel[0] = Math.min(pixel[0], map.getSize()[0] - element.clientWidth - 1); // Bord droit
					pixel[1] -= element.clientHeight + 8;
				}
				popup.setPosition(map.getCoordinateFromPixel(pixel));
			}
		}

		function deselectFeature() {
			if (hoveredFeature) {
				viewStyle.cursor = 'default';
				element.className = 'myol-popup-hidden';
				const layer = hoveredFeature.layer_;
				if (layer && layer.options)
					hoveredFeature.setStyle(escapedStyle(layer.options.styleOptions));
				hoveredFeature = null;
			}
		}

		function formatLabel(format, closure, properties, feature) {
			if (typeof format == 'function')
				format = formatLabel(
					format(properties, feature),
					closure, properties, feature
				);

			if (typeof format == 'object') {
				// Links
				if (closure == 'link')
					return '<a href="' + format.link + '">' + format.name + '</a>';

				// List of closure: object
				let items = [];
				for (let f in format)
					items.push(formatLabel(
						format[f], f,
						properties, feature
					));
				return items
					.filter(function(a) { // Purge empty items
						return a;
					})
					.join(closure);
			}
			// Number with unit
			const n = parseInt(format);
			if (n)
				return n + closure;

			// Other string
			return format ? format.toString() : '';
		}
	}
	return map.popupLabel_;
}

/**
 * Marker
 * Requires JSONparse, popupLabel, HACK map_, proj4.js for swiss coordinates
 * Read / write following fields :
 * marker-json : {"type":"Point","coordinates":[2.4,47.082]}
 * marker-lon / marker-lat
 * marker-x / marker-y : CH 1903 (wrapped with marker-xy)
 * marker-center-cursor : onclick = center the cursor at the middle of the map
 * marker-center-map : onclick = center the map on the cursor position
 */
function layerMarker(o) {
	const options = Object.assign({
			llInit: [],
			idDisplay: 'marker',
			decimalSeparator: '.',
		}, o),
		elJson = document.getElementById(options.idDisplay + '-json'),
		elLon = document.getElementById(options.idDisplay + '-lon'),
		elLat = document.getElementById(options.idDisplay + '-lat'),
		elX = document.getElementById(options.idDisplay + '-x'),
		elY = document.getElementById(options.idDisplay + '-y'),
		elCenterMarker = document.getElementById(options.idDisplay + '-center-marker'),
		elCenterMap = document.getElementById(options.idDisplay + '-center-map');

	// Use json field values if any
	if (elJson) {
		let json = elJson.value || elJson.innerHTML;
		if (json)
			options.llInit = JSONparse(json).coordinates;
	}
	// Use lon-lat fields values if any
	if (elLon && elLat) {
		const lon = parseFloat(elLon.value || elLon.innerHTML),
			lat = parseFloat(elLat.value || elLat.innerHTML);
		if (lon && lat)
			options.llInit = [lon, lat];
	}

	// The marker layer
	const style = new ol.style.Style({
			image: new ol.style.Icon(({
				src: options.imageUrl,
				anchor: [0.5, 0.5],
			})),
		}),
		point = new ol.geom.Point(
			ol.proj.fromLonLat(options.llInit)
		),
		feature = new ol.Feature({
			geometry: point,
			draggable: options.draggable,
		}),
		source = new ol.source.Vector({
			features: [feature],
		}),
		layer = new ol.layer.Vector({
			source: source,
			style: style,
			zIndex: 10,
		}),
		format = new ol.format.GeoJSON();

	//TODO BUG n'est pas enabled si on ne voit pas le feature !
	layer.once('prerender', function() {
		const map = layer.map_;
		popupLabel(map); // Attach tracking for cursor changes

		if (options.draggable) {
			// Drag the feature
			map.addInteraction(new ol.interaction.Modify({
				features: new ol.Collection([feature]),
				pixelTolerance: 16, // The circle around the center
				style: style, // Avoid to add interaction default style
			}));

			// Change text input values
			point.on('change', function() {
				displayLL(point.getCoordinates());
			});

			// GPS position changed
			map.on('myol:ongpsposition', function(evt) {
				point.setCoordinates(evt.position);
			});

			// Map control buttons
			if (elCenterMarker)
				elCenterMarker.onclick = function() {
					point.setCoordinates(map.getView().getCenter());
				};
			else map.addControl(controlButton({
				label: '\u29BB',
				title: 'Déplacer le curseur au centre de la carte',
				activate: function() {
					point.setCoordinates(map.getView().getCenter());
				},
			}));
			if (elCenterMarker)
				elCenterMap.onclick = function() {
					map.getView().setCenter(point.getCoordinates());
				};
			else map.addControl(controlButton({
				label: '\u26DE',
				title: 'Centrer la carte sur le curseur',
				activate: function() {
					map.getView().setCenter(point.getCoordinates());
				},
			}));
		}
	});

	// <input> coords edition
	function fieldEdit(evt) {
		const id = evt.target.id.split('-')[1], // Get second part of the field id
			pars = {
				lon: [0, 4326],
				lat: [1, 4326],
				x: [0, 21781],
				y: [1, 21781],
			},
			nol = pars[id][0], // Get what coord is concerned (x, y)
			projection = pars[id][1]; // Get what projection is concerned
		// Get initial position
		let coord = ol.proj.transform(point.getCoordinates(), 'EPSG:3857', 'EPSG:' + projection);
		// We change the value that was edited
		coord[nol] = parseFloat(evt.target.value.replace(',', '.'));
		// Set new position
		point.setCoordinates(ol.proj.transform(coord, 'EPSG:' + projection, 'EPSG:3857'));

		// Center map to the new position
		layer.map_.getView().setCenter(point.getCoordinates());
	}

	// Display a coordinate
	//BEST dispach/edit deg min sec
	function displayLL(ll) {
		const ll4326 = ol.proj.transform(ll, 'EPSG:3857', 'EPSG:4326'),
			values = {
				lon: (Math.round(ll4326[0] * 100000) / 100000).toString().replace('.', options.decimalSeparator),
				lat: (Math.round(ll4326[1] * 100000) / 100000).toString().replace('.', options.decimalSeparator),
				json: JSON.stringify(format.writeGeometryObject(point, {
					featureProjection: 'EPSG:3857',
					decimals: 5
				}))
			};

		// Specific Swiss coordinates EPSG:21781 (CH1903 / LV03)
		if (typeof proj4 == 'function') {
			proj4.defs('EPSG:21781', '+proj=somerc +lat_0=46.95240555555556 +lon_0=7.439583333333333 +k_0=1 +x_0=600000 +y_0=200000 +ellps=bessel +towgs84=660.077,13.551,369.344,2.484,1.783,2.939,5.66 +units=m +no_defs');
			ol.proj.proj4.register(proj4);
		}
		// Specific Swiss coordinates EPSG:21781 (CH1903 / LV03)
		if (typeof proj4 == 'function' &&
			ol.extent.containsCoordinate([664577, 5753148, 1167741, 6075303], ll)) { // Si on est dans la zone suisse EPSG:21781
			const c21781 = ol.proj.transform(ll, 'EPSG:3857', 'EPSG:21781');
			values.x = Math.round(c21781[0]);
			values.y = Math.round(c21781[1]);
		}
		// Mask xy swiss if nothing to write
		if (elX)
			elX.parentNode.style.display = values.x ? '' : 'none';
		if (elY)
			elY.parentNode.style.display = values.y ? '' : 'none';

		// We insert the resulting HTML string where it is going
		for (let postId in values) {
			const el = document.getElementById(options.idDisplay + '-' + postId);
			if (el) {
				el.onchange = fieldEdit; // Set the change function
				if (el.value !== undefined)
					el.value = values[postId];
				else
					el.innerHTML = values[postId];
			}
		}
	}
	displayLL(ol.proj.fromLonLat(options.llInit)); // Display once at init

	return layer;
}

// Mem in cookies the checkbox content with name="selectorName"
function controlPermanentCheckbox(selectorName, callback) {
	const checkEls = document.getElementsByName(selectorName),
		cookie = location.hash.match('map-' + selectorName + '=([^#,&;]*)') || // Priority to the hash
		document.cookie.match('map-' + selectorName + '=([^;]*)'); // Then the cookie

	for (let e = 0; e < checkEls.length; e++) {
		checkEls[e].addEventListener('click', permanentCheckboxClick); // Attach the action
		if (cookie) // Set the checks accordingly with the cookie
			checkEls[e].checked = cookie[1].split(',').indexOf(checkEls[e].value) !== -1;
	}

	function permanentCheckboxClick(evt) {
		if (typeof callback == 'function')
			callback(evt, permanentCheckboxList(selectorName, evt));
	}
	callback(null, permanentCheckboxList(selectorName)); // Call callback once at the init
}

/**
 * List selected checkboxes having the same name
 * selectorName (string)
 * evt (keyboard event)
 * return : [checked values or ids]
 */
//TODO BUG read first before modifying layers
function permanentCheckboxList(selectorName, evt) {
	const checkEls = document.getElementsByName(selectorName);
	let allChecks = [];

	for (let e = 0; e < checkEls.length; e++) {
		// Select/deselect all (clicking an <input> without value)
		if (evt) {
			if (evt.target.value == 'on') // The Select/deselect has a default value = "on"
				checkEls[e].checked = evt.target.checked; // Check all if "all" is clicked
			else if (checkEls[e].value == 'on')
				checkEls[e].checked = false; // Reset the "all" checks if another check is clicked
		}

		// Get status of all checks
		if (checkEls[e].checked) // List checked elements
			allChecks.push(checkEls[e].value);
	}
	// Mem the related cookie / Keep empty one to keep memory of cancelled subchoices
	document.cookie = 'map-' + selectorName + '=' + allChecks.join(',') + ';path=/; SameSite=Strict';
	return allChecks; // Returns list of checked values or ids
}

/**
 * Compute a style from 2 different style
 * return ol.style.Style containing each style component or ol default
 */
function escapedStyle(a, b, c) {
	const defaultStyle = new ol.layer.Vector().getStyleFunction()()[0];
	return function(feature) {
		return new ol.style.Style(Object.assign({
				fill: defaultStyle.getFill(),
				stroke: defaultStyle.getStroke(),
				image: defaultStyle.getImage(),
			},
			typeof a == 'function' ? a(feature.getProperties()) : a,
			typeof b == 'function' ? b(feature.getProperties()) : b,
			typeof c == 'function' ? c(feature.getProperties()) : c
		));
	};
}


/**
 * BBOX strategy when the url return a limited number of features depending on the extent
 */
ol.loadingstrategy.bboxLimit = function(extent, resolution) {
	if (this.bboxLimitResolution > resolution) // When zoom in
		this.loadedExtentsRtree_.clear(); // Force the loading of all areas
	this.bboxLimitResolution = resolution; // Mem resolution for further requests
	return [extent];
};

/**
 * GeoJson POI layer
 * Requires controlPermanentCheckbox, popupLabel, JSONparse, HACK map_
 * permanentCheckboxList, loadingStrategyBboxLimit & escapedStyle
 */
function layerVectorURL(options) {
	options = Object.assign({ //TODO DELETE
		TOTO: function(arg) {
			return arg;
		},
	}, options);
	options = Object.assign({
		serverUrl: '', // Url prefix to be defined separately from the rest (E.G. server domain and/or directory)
		baseUrl: null, // Url of the service (mandatory)
		baseUrlFunction: function(bbox, list) {
			return options.serverUrl + options.baseUrl + // baseUrl is mandatory, no default
				list.join(',') + '&bbox=' + bbox.join(','); // Default most common url format
		},
		selectorName: '', // Id of a <select> to tune url optional parameters
		projection: 'EPSG:4326', // Projection of received data
	}, options);
	options = Object.assign({
		format: new ol.format.GeoJSON({ // Format of received data
			dataProjection: options.projection,
		}),
		// Modification of the Json object after reception & before geoJson analysis
		receiveJson: function(object) {
			return object;
		},
		// Modification of the properties of the features during the geoJson analysis
		receiveProperty: function( /*property*/ ) {
			return {}; /*new properties*/ 
		},
		styleOptions: null, // ol.style.Style of function of the displayed features
		// Label to dispach above the feature when hovering
		// - String
		// - Array of lines to be separated by <br/>
		// - Structure {'join': {array to be separated by 'join'},...}
		label: function(properties) {
			return {
				link: properties, // By default : properties.name / click to properties.link
			};
		},
		// All ol.source.Vector options
		// All ol.layer.Vector options
	}, options);

	//HACK overwrite ol.format.GeoJSON.readFeatures
	if (options.format.readFeaturesFromObject) // If format = GeoJSON
		options.format.readFeatures = function(json, opts) {
			if (options.strategy == ol.loadingstrategy.bboxLimit) // If we can have more features when zomming in
				source.clear(); // Clean all features when receiving a request
			return options.format.readFeaturesFromObject(
				options.receiveJson(
					JSONparse(json) // Log Json errors
				),
				options.format.getReadOptions(json, opts)
			);
		};

	const source = new ol.source.Vector(Object.assign({
			url: function(extent, resolution, projection) {
				const bbox = ol.proj.transformExtent(
						extent,
						projection.getCode(),
						options.projection
					),
					// Retreive checked parameters
					list = permanentCheckboxList(options.selectorName).
				filter(function(evt) { // selectorName optional
					return evt !== 'on'; // Remove the "all" input (default value = "on")
				});
				return options.baseUrlFunction(bbox, list, resolution);
			},
		}, options)),

		layer = new ol.layer.Vector(Object.assign({
			source: source,
			style: escapedStyle(options.styleOptions),
			renderBuffer: 16, // buffered area around curent view (px)
			zIndex: 1, // Above the baselayer even if included to the map before
		}, options));
	layer.options = options;

	// Checkboxes to tune layer parameters
	if (options.selectorName)
		controlPermanentCheckbox(
			options.selectorName,
			function(evt, list) {
				layer.setVisible(list.length);
				if (list.length && source.loadedExtentsRtree_) {
					source.loadedExtentsRtree_.clear(); // Force the loading of all areas
					source.clear(); // Redraw the layer
				}
			}
		);

	layer.once('prerender', function(evt) {
		popupLabel(evt.target.map_); // Attach tracking for labeling & cursor changes
	});

	// Change properties at reception
	//TODO BUG too long with lines & polygons
	source.on('addfeature', function(evt) {
		evt.feature.setProperties(
			options.receiveProperty(
				evt.feature.getProperties()));
	});

	return layer;
}

// Convert features type into gpx <sym>
function getSym(type) {
	const lex =
		// https://forums.geocaching.com/GC/index.php?/topic/277519-garmin-roadtrip-waypoint-symbols/
		'<Residence> refuge hotel gite chambre_hote' +
		'<Lodge> cabane cabane_cle buron alpage shelter' +
		' cabane ouverte mais ocupee par le berger l ete' +
		'<Fishing Hot Spot Facility> abri hut' +
		'<Campground> camping camp_site bivouac orri toue abri en pierre' +
		'<Crossing> ferme ruine batiment-inutilisable cabane fermee' +
		'<Drinking Water> point_eau waterpoint waterfall' +
		'<Water Source> lac lake' +
		'<Summit> sommet summit climbing_indoor climbing_outdoor bisse' +
		'<Flag, Red> col pass' +
		'<Parking Area> access' +
		'<City Hall> locality' +
		'<Reef> grotte cave glacier' +
		'<Shopping Center> local_product ravitaillement buffet restaurant' +
		'<Telephone> telephone wifi reseau',
		//' canyon slackline_spot paragliding_takeoff paragliding_landing virtual webcam

		match = lex.match(new RegExp('<([^>]*)>[^>]* ' + type));
	return match ? match[1] : 'Puzzle Cache';
}

/**
 * www.refuges.info POI layer
 * Requires layerVectorURL
 */
function layerRefugesInfo(o) {
	const options = Object.assign({
		serverUrl: '//www.refuges.info/',
		//		baseUrl: 'api/bbox?format=gpx&type_points=',//TODO DELETE
		baseUrl: 'api/bbox?type_points=',
		strategy: ol.loadingstrategy.bboxLimit,
		receiveProperty: function(property) {
			return {
				name: property.nom,
				ele: property.coord.alt,
				link: property.lien,
			};
		},
		styleOptions: function(properties) {
			return {
				image: new ol.style.Icon({
					src: options.serverUrl + 'images/icones/' + properties.type.icone + '.png'
				})
			};
		},
		label: function(properties) {
			return {
				link: properties,
				', ': {
					m: properties.coord.alt,
					' \u255E\u2550\u2555': properties.places.valeur,
				},
				'': '&copy;refuges.info',
			};
		},
	}, o);
	return layerVectorURL(options); //TODO inline
}

/**
 * pyrenees-refuges.com POI layer
 * Requires layerVectorURL
 */
function layerPyreneesRefuges(options) {
	return layerVectorURL(Object.assign({
		url: 'https://www.pyrenees-refuges.com/api.php?type_fichier=GEOJSON',
		receiveProperty: function(property) {
			return {
				ele: parseInt(property.altitude),
				link: property.url,
				sym: getSym(property.type_hebergement),
			};
		},
		styleOptions: function(properties) {
			return {
				image: new ol.style.Icon({
					src: '//dc9.fr/chemineur/ext/Dominique92/GeoBB/types_points/' + properties.sym + '.png',
				}),
			};
		},
		label: function(properties) {
			return {
				link: properties,
				', ': {
					m: properties.ele,
					' \u255E\u2550\u2555': properties.cap_ete,
				},
				type: properties.type_hebergement,
				copy: ' &copy;pyrenees-refuges.com',
			};
		},
	}, options));
}

/**
 * www.camptocamp.org POI layer
 * Requires layerVectorURL, getSym
 */
function layerC2C(options) {
	return layerVectorURL(Object.assign({
		baseUrl: 'https://api.camptocamp.org/waypoints?limit=200', // https mandatory for Access-Control-Allow-Origin
		strategy: ol.loadingstrategy.bboxLimit,
		projection: 'EPSG:3857',

		receiveJson: function(objects) {
			const features = [];
			for (let o in objects.documents) {
				const object = objects.documents[o];
				features.push({
					id: object.document_id,
					type: 'Feature',
					geometry: JSONparse(object.geometry.geom),
					properties: { //TODO completely to be developped
						ele: object.elevation,
						name: object.locales[0].title,
						type: object.waypoint_type,
						sym: getSym(object.waypoint_type),
						link: 'https://www.camptocamp.org/waypoints/' + object.document_id,
					},
				});
			}
			return {
				type: 'FeatureCollection',
				features: features,
			};
		},
		styleOptions: function(properties) {
			return {
				image: new ol.style.Icon({
					src: '//dc9.fr/chemineur/ext/Dominique92/GeoBB/types_points/' + properties.sym + '.png',
				})
			};
		},
		label: function(properties) {
			return {
				link: properties,
				'': properties.type + ' &copy;c2c',
			};
		},
	}, options));
}

/**
 * chemineur.fr POI layer
 * Requires layerVectorURL
 */
function layerChemineur(options) {
	return layerVectorURL(Object.assign({
		baseUrl: '//dc9.fr/chemineur/ext/Dominique92/GeoBB/gis.php?site=this&poi=3,8,16,20,23,28,30,40,44,64,58,62,65',
		strategy: ol.loadingstrategy.bboxLimit,
		receiveProperty: function(property) {
			return {
				name: property.nom,
				link: property.url,
				sym: getSym(property.icone),
			};
		},
		styleOptions: function(properties) {
			return {
				// POI
				image: new ol.style.Icon({
					src: properties.icone,
				}),
				// Traces
				stroke: new ol.style.Stroke({
					color: 'blue',
					width: 3,
				}),
			};
		},
		label: function(properties) {
			return {
				link: properties,
				'': '&copy;chemineur.fr',
			};
		},
		//TODO BUG don't work with object
		//TODO dont display traces the first time
		/*hoverStyleOptions: new ol.style.Stroke({
			color: 'red',
			width: 3,
		}),*/
		hoverStyleOptions: function() {
			return {
				stroke: new ol.style.Stroke({
					color: 'red',
					width: 3,
				})
			};
		},
	}, options));
}

/**
 * OSM overpass POI layer
 * From: https://openlayers.org/en/latest/examples/vector-osm.html
 * Doc: http://wiki.openstreetmap.org/wiki/Overpass_API/Language_Guide
 * Requires layerVectorURL
 */
//TODO WRI NAV OVERPASS Hôtels et locations, camping Campings, ravitaillement Alimentation, parking Parkings, arrêt de bus Bus
//BEST BUG IE OVERPASS don't work on IE
//BEST OVERPASS display errors, including 429 (Too Many Requests) - ol/featureloader.js / needs FIXME handle error
layerOverpass = function(options) {
	options = Object.assign({
		baseUrl: '//overpass-api.de/api/interpreter',
		maxResolution: 30, // Only call overpass if the map's resolution is lower
		selectorId: 'overpass', // Element containing all checkboxes
		selectorName: 'overpass', // Checkboxes
		labelClass: 'label-overpass',
		iconUrlPath: '//dc9.fr/chemineur/ext/Dominique92/GeoBB/types_points/',
	}, options);
	const checkEls = document.getElementsByName(options.selectorName);

	// Convert areas into points to display it as an icon
	function readFeaturesOverpass(response) {
		for (let node = response.documentElement.firstChild; node; node = node.nextSibling)
			if (node.nodeName == 'way') {
				// Create a new 'node' element centered on the surface
				const newNode = response.createElement('node');
				response.documentElement.appendChild(newNode);
				newNode.id = node.id;

				// Add a tag to mem what node type it was
				const newTag = response.createElement('tag');
				newTag.setAttribute('k', 'nodetype');
				newTag.setAttribute('v', 'way');
				newNode.appendChild(newTag);

				for (let subTagNode = node.firstChild; subTagNode; subTagNode = subTagNode.nextSibling)
					switch (subTagNode.nodeName) {
						case 'center':
							newNode.setAttribute('lon', subTagNode.getAttribute('lon'));
							newNode.setAttribute('lat', subTagNode.getAttribute('lat'));
							newNode.setAttribute('nodeName', subTagNode.nodeName);
							break;
						case 'tag':
							newNode.appendChild(subTagNode.cloneNode());
					}
			}
		return response;
	}

	function overpassType(properties) {
		for (let e = 0; e < checkEls.length; e++)
			if (checkEls[e].checked) {
				const tags = checkEls[e].value.split('+');
				for (let t = 0; t < tags.length; t++) {
					const conditions = tags[t].split('"');
					if (properties[conditions[1]] &&
						properties[conditions[1]].match(conditions[3]))
						return checkEls[e].id;
				}
			}
		return 'inconnu';
	}

	return layerVectorURL(Object.assign({
		strategy: ol.loadingstrategy.bbox,
		format: new ol.format.OSMXML(),
		readFeatures: readFeaturesOverpass,
		styleOptions: function(properties) {
			return {
				image: new ol.style.Icon({
					src: options.iconUrlPath + overpassType(properties) + '.png'
				})
			};
		},
		baseUrlFunction: function(bbox, list) {
			const bb = '(' + bbox[1] + ',' + bbox[0] + ',' + bbox[3] + ',' + bbox[2] + ');',
				args = [];

			for (let l = 0; l < list.length; l++) {
				const lists = list[l].split('+');
				for (let ls = 0; ls < lists.length; ls++)
					args.push(
						'node' + lists[ls] + bb + // Ask for nodes in the bbox
						'way' + lists[ls] + bb // Also ask for areas
					);
			}

			return options.baseUrl +
				'?data=[timeout:5];(' + // Not too much !
				args.join('') +
				');out center;'; // add center of areas
		},
		label: function(p, f) { // properties, feature
			p.name = p.name || p.alt_name || p.short_name || '';
			const language = {
					alpine_hut: 'Refuge gard&egrave;',
					hotel: 'h&ocirc;tel',
					guest_house: 'chambre d‘h&ocirc;te',
					camp_site: 'camping',
					convenience: 'alimentation',
					supermarket: 'supermarch&egrave;',
					drinking_water: 'point d&apos;eau',
					watering_place: 'abreuvoir',
					fountain: 'fontaine',
					telephone: 't&egrave;l&egrave;phone',
					shelter: ''
				},
				phone = p.phone || p['contact:phone'],
				address = [
					p.address,
					p['addr:housenumber'], p.housenumber,
					p['addr:street'], p.street,
					p['addr:postcode'], p.postcode,
					p['addr:city'], p.city
				],
				popup = [
					'<b>' + p.name.charAt(0).toUpperCase() + p.name.slice(1) + '</b>', [
						'<a target="_blank"',
						'href="http://www.openstreetmap.org/' + (p.nodetype ? p.nodetype : 'node') + '/' + f.getId() + '"',
						'title="Voir la fiche d‘origine sur openstreetmap">',
						p.name ? (
							p.name.toLowerCase().match(language[p.tourism] || 'azertyuiop') ? '' : p.tourism
						) : (
							language[p.tourism] || p.tourism
						),
						'*'.repeat(p.stars),
						p.shelter_type == 'basic_hut' ? 'Abri' : '',
						p.building == 'cabin' ? 'Cabane non gard&egrave;e' : '',
						p.highway == 'bus_stop' ? 'Arr&ecirc;t de bus' : '',
						p.waterway == 'water_point' ? 'Point d&apos;eau' : '',
						p.natural == 'spring' ? 'Source' : '',
						p.man_made == 'water_well' ? 'Puits' : '',
						p.shop ? 'alimentation' : '',
						typeof language[p.amenity] == 'string' ? language[p.amenity] : p.amenity,
						'</a>'
					].join(' '), [
						p.rooms ? p.rooms + ' chambres' : '',
						p.beds ? p.beds + ' lits' : '',
						p.place ? p.place + ' places' : '',
						p.capacity ? p.capacity + ' places' : '',
						p.ele ? parseInt(p.ele, 10) + 'm' : ''
					].join(' '),
					phone ? '&phone;<a title="Appeler" href="tel:' + phone.replace(/[^0-9+]+/ig, '') + '">' + phone + '</a>' : '',
					p.email ? '&#9993;<a title="Envoyer un mail" href="mailto:' + p.email + '">' + p.email + '</a>' : '',
					p['addr:street'] ? address.join(' ') : '',
					p.website ? '&#8943;<a title="Voir le site web" target="_blank" href="' + p.website + '">' + (p.website.split('/')[2] || p.website) + '</a>' : '',
					p.opening_hours ? 'ouvert ' + p.opening_hours : '',
					p.note ? p.note : ''
				];

			// Other paramaters
			const done = [ // These that have no added value or already included
				'geometry,lon,lat,area,amenity,building,highway,shop,shelter_type,access,waterway,natural,man_made',
				'tourism,stars,rooms,place,capacity,ele,phone,contact,url,nodetype,name,alt_name,email,website',
				'opening_hours,description,beds,bus,note',
				'addr,housenumber,street,postcode,city,bus,public_transport,tactile_paving',
				'ref,source,wheelchair,leisure,landuse,camp_site,bench,network,brand,bulk_purchase,organic',
				'compressed_air,fuel,vending,vending_machine',
				'fee,heritage,wikipedia,wikidata,operator,mhs,amenity_1,beverage,takeaway,delivery,cuisine',
				'historic,motorcycle,drying,restaurant,hgv',
				'drive_through,parking,park_ride,supervised,surface,created_by,maxstay'
			].join(',').split(',');
			let nbInternet = 0;
			for (let k in p) {
				const k0 = k.split(':')[0];
				if (!done.includes(k0))
					switch (k0) {
						case 'internet_access':
							if ((p[k] != 'no') && !(nbInternet++))
								popup.push('Accès internet');
							break;
						default:
							popup.push(k + ' : ' + p[k]);
					}
			}
			return ('<p>' + popup.join('</p><p>') + '</p>').replace(/<p>\s*<\/p>/ig, '');
		},
	}, options));
};


/**
 * CONTROLS
 */
/**
 * Control button
 * Abstract definition to be used by other control buttons definitions
 */
//BEST left aligned buttons when screen vertical
function controlButton(o) {
	const options = Object.assign({
			element: document.createElement('div'),
			buttonBackgroundColors: ['white', 'white'],
			className: 'myol-button',
		}, o),
		control = new ol.control.Control(options),
		buttonEl = document.createElement('button');

	control.element.appendChild(buttonEl);
	control.element.className = 'ol-button ol-unselectable ol-control ' + options.className;
	control.element.title = options.title; // {string} displayed when the control is hovered.
	if (options.className) {
		if (options.rightPosition) { // {float} distance to the top when the button is on the right of the map
			control.element.style.top = options.rightPosition + 'em';
			control.element.style.right = '.5em';
		} else
			control.element.style.top = '.5em';
	}
	if (options.label)
		buttonEl.innerHTML = options.label;

	buttonEl.addEventListener('click', function(evt) {
		evt.preventDefault();
		control.toggle();
	});

	// Toggle the button status & aspect
	control.active = 0;
	control.toggle = function(newActive, group) {
		// Toggle by default
		if (typeof newActive == 'undefined')
			newActive = (control.active + 1) % options.buttonBackgroundColors.length;

		// Unselect all other controlButtons from the same group
		if (newActive && options.group)
			control.getMap().getControls().forEach(function(c) {
				if (c != control &&
					typeof c.toggle == 'function') // Only for controlButtons
					c.toggle(0, options.group);
			});

		// Execute the requested change
		if (control.active != newActive &&
			(!group || group == options.group)) { // Only for the concerned controls
			control.active = newActive;
			buttonEl.style.backgroundColor = options.buttonBackgroundColors[newActive % options.buttonBackgroundColors.length];
			options.activate(newActive);
		}
	};
	return control;
}

/**
 * Layer switcher control
 * baseLayers {[ol.layer]} layers to be chosen one to fill the map.
 * Requires controlButton, controlPermanentCheckbox & permanentCheckboxList
 */
function controlLayersSwitcher(options) {
	const button = controlButton({
		className: 'ol-switch-layer',
		title: 'Liste des cartes',
		rightPosition: 0.5,
	});

	// Transparency slider (first position)
	const rangeEl = document.createElement('input');
	rangeEl.type = 'range';
	rangeEl.oninput = displayLayerSelector;
	rangeEl.title = 'Glisser pour faire varier la tranparence';
	button.element.appendChild(rangeEl);

	// Layer selector
	const selectorEl = document.createElement('div');
	selectorEl.style.overflow = 'auto';
	selectorEl.title = 'Ctrl+click : multicouches';
	button.element.appendChild(selectorEl);

	button.setMap = function(map) { //HACK execute actions on Map init
		ol.control.Control.prototype.setMap.call(this, map);

		// Base layers selector init
		for (let name in options.baseLayers)
			if (options.baseLayers[name]) { // array of layers, mandatory, no default
				const baseEl = document.createElement('div');
				baseEl.innerHTML =
					'<input type="checkbox" name="baselayer" value="' + name + '">' +
					'<span title="">' + name + '</span>';
				selectorEl.appendChild(baseEl);
				map.addLayer(options.baseLayers[name]);
			}

		// Make the selector memorized by cookies
		controlPermanentCheckbox('baselayer', displayLayerSelector);

		// Hover the button open the selector
		button.element.firstElementChild.onmouseover = displayLayerSelector;

		// Click or change map size close the selector
		map.on(['click', 'change:size'], function() {
			displayLayerSelector();
		});

		// Leaving the map close the selector
		window.addEventListener('mousemove', function(evt) {
			const divRect = map.getTargetElement().getBoundingClientRect();
			if (evt.clientX < divRect.left || evt.clientX > divRect.right ||
				evt.clientY < divRect.top || evt.clientY > divRect.bottom)
				displayLayerSelector();
		});
	};

	function displayLayerSelector(evt, list) {
		// Check the first if none checked
		if (list && list.length === 0)
			selectorEl.firstChild.firstChild.checked = true;

		// Leave only one checked except if Ctrl key is on
		if (evt && evt.type == 'click' && !evt.ctrlKey) {
			const checkEls = document.getElementsByName('baselayer');
			for (let e = 0; e < checkEls.length; e++)
				if (checkEls[e] != evt.target)
					checkEls[e].checked = false;
		}

		list = permanentCheckboxList('baselayer');

		// Refresh layers visibility & opacity
		for (let layerName in options.baseLayers)
			if (typeof options.baseLayers[layerName] == 'object') {
				options.baseLayers[layerName].setVisible(list.indexOf(layerName) !== -1);
				options.baseLayers[layerName].setOpacity(0);
			}
		if (typeof options.baseLayers[list[0]] == 'object')
			options.baseLayers[list[0]].setOpacity(1);
		if (list.length >= 2)
			options.baseLayers[list[1]].setOpacity(rangeEl.value / 100);

		// Refresh control button, range & selector
		button.element.firstElementChild.style.display = evt ? 'none' : '';
		rangeEl.style.display = evt && list.length > 1 ? '' : 'none';
		selectorEl.style.display = evt ? '' : 'none';
		selectorEl.style.maxHeight = (button.getMap().getTargetElement().clientHeight - 58 - (list.length > 1 ? 24 : 0)) + 'px';
	}
	return button;
}

/**
 * Permalink control
 * "map" url hash or cookie = {map=<ZOOM>/<LON>/<LAT>/<LAYER>}
 */
//BEST save curent layer
function controlPermalink(o) {
	const options = Object.assign({
			hash: '?', // {?, #} the permalink delimiter
			visible: true, // {true | false} add a controlPermalink button to the map.
			init: true, // {true | false} use url hash or "controlPermalink" cookie to position the map.
		}, o),
		aEl = document.createElement('a'),
		control = new ol.control.Control({
			element: document.createElement('div'), //HACK No button
			render: render,
		});
	control.element.appendChild(aEl);

	let params = (location.hash + location.search).match(/map=([-.0-9]+)\/([-.0-9]+)\/([-.0-9]+)/) || // Priority to the hash
		document.cookie.match(/map=([-.0-9]+)\/([-.0-9]+)\/([-.0-9]+)/) || // Then the cookie
		(options.initialFit || '6/2/47').match(/([-.0-9]+)\/([-.0-9]+)\/([-.0-9]+)/); // Url arg format : <ZOOM>/<LON>/<LAT>/<LAYER>

	if (options.visible) {
		control.element.className = 'ol-permalink';
		aEl.innerHTML = 'Permalink';
		aEl.title = 'Generate a link with map zoom & position';
		control.element.appendChild(aEl);
	}

	if (typeof options.initialCenter == 'function') {
		options.initialCenter([parseFloat(params[2]), parseFloat(params[3])]);
	}

	function render(evt) {
		const view = evt.map.getView();

		// Set center & zoom at the init
		if (options.init &&
			params) { // Only once
			view.setZoom(params[1]);
			view.setCenter(ol.proj.transform([parseFloat(params[2]), parseFloat(params[3])], 'EPSG:4326', 'EPSG:3857'));
			params = null;
		}

		// Set the permalink with current map zoom & position
		if (view.getCenter()) {
			const ll4326 = ol.proj.transform(view.getCenter(), 'EPSG:3857', 'EPSG:4326'),
				newParams = [
					parseInt(view.getZoom()),
					Math.round(ll4326[0] * 100000) / 100000,
					Math.round(ll4326[1] * 100000) / 100000
				];

			aEl.href = options.hash + 'map=' + newParams.join('/');
			document.cookie = 'map=' + newParams.join('/') + ';path=/; SameSite=Strict';
		}
	}
	return control;
}

/**
 * Control to displays the length of a line overflown
 * option hoverStyle style the hovered feature
 * Requires controlButton
 */
function controlMousePosition() {
	return new ol.control.MousePosition({
		coordinateFormat: ol.coordinate.createStringXY(5),
		projection: 'EPSG:4326',
		className: 'ol-coordinate',
		undefinedHTML: String.fromCharCode(0), //HACK hide control when mouse is out of the map
	});
}

/**
 * Control to displays the length of a line overflown
 * option hoverStyle style the hovered feature
 * Requires controlButton
 */
function controlLengthLine() {
	const control = new ol.control.Control({
		element: document.createElement('div'), // div to display the measure
	});
	control.element.className = 'ol-length-line';

	control.setMap = function(map) { //HACK execute actions on Map init
		ol.control.Control.prototype.setMap.call(this, map);

		map.on('pointermove', function(evt) {
			control.element.innerHTML = ''; // Clear the measure if hover no feature

			// Find new features to hover
			map.forEachFeatureAtPixel(evt.pixel, calculateLength, {
				hitTolerance: 6,
			});
		});
	};

	//BEST calculate distance to the ends
	function calculateLength(feature) {
		// Display the line length
		if (feature) {
			const length = ol.sphere.getLength(feature.getGeometry());
			if (length >= 100000)
				control.element.innerHTML = (Math.round(length / 1000)) + ' km';
			else if (length >= 10000)
				control.element.innerHTML = (Math.round(length / 100) / 10) + ' km';
			else if (length >= 1000)
				control.element.innerHTML = (Math.round(length / 10) / 100) + ' km';
			else if (length >= 1)
				control.element.innerHTML = (Math.round(length)) + ' m';
		}
		return false; // Continue detection (for editor that has temporary layers)
	}
	return control;
}

/**
 * Control to displays set preload of 4 upper level tiles if we are on full screen mode
 * This prepares the browser to become offline on the same session
 * Requires controlButton
 */
function controlTilesBuffer(depth, depthFS) {
	const control = new ol.control.Control({
		element: document.createElement('div'), //HACK No button
	});

	control.setMap = function(map) { //HACK execute actions on Map init
		ol.control.Control.prototype.setMap.call(this, map);

		setPreload({
			target: map
		});
		// Change preload when the window expand to fullscreen
		map.on('change:size', setPreload);
	};

	function setPreload(evt) {
		const fs = document.webkitIsFullScreen || // Edge, Opera
			document.msFullscreenElement ||
			document.fullscreenElement; // Chrome, FF, Opera
		evt.target.getLayers().forEach(function(layer) {
			if (typeof layer.setPreload == 'function')
				layer.setPreload(fs ? depthFS || depth || 1 : depth || 1);
		});
	}
	return control;
}

/**
 * Geocoder
 * Requires https://github.com/jonataswalker/ol-geocoder/tree/master/dist
 */
//TODO BUG thin button on mobile
//BEST report issue with with animate on OL v6 & resorb patch
function controlGeocoder() {
	// Vérify if geocoder is available (not supported in IE)
	const ua = navigator.userAgent;
	if (typeof Geocoder != 'function' ||
		ua.indexOf('MSIE ') > -1 || ua.indexOf('Trident/') > -1)
		return new ol.control.Control({
			element: document.createElement('div'), //HACK No button
		});

	const geocoder = new Geocoder('nominatim', {
		provider: 'osm',
		lang: 'FR',
		keepOpen: true,
		placeholder: 'Recherche sur la carte' // Initialization of the input field
	});
	geocoder.container.firstChild.firstChild.title = 'Recherche sur la carte';
	geocoder.container.style.top = '.5em';

	return geocoder;
}

/**
 * GPS control
 * Requires controlButton
 */
//BEST GPS tap on map = distance from GPS calculation
//BEST button speed
//BEST button meteo
function controlGPS() {
	// Vérify if geolocation is available
	if (!navigator.geolocation ||
		!window.location.href.match(/https|localhost/i))
		return new ol.control.Control({ // No button
			element: document.createElement('div'),
		});

	let gps = {}, // Mem last sensors values
		compas = {},
		graticule = new ol.Feature(),
		northGraticule = new ol.Feature(),
		graticuleLayer = new ol.layer.Vector({
			source: new ol.source.Vector({
				features: [graticule, northGraticule]
			}),
			style: new ol.style.Style({
				fill: new ol.style.Fill({
					color: 'rgba(128,128,255,0.2)'
				}),
				stroke: new ol.style.Stroke({
					color: '#20b',
					lineDash: [16, 14],
					width: 1
				})
			})
		}),

		// The control button
		button = controlButton({
			className: 'myol-button ol-gps',
			buttonBackgroundColors: ['white', '#ef3', '#bbb'],
			title: 'Centrer sur la position GPS',
			activate: function(active) {
				const map = button.getMap();
				// Toggle reticule, position & rotation
				geolocation.setTracking(active);
				switch (active) {
					case 0: // Nothing
						map.removeLayer(graticuleLayer);
						map.getView().setRotation(0, 0); // Set north to top
						break;
					case 1: // Track, reticule & center to the position & orientation
						map.addLayer(graticuleLayer);
						// case 2: Track, display reticule, stay in position & orientation
				}
			}
		}),

		// Interface with the GPS system
		geolocation = new ol.Geolocation({
			trackingOptions: {
				enableHighAccuracy: true
			}
		});

	northGraticule.setStyle(new ol.style.Style({
		stroke: new ol.style.Stroke({
			color: '#c00',
			lineDash: [16, 14],
			width: 1
		})
	}));

	geolocation.on('error', function(error) {
		alert('Geolocation error: ' + error.message);
	});

	geolocation.on('change', function() {
		gps.position = ol.proj.fromLonLat(geolocation.getPosition());
		gps.accuracyGeometry = geolocation.getAccuracyGeometry().transform('EPSG:4326', 'EPSG:3857');
		/* //BEST GPS Firefox Update delta only over some speed
		if (!navigator.userAgent.match('Firefox'))

		if (geolocation.getHeading()) {
			gps.heading = -geolocation.getHeading(); // Delivered radians, clockwize
			gps.delta = gps.heading - compas.heading; // Freeze delta at this time bewteen the GPS heading & the compas
		} */

		renderReticule();
	});

	button.setMap = function(map) { //HACK execute actions on Map init
		ol.control.Control.prototype.setMap.call(this, map);
		map.on('moveend', renderReticule); // Refresh graticule after map zoom
	};

	// Browser heading from the inertial sensors
	window.addEventListener(
		'ondeviceorientationabsolute' in window ?
		'deviceorientationabsolute' : // Gives always the magnetic north
		'deviceorientation', // Gives sometime the magnetic north, sometimes initial device orientation
		function(evt) {
			const heading = evt.alpha || evt.webkitCompassHeading; // Android || iOS
			if (heading)
				compas = {
					heading: Math.PI / 180 * (heading - screen.orientation.angle), // Delivered ° reverse clockwize
					absolute: evt.absolute // Gives initial device orientation | magnetic north
				};

			renderReticule();
		}
	);

	function renderReticule() {
		if (button.active && gps && gps.position) {
			// Estimate the viewport size
			const map = button.getMap(),
				view = map.getView(),
				hg = map.getCoordinateFromPixel([0, 0]),
				bd = map.getCoordinateFromPixel(map.getSize()),
				far = Math.hypot(hg[0] - bd[0], hg[1] - bd[1]) * 10;

			if (!graticule.getGeometry()) // Only once the first time the feature is enabled
				view.setZoom(17); // Zoom on the area

			if (button.active == 1)
				view.setCenter(gps.position);

			// Draw the graticule
			graticule.setGeometry(new ol.geom.GeometryCollection([
				gps.accuracyGeometry, // The accurate circle
				new ol.geom.MultiLineString([ // The graticule
					[add2(gps.position, [-far, 0]), add2(gps.position, [far, 0])],
					[gps.position, add2(gps.position, [0, -far])],
				]),
			]));
			northGraticule.setGeometry(new ol.geom.GeometryCollection([
				new ol.geom.LineString( // Color north in red
					[gps.position, add2(gps.position, [0, far])]
				),
			]));

			// Map orientation (Radians and reverse clockwize)
			if (compas.absolute && button.active == 1)
				view.setRotation(compas.heading, 0); // Use magnetic compas value
			/* //BEST GPS Firefox use delta if speed > ??? km/h
					compas.absolute ?
					compas.heading : // Use magnetic compas value
					compas.heading && gps.delta ? compas.heading + gps.delta : // Correct last GPS heading with handset moves
					0
				); */

			map.dispatchEvent({
				type: 'myol:ongpsposition', // Warn layerEdit that we uploaded some features
				position: gps.position,
			});
		}
	}

	function add2(a, b) {
		return [a[0] + b[0], a[1] + b[1]];
	}
	return button;
}

/**
 * GPX file loader control
 * Requires controlButton
 */
//BEST upload WPT
function controlLoadGPX(o) {
	const options = Object.assign({
			label: '\u25b2',
			title: 'Visualiser un fichier GPX sur la carte',
			activate: function() {
				inputEl.click();
			},
			style: new ol.style.Style({
				stroke: new ol.style.Stroke({
					color: 'blue',
					width: 3,
				})
			}),
		}, o),
		inputEl = document.createElement('input'),
		format = new ol.format.GPX(),
		reader = new FileReader(),
		button = controlButton(options);

	inputEl.type = 'file';
	inputEl.addEventListener('change', function() {
		reader.readAsText(inputEl.files[0]);
	});

	reader.onload = function() {
		const map = button.getMap(),
			features = format.readFeatures(reader.result, {
				dataProjection: 'EPSG:4326',
				featureProjection: 'EPSG:3857',
			}),
			added = map.dispatchEvent({
				type: 'myol:onfeatureload', // Warn layerEdit that we uploaded some features
				features: features,
			});

		if (added !== false) { // If one used the feature
			// Display the track on the map
			const source = new ol.source.Vector({
					format: format,
					features: features,
				}),
				layer = new ol.layer.Vector({
					source: source,
					style: options.style,
				});
			map.addLayer(layer);
			map.getView().fit(source.getExtent());
		}

		// Zoom the map on the added features
		const extent = ol.extent.createEmpty();
		for (let f in features)
			ol.extent.extend(extent, features[f].getGeometry().getExtent());
		map.getView().fit(extent, {
			maxZoom: 17,
		});
	};
	return button;
}

/**
 * GPX file downloader control
 * Requires controlButton
 */
//BEST various formats
//TODO BUG download last file when changing the layer without moving the map ==> Clear the source when changing the selector
function controlDownloadGPX(o) {
	const options = Object.assign({
			label: '\u25bc',
			title: 'Obtenir un fichier GPX contenant\nles éléments visibles dans la fenêtre.',
			fileName: document.title || 'openlayers',
			activate: activate,
		}, o),
		hiddenEl = document.createElement('a'),
		button = controlButton(options);
	hiddenEl.target = '_self';
	hiddenEl.download = options.fileName + '.gpx';
	hiddenEl.style = 'display:none';
	document.body.appendChild(hiddenEl);

	function activate() { // Callback at activation / desactivation, mandatory, no default
		let features = [],
			extent = button.getMap().getView().calculateExtent();

		// Get all visible features
		button.getMap().getLayers().forEach(function(layer) {
			if (layer.getSource() && layer.getSource().forEachFeatureInExtent) // For vector layers only
				layer.getSource().forEachFeatureInExtent(extent, function(feature) {
					const properties = feature.getProperties();
					if (properties.id)
						feature.setId(properties.id);
					if (feature.getKeys().length > 1) // Except markers taht have only geom
						features.push(feature);
				});
		});

		// Write in GPX format
		const gpx = new ol.format.GPX().writeFeatures(features, {
				dataProjection: 'EPSG:4326',
				featureProjection: 'EPSG:3857',
				decimals: 5,
			})
			.replace(/<[a-z]*>\[object Object\]<\/[a-z]*>/g, '')
			.replace(/(<\/gpx|<\/?wpt|<\/?trk>|<\/?rte>)/g, '\n$1')
			.replace(/(<name|<ele|<sym|<link|<type|<\/?trkseg|<rtept)/g, '\n\t$1')
			.replace(/(<trkpt)/g, '\n\t\t$1'),

			file = new Blob([gpx], {
				type: 'application/gpx+xml',
			});

		if (typeof navigator.msSaveBlob == 'function') // IE/Edge
			navigator.msSaveBlob(file, options.fileName + '.gpx');
		else {
			hiddenEl.href = URL.createObjectURL(file);
			hiddenEl.click();
		}
	}
	return button;
}

/**
 * Print control
 * Requires controlButton
 */
function controlPrint() {
	const button = controlButton({
			className: 'myol-button ol-print',
			title: 'Imprimer la carte',
			activate: function() {
				resizeDraft(button.getMap());
				button.getMap().once('rendercomplete', function() {
					window.print();
					location.reload();
				});
			},
		}),
		orientationEl = document.createElement('div');

	// Add orientation selectors below the button
	orientationEl.innerHTML = '<input type="radio" name="ori" value="0">Portrait A4<br>' +
		'<input type="radio" name="ori" value="1">Paysage A4';
	orientationEl.className = 'ol-control-hidden';

	button.element.appendChild(orientationEl);
	button.element.onmouseover = function() {
		orientationEl.className = 'ol-control-question';
	};
	button.element.onmouseout = function() {
		orientationEl.className = 'ol-control-hidden';
	};
	button.setMap = function(map) { //HACK execute actions on Map init
		ol.control.Control.prototype.setMap.call(this, map);

		const oris = document.getElementsByName('ori');
		for (let i = 0; i < oris.length; i++) // Use « for » because of a bug in Edge / IE
			oris[i].onchange = resizeDraft;
	};

	function resizeDraft() {
		// Resize map to the A4 dimensions
		const map = button.getMap(),
			mapEl = map.getTargetElement(),
			oris = document.querySelectorAll("input[name=ori]:checked"),
			ori = oris.length ? oris[0].value : 0;
		mapEl.style.width = ori == 0 ? '210mm' : '297mm';
		mapEl.style.height = ori == 0 ? '290mm' : '209.9mm'; // -.1mm for Chrome landscape no marging bug
		map.setSize([mapEl.offsetWidth, mapEl.offsetHeight]);

		// Hide all but the map
		for (let child = document.body.firstChild; child !== null; child = child.nextSibling)
			if (child.style && child !== mapEl)
				child.style.display = 'none';

		// Raises the map to the top level
		document.body.appendChild(mapEl);
		document.body.style.margin = 0;
		document.body.style.padding = 0;

		document.addEventListener('keydown', function(evt) {
			if (evt.key == 'Escape')
				setTimeout(function() {
					window.location.reload();
				});
		});
	}
	return button;
}

/**
 * Line & Polygons Editor
 * Requires controlButton, escapedStyle, JSONparse, HACK map_
 */
//TODO BUG controlDownloadGPX don't save edited features
//BEST why must it be included by map.addControl after map init ? Not as an overlay
function controlEdit(options) {
	const format = new ol.format.GeoJSON();
	options = Object.assign({
		group: 'edit',
		geoJsonId: 'editable-json', // Option geoJsonId : html element id of the geoJson features to be edited
		label: 'M',
		buttonBackgroundColors: ['white', '#ef3'],
		activate: function(active) {
			activate(active, modify);
		},
		readFeatures: function() {
			return format.readFeatures(
				JSONparse(geoJsonValue || '{"type":"FeatureCollection","features":[]}'), {
					featureProjection: 'EPSG:3857', // Read/write data as ESPG:4326 by default
				});
		},
		saveFeatures: function() {
			return format.writeFeatures(source.getFeatures(coordinates, format), {
				featureProjection: 'EPSG:3857',
				decimals: 5,
			});
		},
		styleOptions: {
			stroke: new ol.style.Stroke({
				color: 'blue',
				width: 2,
			}),
			fill: new ol.style.Fill({
				color: 'rgba(0,0,255,0.2)',
			}),
		},
		editStyleOptions: { // Hover / modify / create
			// Draw symbol
			image: new ol.style.Circle({
				radius: 4,
				stroke: new ol.style.Stroke({
					color: 'red',
					width: 2,
				}),
			}),
			// Lines or border colors
			stroke: new ol.style.Stroke({
				color: 'red',
				width: 2,
			}),
			fill: new ol.style.Fill({
				color: 'rgba(255,0,0,0.3)',
			}),
		},
	}, options);

	const button = controlButton(options),
		geoJsonEl = document.getElementById(options.geoJsonId), // Read data in an html element
		geoJsonValue = geoJsonEl ? geoJsonEl.value : '',
		features = options.readFeatures(),
		source = new ol.source.Vector({
			features: features,
			wrapX: false,
		}),
		layer = new ol.layer.Vector({
			source: source,
			zIndex: 20,
			style: escapedStyle(options.styleOptions),
		}),
		style = escapedStyle(options.styleOptions),
		editStyle = escapedStyle(options.styleOptions, options.editStyleOptions),
		snap = new ol.interaction.Snap({
			source: source,
		}),
		modify = new ol.interaction.Modify({
			source: source,
			style: editStyle,
		});
	layer.options = options;

	// Treat the geoJson input as any other edit
	optimiseEdited();

	// Optional option snapLayers : [list of layers to snap]
	if (options.snapLayers)
		options.snapLayers.forEach(function(layer) {
			layer.getSource().on('change', function() {
				const fs = layer.getSource().getFeatures();
				for (let f in fs)
					snap.addFeature(fs[f]);
			});
		});

	button.setMap = function(map) { //HACK execute actions on Map init
		ol.control.Control.prototype.setMap.call(this, map);

		//HACK Avoid zooming when you leave the mode by doubleclick
		map.getInteractions().forEach(function(i) {
			if (i instanceof ol.interaction.DoubleClickZoom)
				map.removeInteraction(i);
		});

		map.addLayer(layer);
		button.toggle(true); // Init modify button on

		// Zoom the map on the loaded features
		// You must use permalink({init: false})
		//TODO BUG temporary shift to position if permalink init: true
		const features = source.getFeatures(),
			extent = ol.extent.createEmpty();
		if (features.length) {
			for (let f in features)
				ol.extent.extend(extent, features[f].getGeometry().getExtent());
			map.getView().fit(extent, {
				maxZoom: 17,
			});
		}

		// Add features loaded from GPX file
		map.on('myol:onfeatureload', function(evt) {
			source.addFeatures(evt.features);
			optimiseEdited();
			return false; // Warn controlLoadGPX that the editor got the included feature
		});

		map.on('pointermove', hover);

		if (options.editLine)
			map.addControl(controlDraw({
				type: 'LineString',
				label: 'L',
				title: options.editLine,
			}));
		if (options.editPolygon)
			map.addControl(controlDraw({
				type: 'Polygon',
				label: 'P',
				title: options.editPolygon,
			}));
	};

	function controlDraw(options) {
		const buttonDraw = controlButton(Object.assign({
				group: 'edit',
				buttonBackgroundColors: ['white', '#ef3'],
				activate: function(active) {
					activate(active, interaction);
				},
			}, options)),
			interaction = new ol.interaction.Draw(Object.assign({
				style: editStyle,
				source: source,
			}, options));

		interaction.on(['drawend'], function() {
			// Switch on the main editor button
			button.toggle(true);

			// Warn source 'on change' to save the feature
			// Don't do it now as it's not yet added to the source
			source.modified = true;
		});
		return buttonDraw;
	}

	// Manage hover to save modify actions integrity
	var hoveredFeature = null;

	//TODO use the centralized hover function
	function hover(evt) {
		let nbFeaturesAtPixel = 0;
		button.getMap().forEachFeatureAtPixel(evt.pixel, function(feature) {
			source.getFeatures().forEach(function(f) {
				if (f.ol_uid == feature.ol_uid) {
					nbFeaturesAtPixel++;
					if (!hoveredFeature) { // Hovering only one
						feature.setStyle(editStyle);
						hoveredFeature = feature; // Don't change it until there is no more hovered
					}
				}
			});
		}, {
			hitTolerance: 6, // Default is 0
		});

		// If no more hovered, return to the normal style
		if (!nbFeaturesAtPixel && !evt.originalEvent.buttons && hoveredFeature) {
			hoveredFeature.setStyle(style);
			hoveredFeature = null;
		}
	}

	modify.on('modifyend', function(evt) {
		if (evt.mapBrowserEvent.originalEvent.altKey) {
			// Ctrl + Alt click on segment : delete feature
			if (evt.mapBrowserEvent.originalEvent.ctrlKey) {
				const selectedFeatures = button.getMap().getFeaturesAtPixel(evt.mapBrowserEvent.pixel, {
					hitTolerance: 6,
					layerFilter: function(l) {
						return l.ol_uid == layer.ol_uid;
					}
				});
				for (let f in selectedFeatures) // We delete the selected feature
					source.removeFeature(selectedFeatures[f]);
			}
			// Alt click on segment : delete the segment & split the line
			else if (evt.target.vertexFeature_)
				return optimiseEdited(evt.target.vertexFeature_.getGeometry().getCoordinates());
			//BEST delete feature when Ctrl+Alt click on a summit
		}
		optimiseEdited();
		hoveredFeature = null; // Recover hovering
	});

	// End of feature creation
	source.on('change', function() { // Called all sliding long
		if (source.modified) { // Awaiting adding complete to save it
			source.modified = false; // To avoid loops
			optimiseEdited();
			hoveredFeature = null; // Recover hovering
		}
	});

	function activate(active, inter) { // Callback at activation / desactivation, mandatory, no default
		if (active) {
			button.getMap().addInteraction(inter);
			button.getMap().addInteraction(snap); // Must be added after
		} else {
			button.getMap().removeInteraction(snap);
			button.getMap().removeInteraction(inter);
		}
	}

	// Refurbish Points, Lines & Polygons
	function optimiseEdited(pointerPosition) {
		// Get all edited features as array of coordinates
		// Split lines having a summit at pointerPosition
		//BEST manage points

		let features = source.getFeatures(),
			lines = [],
			polys = [];
		for (let f in features)
			if (typeof features[f].getGeometry().getGeometries == 'function') { // GeometryCollection
				const geometries = features[f].getGeometry().getGeometries();
				for (let g in geometries)
					flatCoord(lines, geometries[g].getCoordinates(), pointerPosition);
			} else if (!features[f].getGeometry().getType().match(/point$/i)) // Not a point
			flatCoord(lines, features[f].getGeometry().getCoordinates(), pointerPosition); // Get lines or polyons as flat array of coords

		for (let a in lines)
			// Exclude 1 coordinate features (points)
			if (lines[a].length < 2)
				lines[a] = null;

			// Merge lines having a common end
			else
				for (let b = 0; b < a; b++) // Once each combination 
					if (lines[b]) {
						const m = [a, b];
						for (let i = 4; i; i--) // 4 times
							if (lines[m[0]] && lines[m[1]]) {
								// Shake lines end to explore all possibilities
								m.reverse();
								lines[m[0]].reverse();
								if (compareCoords(lines[m[0]][lines[m[0]].length - 1], lines[m[1]][0])) {
									// Merge 2 lines having 2 ends in common
									lines[m[0]] = lines[m[0]].concat(lines[m[1]].slice(1));
									lines[m[1]] = null;
								}
							}
					}

		for (let a in lines)
			if (options.editPolygon && // Only if polygons are autorized
				lines[a]) {
				// Close open lines
				if (!options.editLine) // If only polygons are autorized
					if (!compareCoords(lines[a]))
						lines[a].push(lines[a][0]);

				if (compareCoords(lines[a])) { // If this line is closed
					// Split squeezed polygons
					for (let i1 = 0; i1 < lines[a].length - 1; i1++) // Explore all summits combinaison
						for (let i2 = 0; i2 < i1; i2++)
							if (lines[a][i1][0] == lines[a][i2][0] &&
								lines[a][i1][1] == lines[a][i2][1]) { // Find 2 identical summits
								let squized = lines[a].splice(i2, i1 - i2); // Extract the squized part
								squized.push(squized[0]); // Close the poly
								polys.push([squized]); // Add the squized poly
								i1 = i2 = lines[a].length; // End loop
							}

					// Convert closed lines into polygons
					polys.push([lines[a]]); // Add the poly
					lines[a] = null; // Forget the line
				}
			}

		// Makes holes if a polygon is included in a biggest one
		for (let p1 in polys) // Explore all polys combinaison
			if (polys[p1]) {
				const fs = new ol.geom.Polygon(polys[p1]);
				for (let p2 in polys)
					if (polys[p2] && p1 != p2) {
						let intersects = true;
						for (let c in polys[p2][0])
							if (!fs.intersectsCoordinate(polys[p2][0][c]))
								intersects = false;
						if (intersects) { // If one intersects a bigger
							polys[p1].push(polys[p2][0]); // Include the smaler in the bigger
							polys[p2] = null; // Forget the smaller
						}
					}
			}
		// Purge arrays from null values
		lines = lines.filter(Boolean);
		polys = polys.filter(Boolean);

		// Recreate & save modified features
		source.clear();
		for (let l in lines)
			source.addFeature(new ol.Feature({
				geometry: new ol.geom.LineString(lines[l]),
			}));
		for (let p in polys)
			source.addFeature(new ol.Feature({
				geometry: new ol.geom.Polygon(polys[p]),
			}));

		// Save lines in <EL> as geoJSON at every change
		if (geoJsonEl)
			geoJsonEl.value = options.saveFeatures({
				lines: lines,
				polys: polys,
			}, format);
	}

	// Get all lines fragments at the same level & split if one point = pointerPosition
	function flatCoord(existingCoords, newCoords, pointerPosition) {
		if (typeof newCoords[0][0] == 'object') // Multi*
			for (let c1 in newCoords)
				flatCoord(existingCoords, newCoords[c1], pointerPosition);
		else {
			existingCoords.push([]); // Increment existingCoords array
			for (let c2 in newCoords) {
				if (pointerPosition && compareCoords(newCoords[c2], pointerPosition)) {
					existingCoords.push([]); // Forget that one & increment existingCoords array
				} else
					// Stack on the last existingCoords array
					existingCoords[existingCoords.length - 1].push(newCoords[c2]);
			}
		}
	}

	function compareCoords(a, b) {
		if (!a)
			return false;
		if (!b)
			return compareCoords(a[0], a[a.length - 1]); // Compare start with end
		return a[0] == b[0] && a[1] == b[1]; // 2 coords
	}

	return button;
}


/**
 * Tile layers examples
 */
function layersCollection(keys) {
	return {
		'OSM-FR': layerOSM('//{a-c}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png'),
		'OpenTopo': layerOSM(
			'//{a-c}.tile.opentopomap.org/{z}/{x}/{y}.png',
			'<a href="https://opentopomap.org">OpenTopoMap</a> ' +
			'(<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)',
			17
		),
		'OSM outdoors': layerThunderforest(keys.thunderforest, 'outdoors'),
		'OSM': layerOSM('//{a-c}.tile.openstreetmap.org/{z}/{x}/{y}.png'),
		'MRI': layerOSM(
			'//maps.refuges.info/hiking/{z}/{x}/{y}.png',
			'<a href="http://wiki.openstreetmap.org/wiki/Hiking/mri">MRI</a>'
		),
		'Hike & Bike': layerOSM(
			'http://{a-c}.tiles.wmflabs.org/hikebike/{z}/{x}/{y}.png',
			'<a href="http://www.hikebikemap.org/">hikebikemap.org</a>'
		), // Not on https
		'OSM cycle': layerThunderforest(keys.thunderforest, 'cycle'),
		'OSM landscape': layerThunderforest(keys.thunderforest, 'landscape'),
		'OSM transport': layerThunderforest(keys.thunderforest, 'transport'),
		'OSM trains': layerThunderforest(keys.thunderforest, 'pioneer'),
		'OSM villes': layerThunderforest(keys.thunderforest, 'neighbourhood'),
		'OSM contraste': layerThunderforest(keys.thunderforest, 'mobile-atlas'),

		'IGN': layerIGN(keys.ign, 'GEOGRAPHICALGRIDSYSTEMS.MAPS'),
		'IGN TOP 25': layerIGN(keys.ign, 'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.STANDARD'),
		'IGN classique': layerIGN(keys.ign, 'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'),
		'IGN photos': layerIGN(keys.ign, 'ORTHOIMAGERY.ORTHOPHOTOS'),
		//403 'IGN Spot': layerIGN(keys.ign, 'ORTHOIMAGERY.ORTHO-SAT.SPOT.2017', 'png'),
		//Double 	'SCAN25TOUR': layerIGN(keys.ign, 'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN25TOUR'),
		'IGN 1950': layerIGN(keys.ign, 'ORTHOIMAGERY.ORTHOPHOTOS.1950-1965', 'png'),
		'Cadastre': layerIGN(keys.ign, 'CADASTRALPARCELS.PARCELS', 'png'),
		//Le style normal n'est pas geré	'Cadast.Exp': layerIGN(keys.ign, 'CADASTRALPARCELS.PARCELLAIRE_EXPRESS', 'png'),
		'Etat major': layerIGN(keys.ign, 'GEOGRAPHICALGRIDSYSTEMS.ETATMAJOR40'),
		'ETATMAJOR10': layerIGN(keys.ign, 'GEOGRAPHICALGRIDSYSTEMS.ETATMAJOR10'),
		'IGN plan': layerIGN(keys.ign, 'GEOGRAPHICALGRIDSYSTEMS.PLANIGN'),
		'IGN route': layerIGN(keys.ign, 'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.ROUTIER'),
		'IGN noms': layerIGN(keys.ign, 'GEOGRAPHICALNAMES.NAMES', 'png'),
		'IGN rail': layerIGN(keys.ign, 'TRANSPORTNETWORKS.RAILWAYS', 'png'),
		'IGN hydro': layerIGN(keys.ign, 'HYDROGRAPHY.HYDROGRAPHY', 'png'),
		'IGN forêt': layerIGN(keys.ign, 'LANDCOVER.FORESTAREAS', 'png'),
		'IGN limites': layerIGN(keys.ign, 'ADMINISTRATIVEUNITS.BOUNDARIES', 'png'),
		//Le style normal n'est pas geré 'SHADOW': layerIGN(keys.ign, 'ELEVATION.ELEVATIONGRIDCOVERAGE.SHADOW', 'png'),
		//Le style normal n'est pas geré 'PN': layerIGN(keys.ign, 'PROTECTEDAREAS.PN', 'png'),
		'PNR': layerIGN(keys.ign, 'PROTECTEDAREAS.PNR', 'png'),
		//403 'Avalanches': layerIGN('IGN avalanches', keys.ign,'GEOGRAPHICALGRIDSYSTEMS.SLOPES.MOUNTAIN'),

		'Swiss': layerSwissTopo('ch.swisstopo.pixelkarte-farbe'),
		'Swiss photo': layerSwissTopo('ch.swisstopo.swissimage', layerGoogle('s')),
		'Espagne': layerSpain('mapa-raster', 'MTN'),
		'Espagne photo': layerSpain('pnoa-ma', 'OI.OrthoimageCoverage'),
		'Italie': layerIGM(),
		'Angleterre': layerOS(keys.bing),
		'Autriche': layerKompass('KOMPASS Touristik'),
		'Kompas': layerKompass('KOMPASS'),
		//TODO BUG		'Bing': layerBing(keys.bing, 'Road'),
		//TODO BUG ne charge pas les dalles à l'init
		'Bing photo': layerBing(keys.bing, 'AerialWithLabels'),
		'Google road': layerGoogle('m'),
		'Google terrain': layerGoogle('p'),
		'Google photo': layerGoogle('s'),
		'Google hybrid': layerGoogle('s,h'),
		'Stamen': layerStamen('terrain'),
		'Toner': layerStamen('toner'),
		'Watercolor': layerStamen('watercolor'),
	};
}

/**
 * Controls examples
 */
function controlsCollection(options) {
	options = options || {};
	if (!options.baseLayers)
		options.baseLayers = layersCollection(options.geoKeys);

	return [
		controlLayersSwitcher(Object.assign({
			baseLayers: options.baseLayers,
			geoKeys: options.geoKeys,
		}, options.controlLayersSwitcher)),
		controlTilesBuffer(1, 4),
		controlPermalink(options.controlPermalink),
		new ol.control.Attribution({
			collapsible: false, // Attribution always open
		}),
		new ol.control.ScaleLine(),
		controlMousePosition(),
		controlLengthLine(),
		new ol.control.Zoom(),
		new ol.control.FullScreen({
			label: '', //HACK Bad presentation on IE & FF
			tipLabel: 'Plein écran',
		}),
		controlGeocoder(),
		controlGPS(options.controlGPS),
		controlLoadGPX(),
		controlDownloadGPX(options.controlDownloadGPX),
		controlPrint(),
	];
}