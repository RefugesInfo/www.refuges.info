L.Control.GetGpxFile = L.Control.extend({
    statics: {
        TITLE: 'Download to GPX file',
        LABEL: '&#128427;'
    },
    options: {
        position: 'topleft'
    },

    initialize: function (layer, options) {
        L.Util.setOptions(this, options);
        this._layer = layer; // Layer to get GPX download
    },

    onAdd: function (map) {
        // Create a button, and bind click on hidden file input
        var zoomName = 'leaflet-control-filelayer leaflet-control-zoom',
            barName = 'leaflet-bar',
            partName = barName + '-part',
            container = L.DomUtil.create('div', zoomName + ' ' + barName);
        var link = L.DomUtil.create('a', zoomName + '-in ' + partName, container);
        link.innerHTML = L.Control.GetGpxFile.LABEL;
        link.href = '#';
        link.title = L.Control.GetGpxFile.TITLE;

        L.DomEvent.disableClickPropagation(link);
        L.DomEvent.on(link, 'click', function (e) {
			this.download( prompt("Save as", "track.gpx"), togpx(this._layer.toGeoJSON()).replace (/><([a-z])/gi, ">\n<$1"));
        }, this);
        return container;
    },

    download: function (filename, text) {
		var pom = document.createElement('a');
		pom.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
		pom.setAttribute('download', filename);
		
	//	pom.addEventListener('click', true, true); 
	//alert(pom.addEventListener);

	/*
	var event = new MouseEvent('click', {
		'view': window,
		'bubbles': true,
		'cancelable': true
	  });
	dom.dispatchEvent(event);

	*/
	//    if (document.createEvent) {alert();
	//GEO TODO As of Microsoft Edge, the createEvent()/initEvent() constructor pattern for synthetic events is deprecated. See the Synthetic Events
		var event = document.createEvent('MouseEvents');
		event.initEvent('click', true, true);
		pom.dispatchEvent(event);
	/*    }
		else {
			pom.click();
		}*/
    }
});
