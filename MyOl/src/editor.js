/**
 * geoJson points, lines & polygons display
 * Marker position display & edit
 * Lines & polygons edit
 * Requires JSONparse, myol:onadd, controlButton (from src/controls.js file)
 */
function layerEditGeoJson(options) {
	options = Object.assign({
		format: new ol.format.GeoJSON(),
		projection: 'EPSG:3857',
		geoJsonId: 'editable-json', // Option geoJsonId : html element id of the geoJson features to be edited
		focus: false, // Zoom the map on the loaded features
		snapLayers: [], // Vector layers to snap on
		readFeatures: function() {
			return options.format.readFeatures(
				options.geoJson ||
				JSONparse(geoJsonValue || '{"type":"FeatureCollection","features":[]}'), {
					featureProjection: options.projection,
				});
		},
		saveFeatures: function(coordinates, format) {
			return format.writeFeatures(
					source.getFeatures(
						coordinates, format), {
						featureProjection: options.projection,
						decimals: 5,
					})
				.replace(/"properties":\{[^\}]*\}/, '"properties":null');
		},
		// Drag lines or Polygons
		styleOptions: {
			// Marker circle
			image: new ol.style.Circle({
				radius: 4,
				stroke: new ol.style.Stroke({
					color: 'red',
					width: 2,
				}),
			}),
			// Editable lines or polygons border
			stroke: new ol.style.Stroke({
				color: 'red',
				width: 2,
			}),
			// Editable polygons
			fill: new ol.style.Fill({
				color: 'rgba(0,0,255,0.2)',
			}),
		},
		editStyleOptions: { // Hover / modify / create
			// Editable lines or polygons border
			stroke: new ol.style.Stroke({
				color: 'red',
				width: 4,
			}),
			// Editable polygons fill
			fill: new ol.style.Fill({
				color: 'rgba(255,0,0,0.3)',
			}),
		},
	}, options);

	const geoJsonEl = document.getElementById(options.geoJsonId), // Read data in an html element
		displayPointEl = document.getElementById(options.displayPointId), // Pointer edit <input>
		inputEls = displayPointEl ? displayPointEl.getElementsByTagName('input') : {},

		geoJsonValue = geoJsonEl ? geoJsonEl.value : '',
		style = escapedStyle(options.styleOptions),
		editStyle = escapedStyle(options.styleOptions, options.editStyleOptions),

		features = options.readFeatures(),
		source = new ol.source.Vector({
			features: features,
			wrapX: false,
		}),
		layer = new ol.layer.Vector({
			source: source,
			zIndex: 4, // Cursor above the features
			style: style,
		}),
		snap = new ol.interaction.Snap({
			source: source,
			pixelTolerance: 7.5, // 6 + line width / 2 : default is 10
		}),
		modify = new ol.interaction.Modify({
			source: source,
			pixelTolerance: 6, // Default is 10
			style: editStyle,
		}),
		controlModify = controlButton({
			group: 'edit',
			label: options.titleModify ? 'M' : null,
			buttonBackgroundColors: ['white', '#ef3'],
			title: options.titleModify,
			activate: function(state) {
				activate(state, modify);
			},
		});

	// Set edit fields actions
	//BEST do a specific layer for point position editing
	//BEST BUG answer should stay in -180 +180 ° wrap
	for (let i = 0; i < inputEls.length; i++) {
		inputEls[i].onchange = editPoint;
		inputEls[i].source = source;
	}

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
		const map = evt.map,
			extent = ol.extent.createEmpty(); // For focus on all features calculation

		optimiseEdited(); // Treat the geoJson input as any other edit

		// Add required controls
		if (options.titleModify || options.dragPoint) {
			map.addControl(controlModify);
			controlModify.toggle(true);
		}
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
				maxZoom: options.focus,
				size: map.getSize(),
				padding: [5, 5, 5, 5],
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

	//BEST+ move only one summit when dragging

	modify.on('modifyend', function(evt) {
		//BEST Ctrl+Alt+click on summit : delete the line or poly

		// Ctrl+Alt+click on segment : delete the line or poly
		if (evt.mapBrowserEvent.originalEvent.ctrlKey &&
			evt.mapBrowserEvent.originalEvent.altKey) {
			const selectedFeatures = layer.map_.getFeaturesAtPixel(
				evt.mapBrowserEvent.pixel, {
					hitTolerance: 6, // Default is 0
					layerFilter: function(l) {
						return l.ol_uid == layer.ol_uid;
					}
				});

			for (let f in selectedFeatures) // We delete the selected feature
				source.removeFeature(selectedFeatures[f]);
		}

		// Alt+click on segment : delete the segment & split the line
		const newFeature = snap.snapTo(
			evt.mapBrowserEvent.pixel,
			evt.mapBrowserEvent.coordinate,
			snap.getMap()
		);
		if (evt.mapBrowserEvent.originalEvent.altKey)
			optimiseEdited(newFeature.vertex);

		// Finish
		optimiseEdited();
		hoveredFeature = null; // Recover hovering
	});

	// End of feature creation
	source.on('change', function() { // Called all sliding long
		if (source.modified) { // Awaiting adding complete to save it
			source.modified = false; // To avoid loops

			// Finish
			optimiseEdited();
			hoveredFeature = null; // Recover hovering
		}
	});

	function activate(state, inter) { // Callback at activation / desactivation, mandatory, no default
		if (state) {
			layer.map_.addInteraction(inter);
			layer.map_.addInteraction(snap); // Must be added after
		} else {
			layer.map_.removeInteraction(snap);
			layer.map_.removeInteraction(inter);
		}
	}

	function controlDraw(options) {
		const control = controlButton(Object.assign({
				group: 'edit',
				buttonBackgroundColors: ['white', '#ef3'],
				activate: function(state) {
					activate(state, interaction);
				},
			}, options)),
			interaction = new ol.interaction.Draw(Object.assign({
				style: editStyle,
				source: source,
				stopClick: true, // Avoid zoom when you finish drawing by doubleclick
			}, options));

		interaction.on(['drawend'], function() {
			// Switch on the main editor button
			controlModify.toggle(true);

			// Warn source 'on change' to save the feature
			// Don't do it now as it's not yet added to the source
			source.modified = true;
		});
		return control;
	}

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

	layer.centerMarker = function() {
		source.getFeatures().forEach(function(f) {
			f.getGeometry().setCoordinates(
				layer.map_.getView().getCenter()
			);
		});
		optimiseEdited(); // Check CH1903 feilds visibility
	};

	layer.centerMap = function() {
		source.getFeatures().forEach(function(f) {
			layer.map_.getView().setCenter(
				f.getGeometry().getCoordinates()
			);
		});
	};

	//BEST make separate position control
	function editPoint(evt) {
		const ll = evt.target.name.length == 3 ?
			ol.proj.transform([inputEls.lon.value, inputEls.lat.value], 'EPSG:4326', 'EPSG:3857') : // Modify lon | lat
			ol.proj.transform([parseInt(inputEls.x.value), parseInt(inputEls.y.value)], 'EPSG:21781', 'EPSG:3857'); // Modify x | y

		evt.target.source.getFeatures().forEach(function(f) {
			f.getGeometry().setCoordinates(ll);
		});

		optimiseEdited();
	}

	function displayPoint(ll) {
		if (displayPointEl) {
			const ll4326 = ol.proj.transform(ll, 'EPSG:3857', 'EPSG:4326'),
				formats = {
					decimal: ['Degrés décimaux', 'EPSG:4326', 'format',
						'Longitude: {x}, Latitude: {y}',
						5
					],
					degminsec: ['Deg Min Sec', 'EPSG:4326', 'toStringHDMS'],
				};

			let ll21781 = null;
			if (typeof proj4 == 'function') {
				// Specific Swiss coordinates EPSG:21781 (CH1903 / LV03)
				if (ol.extent.containsCoordinate([664577, 5753148, 1167741, 6075303], ll)) {
					proj4.defs('EPSG:21781', '+proj=somerc +lat_0=46.95240555555556 +lon_0=7.439583333333333 +k_0=1 +x_0=600000 +y_0=200000 +ellps=bessel +towgs84=660.077,13.551,369.344,2.484,1.783,2.939,5.66 +units=m +no_defs');
					ol.proj.proj4.register(proj4);
					ll21781 = ol.proj.transform(ll, 'EPSG:3857', 'EPSG:21781');

					formats.swiss = ['Suisse', 'EPSG:21781', 'format', 'X= {x} Y= {y} (CH1903)'];
				}

				// Fuseau UTM
				const u = Math.floor(ll4326[0] / 6 + 90) % 60 + 1;
				formats.utm = ['UTM', 'EPSG:326' + u, 'format', 'UTM ' + u + ' lon: {x}, lat: {y}'];
				proj4.defs('EPSG:326' + u, '+proj=utm +zone=' + u + ' +ellps=WGS84 +datum=WGS84 +units=m +no_defs');
				ol.proj.proj4.register(proj4);
			}
			// Display or not the EPSG:21781 coordinates
			const epsg21781 = document.getElementsByClassName('epsg-21781');
			for (let e = 0; e < epsg21781.length; e++)
				epsg21781[e].style.display = ll21781 ? '' : 'none';

			if (inputEls.length)
				// Set the html input
				for (let i = 0; i < inputEls.length; i++)
					switch (inputEls[i].name) {
						case 'lon':
							inputEls[i].value = Math.round(ll4326[0] * 100000) / 100000;
							break;
						case 'lat':
							inputEls[i].value = Math.round(ll4326[1] * 100000) / 100000;
							break;
						case 'x':
							inputEls[i].value = ll21781 ? Math.round(ll21781[0]) : '-';
							break;
						case 'y':
							inputEls[i].value = ll21781 ? Math.round(ll21781[1]) : '-';
							break;
					}
			else {
				// Set the html display
				if (!formats[options.displayFormat])
					options.displayFormat = 'decimal';

				let f = formats[options.displayFormat],
					html = ol.coordinate[f[2]](
						ol.proj.transform(ll, 'EPSG:3857', f[1]),
						f[3], f[4], f[5]
					) + ' <select>';

				for (let f in formats)
					html += '<option value="' + f + '"' +
					(f == options.displayFormat ? ' selected="selected"' : '') + '>' +
					formats[f][0] + '</option>';

				displayPointEl.innerHTML = html.replace(
					/( [-0-9]+)([0-9][0-9][0-9],? )/g,
					function(whole, part1, part2) {
						return part1 + ' ' + part2;
					}
				) + '</select>';
			}
			// Select action
			const selects = displayPointEl.getElementsByTagName('select');
			if (selects.length)
				selects[0].onchange = function(evt) {
					options.displayFormat = evt.target.value;
					displayPoint(ll);
				};
		}
	}

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

	function optimiseEdited(deleteCoords) {
		const coords = optimiseFeatures(
			source.getFeatures(),
			options.titleLine,
			options.titlePolygon,
			true,
			true,
			deleteCoords
		);

		// Recreate features
		source.clear();
		if (options.singlePoint) {
			// Initialise the marker at the center on the map if no coords are available
			coords.points.push(layer.map_.getView().getCenter());

			// Keep only the first point
			if (coords.points[0])
				source.addFeature(new ol.Feature({
					geometry: new ol.geom.Point(coords.points[0]),
					draggable: options.dragPoint,
				}));
		} else {
			for (let p in coords.points)
				source.addFeature(new ol.Feature({
					geometry: new ol.geom.Point(coords.points[p]),
					draggable: options.dragPoint,
				}));
			for (let l in coords.lines)
				source.addFeature(new ol.Feature({
					geometry: new ol.geom.LineString(coords.lines[l]),
				}));
			for (let p in coords.polys)
				source.addFeature(new ol.Feature({
					geometry: new ol.geom.Polygon(coords.polys[p]),
				}));
		}

		// Display & edit 1st point coordinates
		if (coords.points.length && displayPointEl)
			displayPoint(coords.points[0]);

		// Save geometries in <EL> as geoJSON at every change
		if (geoJsonEl)
			geoJsonEl.value = options.saveFeatures(coords, options.format);
	}

	return layer;
}

