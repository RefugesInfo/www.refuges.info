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
if (!ol) var ol = {}; //HACK For JS validators

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
 * IE polyfill
 * You can include https://cdn.polyfill.io/v3/polyfill.min.js in place
 */
if (!Object.assign)
	Object.assign = function() {
		let r = {};
		for (let a in arguments)
			for (let m in arguments[a])
				r[m] = arguments[a][m];
		return r;
	};

/**
 * Json parsing errors log
 */
function JSONparse(json) {
	try {
		return JSON.parse(json);
	} catch (returnCode) {
		console.log(returnCode + ' parsing : "' + json + '" ' + new Error().stack);
	}
}

/**
 * Hack warn layers when added to the map
 */
ol.Map.prototype.handlePostRender = function() {
	ol.PluggableMap.prototype.handlePostRender.call(this);

	const map = this;
	map.getLayers().forEach(function(layer) {
		if (!layer.map_) {
			layer.map_ = map;

			layer.dispatchEvent({
				type: 'myol:onadd',
				map: map,
			});
		}
	});
};


/**
 * TILE LAYERS
 */
/**
 * Openstreetmap
 */
function layerOsm(url, attribution, maxZoom) {
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

function layerOsmOpenTopo() {
	return layerOsm(
		'//{a-c}.tile.opentopomap.org/{z}/{x}/{y}.png',
		'<a href="https://opentopomap.org">OpenTopoMap</a> ' +
		'(<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)',
		17
	);
}

function layerOsmMri() {
	return layerOsm(
		'//maps.refuges.info/hiking/{z}/{x}/{y}.png',
		'<a href="//wiki.openstreetmap.org/wiki/Hiking/mri">MRI</a>'
	);
}

/**
 * Kompas (Austria)
 * Requires layerOsm
 */
function layerKompass(layer) {
	return layerOsm(
		'http://ec{0-3}.cdn.ecmaps.de/WmsGateway.ashx.jpg?' + // Not available via https
		'Experience=ecmaps&MapStyle=' + layer + '&TileX={x}&TileY={y}&ZoomLevel={z}',
		'<a href="http://www.kompass.de/livemap/">KOMPASS</a>'
	);
}

/**
 * Thunderforest
 * Requires layerOsm
 * Get your own (free) THUNDERFOREST key at https://manage.thunderforest.com
 */
function layerThunderforest(key, layer) {
	return layerOsm(
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
//BEST layerTileIncomplete
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
 * Requires myol:onadd
 */
//BEST document all options in options = Object.assign
function layerTileIncomplete(options) {
	const layer = options.extraLayer || layerStamen('terrain');
	options.sources[999999] = layer.getSource(); // Add extrabound source on the top of the list

	layer.once('myol:onadd', function(evt) {
		if (typeof options.addSources == 'function')
			options.sources = Object.assign(
				options.sources,
				options.addSources()
			);
		evt.map.getView().on('change:resolution', change);
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
	layer.on('change:opacity', function() {
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
 * Compute a style from different styles
 * return ol.style.Style containing each style component or ol default
 */
function escapedStyle(a, b, c) {
	//BEST work with arguments
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
 * Gives list of checkboxes inputs states having the same name
 * selectorName {string}
 * evt {keyboard event} if an input is clicked,
 *     if an input witout value is clicked, copy the check in all other inputs having the same name (click "all")
 * return : array of values of all checked <input name="selectorName" type="checkbox" value="xxx" />
 */
//BEST open/close features check button
//BEST WRI bug uncheck massifs, go to a page & come back
function permanentCheckboxList(selectorName, evt) {
	const inputEls = document.getElementsByName(selectorName),
		list = [];

	for (let e = 0; e < inputEls.length; e++) { //HACK el.forEach is not supported by IE/Edge
		if (evt) {
			// Select/deselect all inputs when clicking an <input> without value
			if (evt.target.value == 'on') // "all" input has a default value = "on"
				inputEls[e].checked = evt.target.checked; // Check all if "all" is clicked
			else if (inputEls[e].value == 'on') // "all" <input>
				inputEls[e].checked = false; // Reset if another check is clicked
		}

		// Get the values of all checked inputs
		if (inputEls[e].checked) // List checked elements
			list.push(inputEls[e].value);
	}

	// Mem the data in the cookie
	document.cookie = 'map-' + selectorName + '=' +
		(list.join(',') || 'none') +
		'; path=/; SameSite=Strict;';

	return list;
}

/**
 * Manages checkboxes inputs having the same name
 * selectorName {string}
 * callback {function} action when the button is clicked
 * options.init {string} default cookie value
 * options.noMemSelection {bool} do(default)/don't(if true) mem state in a cookie
 */
function controlPermanentCheckbox(selectorName, callback, options) {
	options = options || {};

	// Search values in cookies
	const inputEls = document.getElementsByName(selectorName),
		cooks = [
			location.search, // Priority to the url args
			location.hash, // Then the hash
			document.cookie, // Then the cookies
			'map-' + selectorName + '=' + (options.init || ''), // Then the default
		];
	let found = false;
	for (let c in cooks) {
		const match = cooks[c].match('map-' + selectorName + '=([^#&;]*)');
		if (!found && match && !options.noMemSelection)
			// Set the <input> checks accordingly with the cookie
			for (let e = 0; e < inputEls.length; e++) //HACK el.forEach is not supported by IE/Edge
				if (match[1].split(',').indexOf(inputEls[e].value) !== -1)
					found = inputEls[e].checked = true;
	}

	// Attach the action
	function onClick(evt) {
		callback(evt, permanentCheckboxList(selectorName, evt));
	}
	for (let e = 0; e < inputEls.length; e++)
		inputEls[e].addEventListener('click', onClick);

	// Call callback once at the init
	callback(null, permanentCheckboxList(selectorName));
}

/**
 * Manages a feature hovering common to all features & layers
 * Requires escapedStyle
 */
function hoverManager(map) {
	if (map.hasHoverManager_) // Only one per map
		return;
	map.hasHoverManager_ = true; //BEST make it reentrant (for several maps)

	const labelEl = document.createElement('div'),
		popup = new ol.Overlay({
			element: labelEl,
		}),
		viewStyle = map.getViewport().style;
	map.addOverlay(popup);

	let hoveredFeature = null;
	map.on('pointermove', pointerMove);

	// Hide popup when the cursor is out of the map
	window.addEventListener('mousemove', function(evt) {
		const divRect = map.getTargetElement().getBoundingClientRect();
		if (evt.clientX < divRect.left || evt.clientX > divRect.right ||
			evt.clientY < divRect.top || evt.clientY > divRect.bottom)
			pointerMove();
	});

	// Go to feature.property.link when click on the feature (icon or area)
	map.on('click', function(evt) {
		if (hoveredFeature) {
			const link = hoveredFeature.getProperties().link;
			if (link) {
				if (evt.pointerEvent.ctrlKey) {
					const win = window.open(link, '_blank');
					if (evt.pointerEvent.shiftKey)
						win.focus();
				} else
					window.location = link;
			}
		}
	});

	function pointerMove(evt) {
		let closestFeature = null,
			distanceMin = 2000;

		// Search hovered features
		if (evt) // Except when out of the map
			map.forEachFeatureAtPixel(
				evt.pixel,
				function(feature, layer) {
					if (layer) {
						let geometry = feature.getGeometry(),
							featurePixel = map.getPixelFromCoordinate(
								geometry.getExtent()
							),
							distance = Math.hypot( // Distance of a point
								featurePixel[0] - evt.pixel[0] + 1 / feature.ol_uid, // Randomize to avoid same location features
								featurePixel[1] - evt.pixel[1]
							);

						// Higest priority for draggable markers
						if (feature.getProperties().draggable)
							distance = 0;

						if (geometry.flatCoordinates.length > 2) { // Line or polygon
							distance = 1000; // Lower priority
							featurePixel = evt.pixel; // Label follows the cursor
						}
						if (distanceMin > distance) {
							distanceMin = distance;
							closestFeature = feature;
							closestFeature.pixel_ = featurePixel;
							closestFeature.layer_ = layer;
						}
					}
				}
			);

		if (closestFeature != hoveredFeature) {
			// Recover the basic style for the previous hoveredFeature feature
			if (hoveredFeature && hoveredFeature.layer_.options)
				hoveredFeature.setStyle(
					escapedStyle(hoveredFeature.layer_.options.styleOptions)
				);
			hoveredFeature = closestFeature; // Mem for the next cursor move

			// Default cursor & label
			viewStyle.cursor = 'default';
			labelEl.className = 'myol-popup-hidden';

			if (closestFeature) {
				const properties = closestFeature.getProperties(),
					layerOptions = closestFeature.layer_.options;

				// Change the cursor
				if (properties.link)
					viewStyle.cursor = 'pointer';
				if (properties.draggable)
					viewStyle.cursor = 'move';

				// Set the hovered style
				if (layerOptions) {
					closestFeature.setStyle(escapedStyle(
						layerOptions.styleOptions,
						layerOptions.hoverStyleOptions,
						layerOptions.editStyleOptions
					));

					// Set the text
					if (typeof layerOptions.label == 'function')
						labelEl.innerHTML = layerOptions.label(properties, closestFeature, layerOptions);
					else if (layerOptions.label)
						labelEl.innerHTML = layerOptions.label;
					else
						labelEl.innerHTML = null;
					if (labelEl.innerHTML) // To avoid tinny popup when nothing to display
						labelEl.className = 'myol-popup';
				}
			}
		}
		// Position & reposition the label
		if (closestFeature) {
			//HACK set the label position in the middle to measure the label extent
			popup.setPosition(map.getView().getCenter());

			const pixel = closestFeature.pixel_;
			// Shift of the label to stay into the map regarding the pointer position
			if (pixel[1] < labelEl.clientHeight + 12) { // On the top of the map (not enough space for it)
				pixel[0] += pixel[0] < map.getSize()[0] / 2 ? 10 : -labelEl.clientWidth - 10;
				pixel[1] = 2;
			} else {
				pixel[0] -= labelEl.clientWidth / 2;
				pixel[0] = Math.max(pixel[0], 0); // Left edge
				pixel[0] = Math.min(pixel[0], map.getSize()[0] - labelEl.clientWidth - 1); // Right edge
				pixel[1] -= labelEl.clientHeight + 8;
			}
			popup.setPosition(map.getCoordinateFromPixel(pixel));
		}
	}
}


/**
 * BBOX strategy when the url returns a limited number of features depending on the extent
 */
ol.loadingstrategy.bboxLimit = function(extent, resolution) {
	if (this.bboxLimitResolution > resolution) // When zoom in
		this.loadedExtentsRtree_.clear(); // Force the loading of all areas
	this.bboxLimitResolution = resolution; // Mem resolution for further requests
	return [extent];
};

/**
 * GeoJson POI layer
 * Requires JSONparse, myol:onadd, escapedStyle, hoverManager,
 * permanentCheckboxList, controlPermanentCheckbox, ol.loadingstrategy.bboxLimit
 */
function layerVectorURL(options) {
	options = Object.assign({
		/** All ol.source.Vector options */
		/** All ol.layer.Vector options */
		// baseUrl: url of the service (mandatory)
		// strategy: ol.loadingstrategy... object
		urlSuffix: '', // url suffix to be defined separately from the rest (E.G. server domain and/or directory)
		// noMemSelection: don't memorize the selection in cookies
		selectorName: '', // Id of a <select> to tune url optional parameters
		baseUrlFunction: function(bbox, list) { // Function returning the layer's url
			return options.baseUrl + options.urlSuffix +
				list.join(',') + '&bbox=' + bbox.join(','); // Default most common url format
		},
		url: function(extent, resolution, projection) {
			const bbox = ol.proj.transformExtent(
					extent,
					projection.getCode(),
					options.projection
				),
				// Retreive checked parameters
				list = permanentCheckboxList(options.selectorName).
			filter(function(evt) {
				return evt !== 'on'; // Except the "all" input (default value = "on")
			});
			// Round the coordinates
			for (let b in bbox)
				bbox[b] = (Math.ceil(bbox[b] * 10000) + (b < 2 ? 0 : 1)) / 10000;
			return options.baseUrlFunction(bbox, list, resolution);
		},
		projection: 'EPSG:4326', // Projection of received data
		format: new ol.format.GeoJSON({ // Format of received data
			dataProjection: options.projection,
		}),
		receiveProperties: function() {}, // (properties, feature, layer) Add properties based on existing one
		styleOptions: function(properties) { // Function returning the layer's feature style
			return {
				image: new ol.style.Icon({
					src: '//sym16.dc9.fr/' + properties.sym + '.png',
				}),
			};
		},
		label: function(properties) { // Label to dispach above the feature when hovering
			const lines = [],
				desc = [],
				type = (properties.type || '')
				.replace(/(:|_)/g, ' ') // Remove overpass prefix
				.replace(/[a-z]/, function(c) { // Fisrs char uppercase
					return c.toUpperCase();
				}),
				src = (properties.link || '').match(/\/([^\/]+)/i);

			if (properties.name) {
				if (properties.link)
					lines.push('<a href="' + properties.link + '">' + properties.name + '</a>');
				else
					lines.push(properties.name);
				if (type)
					lines.push(type);
			} else {
				if (properties.link)
					lines.push('<a href="' + properties.link + '">' + (type || 'Fiche') + '</a>');
				else if (type)
					lines.push(type);
			}
			if (properties.ele)
				desc.push(properties.ele + 'm');
			if (properties.bed)
				desc.push(properties.bed + '<span>\u255E\u2550\u2555</span>');
			if (desc.length)
				lines.push(desc.join(', '));
			if (properties.phone)
				lines.push('<a href="tel:' + properties.phone.replace(/ /g, '') + '">' + properties.phone + '</a>');
			if (typeof properties.copy != 'string' && src)
				properties.copy = src[1];
			if (properties.copy)
				lines.push('<p>&copy; ' + properties.copy.replace('www.', '') + '</p>');

			return lines.join('<br/>');
		},
	}, options);

	const statusEl = document.getElementById(options.selectorName + '-status') || {},
		xhr = new XMLHttpRequest(), // Only one object created
		source = new ol.source.Vector(Object.assign({
			loader: function(extent, resolution, projection) {
				const url = typeof options.url === 'function' ?
					options.url(extent, resolution, projection) :
					options.url;
				xhr.abort(); // Abort previous requests if any
				xhr.open('GET', url, true);
				xhr.onreadystatechange = function() {
					if (xhr.readyState < 4)
						statusEl.innerHTML = 'chargement';
				};
				xhr.onload = function() {
					if (xhr.status != 200)
						statusEl.innerHTML = 'erreur: ' + xhr.status + ' ' + xhr.statusText;
					else {
						if (options.strategy == ol.loadingstrategy.bboxLimit) // If we can have more features when zomming in
							source.clear(); // Clean all features when receiving a request

						const error = xhr.responseText.match(/error: ([^\.]+)/);
						if (!xhr.responseText)
							statusEl.innerHTML = 'erreur: réponse vide';
						else if (error) // Error log ini the text response
							statusEl.innerHTML = 'erreur: ' + error[1];
						else {
							const features = options.format.readFeatures(
								xhr.responseText, {
									extent: extent,
									featureProjection: projection
								});
							if (!features.length)
								statusEl.innerHTML = 'zone vide';
							else {
								source.addFeatures(features);
								statusEl.innerHTML = features.length + ' objet' + (features.length > 1 ? 's' : '') + ' chargé' + (features.length > 1 ? 's' : '');
							}
						}
					}
				};
				xhr.ontimeout = function() {
					statusEl.innerHTML = 'temps dépassé';
				};
				xhr.onerror = function() {
					statusEl.innerHTML = 'erreur réseau';
				};
				if (!options.maxResolution || (resolution < options.maxResolution)) {
					xhr.send();
					statusEl.innerHTML = 'demandé';
				}
			},
		}, options)),

		layer = new ol.layer.Vector(Object.assign({
			source: source,
			style: escapedStyle(options.styleOptions),
			renderBuffer: 16, // buffered area around curent view (px)
			zIndex: 1, // Above the baselayer even if included to the map before
		}, options));
	layer.options = options; // Mem options for further use

	const formerFeadFeatureFromObject = options.format.readFeatureFromObject;
	if (formerFeadFeatureFromObject && // If format = GeoJSON
		options.receiveProperties) { // If receiveProperties options
		options.format.readFeatureFromObject = function(object, opt_options) {
			options.receiveProperties(object.properties, object, layer);
			return formerFeadFeatureFromObject.call(this, object, opt_options);
		};
	}

	// Checkboxes to tune layer parameters
	if (options.selectorName)
		controlPermanentCheckbox(
			options.selectorName,
			function(evt, list) {
				if (!list.length)
					xhr.abort();
				statusEl.innerHTML = '';
				layer.setVisible(list.length > 0);
				displayZoomStatus();
				if (list.length && source.loadedExtentsRtree_) {
					source.loadedExtentsRtree_.clear(); // Force the loading of all areas
					source.clear(); // Redraw the layer
				}
			},
			options
		);

	layer.once('myol:onadd', function(evt) {
		// Attach tracking for labeling & cursor changes
		hoverManager(evt.map, layer);

		// Zoom out of range report
		evt.map.getView().on('change:resolution', displayZoomStatus);
		displayZoomStatus();
	});

	// Change class indicator when zoom is OK
	function displayZoomStatus() {
		if (options.maxResolution &&
			layer.map_ &&
			layer.map_.getView().getResolution() > options.maxResolution) {
			xhr.abort(); // Abort previous requests if any
			if (layer.getVisible())
				statusEl.innerHTML = 'zone trop large: zoomez';
		}
	}
	return layer;
}

/**
 * Convert properties type into gpx <sym>
 * Manages common types for many layer services
 */
//BEST define <sym> in an input check field
function getSym(type) {
	const lex =
		// https://forums.geocaching.com/GC/index.php?/topic/277519-garmin-roadtrip-waypoint-symbols/
		// <sym> propertie propertie
		'<City Hall> hotel' +
		'<Residence> refuge gite chambre_hote' +
		'<Lodge> cabane cabane_cle buron alpage shelter cabane ouverte mais ocupee par le berger l ete' +
		'<Fishing Hot Spot Facility> abri hut' +
		'<Campground> camping camp_site bivouac' +
		'<Tunnel> orri toue abri en pierre grotte cave' +
		'<Crossing> ferme ruine batiment-inutilisable cabane fermee' +

		'<Summit> sommet summit climbing_indoor climbing_outdoor bisse' +
		'<Reef> glacier canyon' +
		'<Waypoint> locality col pass' +

		'<Drinking Water> point_eau waterpoint waterfall' +
		'<Water Source> lac lake' +
		'<Ground Transportation> bus car' +
		'<Parking Area> access' +
		'<Restaurant> buffet restaurant' +
		'<Shopping Center> local_product ravitaillement' +

		'<Restroom> wc' +
		'<Oil Field> wifi reseau' +
		'<Telephone> telephone',
		// slackline_spot paragliding_takeoff paragliding_landing virtual webcam

		match = lex.match(new RegExp('<([^>]*)>[^>]* ' + type));
	return match ? match[1] : 'Puzzle Cache';
}

/**
 * www.refuges.info POI layer
 * Requires ol.loadingstrategy.bboxLimit, layerVectorURL
 */
function layerRefugesInfo(options) {
	options = Object.assign({
		baseUrl: '//www.refuges.info/',
		urlSuffix: 'api/bbox?type_points=',
		strategy: ol.loadingstrategy.bboxLimit,
		receiveProperties: function(properties) {
			properties.name = properties.nom;
			properties.link = properties.lien;
			properties.ele = properties.coord.alt;
			properties.icone = properties.type.icone;
			properties.type = properties.type.valeur;
			properties.bed = properties.places.valeur;
			// Need to have clean KML export
			properties.nom =
				properties.lien =
				properties.date = '';
		},
		styleOptions: function(properties) {
			return {
				image: new ol.style.Icon({
					src: options.baseUrl + 'images/icones/' + properties.icone + '.png'
				})
			};
		},
	}, options);
	return layerVectorURL(options); //BEST inline
}

/**
 * pyrenees-refuges.com POI layer
 * Requires layerVectorURL, getSym
 */
function layerPyreneesRefuges(options) {
	return layerVectorURL(Object.assign({
		url: 'https://www.pyrenees-refuges.com/api.php?type_fichier=GEOJSON',
		receiveProperties: function(properties) {
			properties.sym = getSym(properties.type_hebergement || 'cabane');
			properties.link = properties.url;
			properties.ele = parseInt(properties.altitude);
			properties.type = properties.type_hebergement;
			properties.bed = properties.cap_ete || properties.cap_hiver;
		},
	}, options));
}

/**
 * chemineur.fr POI layer
 * Requires ol.loadingstrategy.bboxLimit, layerVectorURL, getSym
 */
function layerChemineur(options) {
	return layerVectorURL(Object.assign({
		baseUrl: '//dc9.fr/chemineur/ext/Dominique92/GeoBB/gis.php?site=this&poi=',
		urlSuffix: '3,8,16,20,23,30,40,44,58,62,64',
		strategy: ol.loadingstrategy.bboxLimit,
		receiveProperties: function(properties) {
			const icone = properties.icone.match(new RegExp('([a-z\-_]+)\.png')); // Type calculation
			properties.name = properties.nom;
			properties.link = properties.url;
			properties.type = icone ? icone[1] : null;
			properties.sym = getSym(properties.type);
			properties.copy = 'chemineur.fr';
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
		hoverStyleOptions: {
			stroke: new ol.style.Stroke({ // For traces
				color: 'red',
				width: 3,
			})
		},
	}, options));
}

/**
 * alpages.info POI layer
 * Requires ol.loadingstrategy.bboxLimit, layerVectorURL, getSym, layerChemineur
 */
function layerAlpages(options) {
	return layerChemineur(Object.assign({
		baseUrl: '//alpages.info/ext/Dominique92/GeoBB/gis.php?forums=4,5,6',
		receiveProperties: function(properties) {
			const icone = properties.icon.match(new RegExp('([a-z\-_]+)\.png'));
			properties.sym = getSym(properties.icone);
			properties.type = icone ? icone[1] : null;
			properties.link = 'http://alpages.info/viewtopic.php?t=' + properties.id;
		},
		styleOptions: function(properties) {
			return {
				image: new ol.style.Icon({
					src: properties.icon,
				}),
			};
		},
	}, options));
}

/**
 * www.camptocamp.org POI layer
 * Requires JSONparse, ol.loadingstrategy.bboxLimit, layerVectorURL, getSym
 */
function layerC2C(options) {
	const format = new ol.format.GeoJSON({ // Format of received data
		dataProjection: 'EPSG:3857',
	});
	format.readFeatures = function(json, opts) {
		const features = [],
			objects = JSONparse(json);
		for (let o in objects.documents) {
			const object = objects.documents[o];
			features.push({
				id: object.document_id,
				type: 'Feature',
				geometry: JSONparse(object.geometry.geom),
				properties: {
					ele: object.elevation,
					name: object.locales[0].title,
					type: object.waypoint_type,
					sym: getSym(object.waypoint_type),
					link: 'https://www.camptocamp.org/waypoints/' + object.document_id,
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

	return layerVectorURL(Object.assign({
		baseUrl: 'https://api.camptocamp.org/waypoints?limit=100', // https mandatory for Access-Control-Allow-Origin
		strategy: ol.loadingstrategy.bboxLimit,
		projection: 'EPSG:3857',
		format: format,
	}, options));
}

/**
 * OSM overpass POI layer
 * From: https://openlayers.org/en/latest/examples/vector-osm.html
 * Doc: http://wiki.openstreetmap.org/wiki/Overpass_API/Language_Guide
 * Requires layerVectorURL
 */
//BEST BUG IE don't display icons
function layerOverpass(options) {
	options = Object.assign({
		baseUrl: '//overpass-api.de/api/interpreter',
		maxResolution: 30, // Only call overpass if the map's resolution is lower
	}, options);

	const inputEls = document.getElementsByName(options.selectorName),
		format = new ol.format.OSMXML(),
		layer = layerVectorURL(Object.assign({
			strategy: ol.loadingstrategy.bbox,
			format: format,
			baseUrlFunction: urlFunction,
		}, options));

	function urlFunction(bbox, list) {
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
	}

	// Extract features from data when received
	format.readFeatures = function(response, opt) {
		// Transform an area to a node (picto) at the center of this area
		const doc = new DOMParser().parseFromString(response, 'application/xml');
		for (let node = doc.documentElement.firstChild; node; node = node.nextSibling)
			if (node.nodeName == 'way') {
				// Create a new 'node' element centered on the surface
				const newNode = doc.createElement('node');
				newNode.id = node.id;
				doc.documentElement.appendChild(newNode);

				// Browse <way> attributes to build a new node
				for (let subTagNode = node.firstChild; subTagNode; subTagNode = subTagNode.nextSibling)
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

		// Call former method into OL
		const features = ol.format.OSMXML.prototype.readFeatures.call(this, doc, opt);

		// Compute missing features
		for (let f = features.length - 1; f >= 0; f--)
			if (!features[f].getId()) // Remove unused 'way' features
				features.splice(f, 1);
			else {
				const properties = features[f].getProperties(),
					newProperties = {
						sym: 'Puzzle Cache', // Default symbol
						link: 'http://www.openstreetmap.org/' + (properties.nodetype || 'node') + '/' + features[f].id_,
						copy: 'openstreetmap.org',
					};
				for (let p in properties)
					if (typeof properties[p] == 'string') { // Avoid geometry
						for (let c = 0; c < inputEls.length; c++)
							if (inputEls[c].value &&
								inputEls[c].value.includes(p) &&
								inputEls[c].value.includes(properties[p])) {
								newProperties.sym = inputEls[c].getAttribute('id');
								newProperties.type = properties[p];
							}
						features[f].setProperties(newProperties, false);
					}
			}
		return features;
	};

	return layer;
}


/**
 * CONTROLS
 */
/**
 * Control button
 * Abstract definition to be used by other control buttons definitions
 */
//BEST left aligned buttons when screen vertical
function controlButton(options) {
	options = Object.assign({
		element: document.createElement('div'),
		buttonBackgroundColors: ['white', 'white'], // Also define the button states numbers
		className: 'myol-button',
		activate: function() {}, // Call back when the button is clicked. Argument = satus number (0, 1, ...)
	}, options);
	const control = new ol.control.Control(options),
		buttonEl = document.createElement('button');

	control.element.appendChild(buttonEl);
	control.element.className = 'ol-button ol-unselectable ol-control ' + options.className;
	control.element.title = options.title; // {string} displayed when the control is hovered.
	if (options.label)
		buttonEl.innerHTML = options.label;

	buttonEl.addEventListener('click', function(evt) {
		evt.preventDefault();
		control.toggle();
	});

	// Add selectors below the button
	if (options.question) {
		control.questionEl = document.createElement('div');
		control.questionEl.innerHTML = options.question;
		control.questionEl.className = 'ol-control-hidden';

		control.element.appendChild(control.questionEl);
		control.element.onmouseover = function() {
			control.questionEl.className = 'ol-control-question';
		};
		control.element.onmouseout = function() {
			control.questionEl.className = 'ol-control-hidden';
		};
	}

	// Toggle the button status & aspect
	control.active = 0;
	control.toggle = function(newActive, group) {
		// Toggle by default
		if (typeof newActive == 'undefined')
			newActive = (control.active + 1);

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
			control.active = newActive % options.buttonBackgroundColors.length;
			buttonEl.style.backgroundColor = options.buttonBackgroundColors[control.active];
			options.activate(control.active);
		}
	};
	return control;
}

/**
 * Layer switcher control
 * baseLayers {[ol.layer]} layers to be chosen one to fill the map.
 * Requires controlPermanentCheckbox, permanentCheckboxList, controlButton
 */
function controlLayersSwitcher(options) {
	const button = controlButton({
		className: 'ol-switch-layer myol-button',
		label: '\u2026',
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
	selectorEl.title = 'Ctrl+click: multicouches';
	button.element.appendChild(selectorEl);

	//HACK execute actions on Map init
	//BEST use option render
	button.setMap = function(map) {
		ol.control.Control.prototype.setMap.call(this, map);

		// Base layers selector init
		for (let name in options.baseLayers)
			if (options.baseLayers[name]) { // array of layers, mandatory, no default
				const choiceEl = document.createElement('div');
				choiceEl.innerHTML =
					'<input type="checkbox" name="baselayer" value="' + name + '">' +
					'<span title="">' + name + '</span>';
				selectorEl.appendChild(choiceEl);
				map.addLayer(options.baseLayers[name]);
			}
		const commentEl = document.createElement('p');
		commentEl.innerHTML = 'Ctrl+click: multicouches';
		selectorEl.appendChild(commentEl);

		// Make the selector memorized by cookies
		controlPermanentCheckbox('baselayer', displayLayerSelector, options);

		// Hover the button open the selector
		button.element.firstElementChild.onmouseover = displayLayerSelector;

		// Click or change map size close the selector
		map.on(['click', 'change:size'], function() {
			displayLayerSelector();
		});

		// Leaving the map close the selector
		window.addEventListener('mousemove', function(evt) {
			const divRect = map.getTargetElement().getBoundingClientRect();
			if (evt.clientX < divRect.left || divRect.right < evt.clientX || // The mouse is outside the map
				evt.clientY < divRect.top || divRect.bottom < evt.clientY) {
				button.element.firstElementChild.style.display = '';
				rangeEl.style.display =
					selectorEl.style.display = 'none';
			}
		});
	};

	function displayLayerSelector(evt, list) {
		// Check the first if none checked
		if (list && list.length === 0)
			selectorEl.firstChild.firstChild.checked = true;

		// Leave only one checked except if Ctrl key is on
		if (evt && evt.type == 'click' && !evt.ctrlKey) {
			const inputEls = document.getElementsByName('baselayer');
			for (let e = 0; e < inputEls.length; e++) //HACK el.forEach is not supported by IE/Edge
				if (inputEls[e] != evt.target)
					inputEls[e].checked = false;
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
 * Don't set view when you declare the map
 */
function controlPermalink(options) {
	options = Object.assign({
		hash: '?', // {?, #} the permalink delimiter
		visible: true, // {true | false} add a controlPermalink button to the map.
		init: true, // {true | false} use url hash or "controlPermalink" cookie to position the map.
	}, options);
	const aEl = document.createElement('a'),
		control = new ol.control.Control({
			element: document.createElement('div'), //HACK No button
			render: render,
		});
	control.element.appendChild(aEl);

	const zoomMatch = location.href.match(/zoom=([0-9]+)/),
		latLonMatch = location.href.match(/lat=([-.0-9]+)&lon=([-.0-9]+)/);
	let params = (
			location.href + // Priority to ?map=6/2/47 or #map=6/2/47
			(zoomMatch && latLonMatch ? // Old format ?zoom=6&lat=47&lon=5
				'map=' + zoomMatch[1] + '/' + latLonMatch[2] + '/' + latLonMatch[1] :
				'') +
			document.cookie + // Then the cookie
			'map=' + options.initialFit + // Optional default
			'map=6/2/47') // Default
		.match(/map=([0-9]+)\/([-.0-9]+)\/([-.0-9]+)/); // map=<ZOOM>/<LON>/<LAT>

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
					parseInt(view.getZoom()), // Zoom
					Math.round(ll4326[0] * 100000) / 100000, // Lon
					Math.round(ll4326[1] * 100000) / 100000, // Lat
				];

			aEl.href = options.hash + 'map=' + newParams.join('/');
			document.cookie = 'map=' + newParams.join('/') + ';path=/; SameSite=Strict';
		}
	}
	return control;
}

/**
 * Control to displays the mouse position
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
//BEST report bug that stops animation on OL v6 & resorb patch on Geocoder https://github.com/openlayers/openlayers/issues/10313
//BEST BUG controm 1px down on FireFox
function controlGeocoder(options) {
	options = Object.assign({
		title: 'Recherche sur la carte',
	}, options);

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
		placeholder: options.title, // Initialization of the input field
	});

	// Move the button at the same level than the other control's buttons
	geocoder.container.firstChild.firstChild.title = options.title;
	geocoder.container.appendChild(geocoder.container.firstChild.firstChild);

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
			buttonBackgroundColors: ['white', '#ef3', '#bbb'], // Define 3 states button
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
//BEST misc formats
function controlLoadGPX(options) {
	options = Object.assign({
		label: '\u25b2',
		title: 'Visualiser un fichier GPX sur la carte',
		activate: function() {
			inputEl.click();
		},
	}, options);

	const inputEl = document.createElement('input'),
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
					style: function(feature) {
						return new ol.style.Style({
							image: new ol.style.Icon({
								src: '//sym16.dc9.fr/' + feature.getProperties().sym + '.png',
							}),
							stroke: new ol.style.Stroke({
								color: 'blue',
								width: 3,
							})
						});
					},
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
 * File downloader control
 * Requires controlButton
 */
function controlDownload(options) {
	options = Object.assign({
		label: '\u25bc',
		buttonBackgroundColors: ['white'],
		className: 'myol-button ol-download',
		title: 'Cliquer sur un format ci-dessous\n' +
			'pour obtenir un fichier contenant\n' +
			'les éléments visibles dans la fenêtre.\n' +
			'(la liste peut être incomplète pour les grandes zones)',
		question: '<span/>', // Invisible but generates a questionEl <div>
		fileName: document.title || 'openlayers',
		activate: download,
	}, options);

	const hiddenEl = document.createElement('a'),
		button = controlButton(options);
	hiddenEl.target = '_self';
	hiddenEl.style = 'display:none';
	document.body.appendChild(hiddenEl);

	const formats = {
		GPX: 'application/gpx+xml',
		KML: 'vnd.google-earth.kml+xml',
		GeoJSON: 'application/json',
	};
	for (let f in formats) {
		const el = document.createElement('p');
		el.onclick = download;
		el.innerHTML = f;
		el.id = formats[f];
		el.title = 'Obtenir un fichier ' + f;
		button.questionEl.appendChild(el);
	}

	function download() { //formatName, mime
		const formatName = this.textContent || 'GPX', //BEST get first value as default
			mime = this.id,
			format = new ol.format[formatName](),
			map = button.getMap();
		let features = [],
			extent = map.getView().calculateExtent();

		// Get all visible features
		if (options.savedLayer)
			getFeatures(options.savedLayer);
		else
			map.getLayers().forEach(getFeatures);

		function getFeatures(layer) {
			if (layer.getSource() && layer.getSource().forEachFeatureInExtent) // For vector layers only
				layer.getSource().forEachFeatureInExtent(extent, function(feature) {
					if (!layer.marker_) //BEST find a bette way to don't save the cursors
						features.push(feature);
				});
		}

		// Transform polygons in lines if format is GPX
		if (formatName == 'GPX') {
			const coords = optimiseFeatures(features, true, true);
			for (let l in coords.polys)
				features.push(new ol.Feature({
					geometry: new ol.geom.LineString(coords.polys[l]),
				}));
		}

		const data = format.writeFeatures(features, {
				dataProjection: 'EPSG:4326',
				featureProjection: 'EPSG:3857',
				decimals: 5,
			})
			// Beautify the output
			.replace(/<[a-z]*>(0|null|[\[object Object\]|[NTZa:-]*)<\/[a-z]*>/g, '')
			.replace(/<Data name="[a-z_]*"\/>|<Data name="[a-z_]*"><\/Data>|,"[a-z_]*":""/g, '')
			.replace(/<Data name="copy"><value>[a-z_\.]*<\/value><\/Data>|,"copy":"[a-z_\.]*"/g, '')
			.replace(/(<\/gpx|<\/?wpt|<\/?trk>|<\/?rte>|<\/kml|<\/?Document)/g, '\n$1')
			.replace(/(<\/?Placemark|POINT|LINESTRING|POLYGON|<Point|"[a-z_]*":|})/g, '\n$1')
			.replace(/(<name|<ele|<sym|<link|<type|<rtept|<\/?trkseg|<\/?ExtendedData)/g, '\n\t$1')
			.replace(/(<trkpt|<Data|<LineString|<\/?Polygon|<Style)/g, '\n\t\t$1')
			.replace(/(<[a-z]+BoundaryIs)/g, '\n\t\t\t$1'),

			file = new Blob([data], {
				type: mime,
			});

		if (typeof navigator.msSaveBlob == 'function') // IE/Edge
			navigator.msSaveBlob(file, options.fileName + '.' + formatName.toLowerCase());
		else {
			hiddenEl.download = options.fileName + '.' + formatName.toLowerCase();
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
		title: 'Pour imprimer la carte:\n' +
			'choisir l‘orientation,\n' +
			'zoomer et déplacer,\n' +
			'cliquer sur l‘icône imprimante.',
		question: '<input type="radio" name="print-orientation" value="0" />Portrait A4<br>' +
			'<input type="radio" name="print-orientation" value="1" />Paysage A4',
		activate: function() {
			resizeDraft(button.getMap());
			button.getMap().once('rendercomplete', function() {
				window.print();
				location.reload();
			});
		},
	});

	button.setMap = function(map) { //HACK execute actions on Map init
		ol.control.Control.prototype.setMap.call(this, map);

		const oris = document.getElementsByName('print-orientation');
		for (let i = 0; i < oris.length; i++) // Use « for » because of a bug in Edge / IE
			oris[i].onchange = resizeDraft;
	};

	function resizeDraft() {
		// Resize map to the A4 dimensions
		const map = button.getMap(),
			mapEl = map.getTargetElement(),
			oris = document.querySelectorAll("input[name=print-orientation]:checked"),
			orientation = oris.length ? oris[0].value : 0;
		mapEl.style.width = orientation == 0 ? '210mm' : '297mm';
		mapEl.style.height = orientation == 0 ? '290mm' : '209.9mm'; // -.1mm for Chrome landscape no marging bug
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
 * Marker
 * Requires JSONparse, myol:onadd, hoverManager, proj4.js for swiss coordinates
 * Read / write following fields :
 * marker-json : {"type":"Point","coordinates":[2.4,47.082]}
 * marker-lon / marker-lat
 * marker-x / marker-y : CH 1903 (wrapped with marker-xy)
 * marker-center-cursor : onclick = center the cursor at the middle of the map
 * marker-center-map : onclick = center the map on the cursor position
 */
function layerMarker(options) {
	options = Object.assign({
		llInit: [],
		centerOnMap: false,
		idDisplay: 'marker',
		decimalSeparator: '.',
		/** draggable:false, */
	}, options);
	const elJson = document.getElementById(options.idDisplay + '-json'),
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
	layer.marker_ = true; //HACK Used by hover & controlDownload

	layer.once('myol:onadd', function(evt) {
		const map = evt.map;
		hoverManager(map, layer); // Attach hovering for cursor changes

		layer.center = function() {
			point.setCoordinates(map.getView().getCenter());
		};
		layer.centerMap = function() {
			map.getView().setCenter(point.getCoordinates());
		};

		if (options.draggable) {
			// Position at the init
			if (options.centerOnMap)
				layer.center();

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
				elCenterMarker.onclick = layer.center;
			else map.addControl(controlButton({
				label: '\u29BB',
				title: 'Déplacer le curseur au centre de la carte',
				activate: layer.center,
			}));
			if (elCenterMarker)
				elCenterMap.onclick = layer.centerMap;
			else map.addControl(controlButton({
				label: '\u2A00',
				title: 'Centrer la carte sur le curseur',
				activate: layer.centerMap,
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

/**
 * Line & Polygons Editor
 * Requires JSONparse, myol:onadd, escapedStyle, controlButton
 */
function layerEdit(options) {
	options = Object.assign({
		format: new ol.format.GeoJSON(),
		projection: 'EPSG:3857',
		geoJsonId: 'editable-json', // Option geoJsonId : html element id of the geoJson features to be edited
		focus: true, // Zoom the map on the loaded features
		snapLayers: [], // Vector layers to snap on
		readFeatures: function() {
			return options.format.readFeatures(
				JSONparse(geoJsonValue || '{"type":"FeatureCollection","features":[]}'), {
					featureProjection: options.projection,
				});
		},
		saveFeatures: function(coordinates, format) {
			return format.writeFeatures(source.getFeatures(coordinates, format), {
				featureProjection: options.projection,
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

	const geoJsonEl = document.getElementById(options.geoJsonId), // Read data in an html element
		geoJsonValue = geoJsonEl ? geoJsonEl.value : '',
		extent = ol.extent.createEmpty(), // For focus on all features calculation
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
		}),
		controlModify = controlButton({
			group: 'edit',
			label: 'M',
			buttonBackgroundColors: ['white', '#ef3'],
			title: options.titleModify,
			activate: function(active) {
				activate(active, modify);
			},
		});

	// Snap on vector layers
	options.snapLayers.forEach(function(layer) {
		layer.getSource().on('change', function() {
			const fs = layer.getSource().getFeatures();
			for (let f in fs)
				snap.addFeature(fs[f]);
		});
	});

	// Manage hover to save modify actions integrity
	let hoveredFeature = null;

	layer.once('myol:onadd', function(evt) {
		const map = evt.map;
		optimiseEdited(); // Treat the geoJson input as any other edit

		//HACK Avoid zooming when you leave the mode by doubleclick
		map.getInteractions().forEach(function(i) {
			if (i instanceof ol.interaction.DoubleClickZoom)
				map.removeInteraction(i);
		});

		// Add required controls
		map.addControl(controlModify);
		controlModify.toggle(true);
		if (options.titleLine)
			map.addControl(controlDraw({
				type: 'LineString',
				label: 'L',
				title: options.titleLine,
			}));
		if (options.titlePolygon)
			map.addControl(controlDraw({
				type: 'Polygon',
				label: 'P',
				title: options.titlePolygon,
			}));

		// Zoom the map on the loaded features
		if (options.focus && features.length) {
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
	});

	function removeFeaturesAtPixel(pixel) {
		const selectedFeatures = layer.map_.getFeaturesAtPixel(pixel, {
			hitTolerance: 6,
			layerFilter: function(l) {
				return l.ol_uid == layer.ol_uid;
			}
		});
		for (let f in selectedFeatures) // We delete the selected feature
			source.removeFeature(selectedFeatures[f]);
	}

	//HACK move only one summit when dragging
	modify.handleDragEvent = function(evt) {
		let draggedUid; // The first one will be the only one that will be dragged
		for (let s in this.dragSegments_) {
			let segmentUid = this.dragSegments_[s][0].feature.ol_uid; // Get the current item uid
			if (draggedUid && segmentUid != draggedUid) // If it is not the first one
				delete this.dragSegments_[s]; // Remove it from the dragged list
			draggedUid = segmentUid;
		}
		this.dragSegments_ = this.dragSegments_.filter(Boolean); // Reorder array keys
		ol.interaction.Modify.prototype.handleDragEvent.call(this, evt); // Call the former method
	};

	//HACK delete feature when Ctrl+Alt click
	modify.handleDownEvent = function(evt) {
		if (evt.originalEvent.ctrlKey && evt.originalEvent.altKey)
			removeFeaturesAtPixel(evt.pixel_);
		return ol.interaction.Modify.prototype.handleDownEvent.call(this, evt); // Call the former method
	};

	modify.on('modifyend', function(evt) {
		if (evt.mapBrowserEvent.originalEvent.altKey) {
			// Ctrl + Alt click on segment : delete feature
			if (evt.mapBrowserEvent.originalEvent.ctrlKey)
				removeFeaturesAtPixel(evt.mapBrowserEvent.pixel);
			// Alt click on segment : delete the segment & split the line
			else if (evt.target.vertexFeature_)
				return optimiseEdited(evt.target.vertexFeature_.getGeometry().getCoordinates());
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
			layer.map_.addInteraction(inter);
			layer.map_.addInteraction(snap); // Must be added after
		} else {
			layer.map_.removeInteraction(snap);
			layer.map_.removeInteraction(inter);
		}
	}

	function controlDraw(options) {
		const button = controlButton(Object.assign({
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
			controlModify.toggle(true);

			// Warn source 'on change' to save the feature
			// Don't do it now as it's not yet added to the source
			source.modified = true;
		});
		return button;
	}

	//BEST use the centralized hover function
	function hover(evt) {
		let nbFeaturesAtPixel = 0;
		layer.map_.forEachFeatureAtPixel(evt.pixel, function(feature) {
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

	function optimiseEdited(pointerPosition) {
		const coords = optimiseFeatures(
			source.getFeatures(),
			options.titleLine,
			options.titlePolygon,
			true,
			true,
			pointerPosition
		);

		// Recreate features
		source.clear();
		for (let l in coords.lines)
			source.addFeature(new ol.Feature({
				geometry: new ol.geom.LineString(coords.lines[l]),
			}));
		for (let p in coords.polys)
			source.addFeature(new ol.Feature({
				geometry: new ol.geom.Polygon(coords.polys[p]),
			}));

		// Save lines in <EL> as geoJSON at every change
		if (geoJsonEl)
			geoJsonEl.value = options.saveFeatures(coords, options.format);
	}

	return layer;
}

/**
 * Refurbish Points, Lines & Polygons
 * Split lines having a summit at removePosition
 */
function optimiseFeatures(features, withLines, withPolygons, merge, holes, removePosition) {
	let lines = [],
		polys = [];

	// Get all edited features as array of coordinates
	for (let f in features)
		if (typeof features[f].getGeometry().getGeometries == 'function') { // GeometryCollection
			const geometries = features[f].getGeometry().getGeometries();
			for (let g in geometries)
				flatCoord(lines, geometries[g].getCoordinates(), removePosition);
		} else if (!features[f].getGeometry().getType().match(/point$/i)) // Not a point
		flatCoord(lines, features[f].getGeometry().getCoordinates(), removePosition); // Get lines or polyons as flat array of coords

	for (let a in lines)
		// Exclude 1 coordinate features (points)
		//BEST manage points
		if (lines[a].length < 2)
			delete lines[a];

		// Merge lines having a common end
		else if (merge)
		for (let b = 0; b < a; b++) // Once each combination 
			if (lines[b]) {
				const m = [a, b];
				for (let i = 4; i; i--) // 4 times
					if (lines[m[0]] && lines[m[1]]) { // Test if the line has been removed
						// Shake lines end to explore all possibilities
						m.reverse();
						lines[m[0]].reverse();
						if (compareCoords(lines[m[0]][lines[m[0]].length - 1], lines[m[1]][0])) {
							// Merge 2 lines having 2 ends in common
							lines[m[0]] = lines[m[0]].concat(lines[m[1]].slice(1));
							delete lines[m[1]]; // Remove the line but don't renumber the array keys
						}
					}
			}

	// Make polygons with in loop lines
	for (let a in lines)
		if (withPolygons && // Only if polygons are autorized
			lines[a]) {
			// Close open lines
			if (!withLines) // If only polygons are autorized
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
				delete lines[a]; // Forget the line
			}
		}

	// Makes holes if a polygon is included in a biggest one
	for (let p1 in polys) // Explore all polys combinaison
		if (holes && // Make holes option
			polys[p1]) {
			const fs = new ol.geom.Polygon(polys[p1]);
			for (let p2 in polys)
				if (polys[p2] && p1 != p2) {
					let intersects = true;
					for (let c in polys[p2][0])
						if (!fs.intersectsCoordinate(polys[p2][0][c]))
							intersects = false;
					if (intersects) { // If one intersects a bigger
						polys[p1].push(polys[p2][0]); // Include the smaler in the bigger
						delete polys[p2]; // Forget the smaller
					}
				}
		}

	return {
		lines: lines.filter(Boolean), // Remove deleted array members
		polys: polys.filter(Boolean),
	};
}

function compareCoords(a, b) {
	if (!a)
		return false;
	if (!b)
		return compareCoords(a[0], a[a.length - 1]); // Compare start with end
	return a[0] == b[0] && a[1] == b[1]; // 2 coords
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


/**
 * Tile layers examples
 */
function layersCollection(keys) {
	return {
		'OSM-FR': layerOsm('//{a-c}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png'),
		'OpenTopo': layerOsmOpenTopo(),
		'OSM outdoors': layerThunderforest(keys.thunderforest, 'outdoors'),
		'OSM': layerOsm('//{a-c}.tile.openstreetmap.org/{z}/{x}/{y}.png'),
		'MRI': layerOsmMri(),
		'Hike & Bike': layerOsm(
			'http://{a-c}.tiles.wmflabs.org/hikebike/{z}/{x}/{y}.png',
			'<a href="//www.hikebikemap.org/">hikebikemap.org</a>'
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
		'Bing': layerBing(keys.bing, 'Road'),
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
		controlDownload(options.controlDownload),
		controlPrint(),
	];
}