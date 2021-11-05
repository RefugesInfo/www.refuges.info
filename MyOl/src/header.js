// Validators adapters
/* jshint esversion: 6 */
if (!ol) var ol = {};

//HACK for some mobiles touch functions (IOS)
if (window.PointerEvent === undefined) {
	const script = document.createElement('script');
	script.src = 'https://unpkg.com/elm-pep';
	document.head.appendChild(script);
}

/**
 * Display OL version
 */
try {
	new ol.style.Icon(); // Try incorrect action
} catch (err) { // to get Assert url
	console.log('Ol ' + err.message.match('/v([0-9\.]+)/')[1]);
}

/**
 * Debug facilities on mobile
 */
//HACK use hash ## for error alerts
if (!window.location.hash.indexOf('##'))
	window.addEventListener('error', function(evt) {
		alert(evt.filename + ' ' + evt.lineno + ':' + evt.colno + '\n' + evt.message);
	});
//HACK use hash ### to route all console logs on alerts
if (window.location.hash == '###')
	console.log = function(message) {
		alert(message);
	};

//HACK Json parsing errors log
//BEST implement on layerVector.js & editor
function JSONparse(json) {
	try {
		return JSON.parse(json);
	} catch (returnCode) {
		console.log(returnCode + ' parsing : "' + json + '" ' + new Error().stack);
	}
}

//HACK warn layers when added to the map
//BEST DELETE (used by editor)
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