/**
 * Refurbish Points, Lines & Polygons
 * Split lines having a summit at deleteCoords
 * Common to controlDownload & layerEditGeoJson 
 */
function optimiseFeatures(features, withLines, withPolygons, merge, holes, deleteCoords) {
	const points = [],
		lines = [],
		polys = [];

	// Get all edited features as array of coordinates
	for (let f in features)
		flatFeatures(features[f].getGeometry(), points, lines, polys, deleteCoords);

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

	// Make polygons with looped lines
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
				polys.push([lines[a]]); // Add the polygon
				delete lines[a]; // Forget the line
			}
		}

	// Makes holes if a polygon is included in a biggest one
	for (let p1 in polys) // Explore all Polygons combinaison
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
		points: points,
		lines: lines.filter(Boolean), // Remove deleted array members
		polys: polys.filter(Boolean),
	};

	function flatFeatures(geom, points, lines, polys, deleteCoords) {
		// Expand geometryCollection
		if (geom.getType() == 'GeometryCollection') {
			const geometries = geom.getGeometries();
			for (let g in geometries)
				flatFeatures(geometries[g], points, lines, polys, deleteCoords);
		}
		// Point
		else if (geom.getType().match(/point$/i))
			points.push(geom.getCoordinates());

		// line & poly
		else
			flatCoord(lines, geom.getCoordinates(), deleteCoords); // Get lines or polyons as flat array of coords
	}

	// Get all lines fragments (lines, polylines, polygons, multipolygons, hole polygons, ...)
	// at the same level & split if one point = deleteCoords
	function flatCoord(existingCoords, newCoords, deleteCoords) {
		if (typeof newCoords[0][0] == 'object') // Multi*
			for (let c1 in newCoords)
				flatCoord(existingCoords, newCoords[c1], deleteCoords);
		else {
			existingCoords.push([]); // Add a new segment

			for (let c2 in newCoords)
				if (deleteCoords && compareCoords(newCoords[c2], deleteCoords))
					existingCoords.push([]); // Ignore this point and add a new segment
				else
					// Stack on the last existingCoords array
					existingCoords[existingCoords.length - 1].push(newCoords[c2]);
		}
	}

	function compareCoords(a, b) {
		if (!a)
			return false;
		if (!b)
			return compareCoords(a[0], a[a.length - 1]); // Compare start with end
		return a[0] == b[0] && a[1] == b[1]; // 2 coords
	}
}