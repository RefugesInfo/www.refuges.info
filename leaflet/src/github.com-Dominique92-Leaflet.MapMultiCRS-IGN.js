/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Projections Lambert et couches IGN
 */

/* Nécéssite la déclaration des clés avant de charger ce fichier
	<script type="text/javascript">
		var key = {
			ign: "123456789abcdef",
		};
	</script>
 *
 * Clé V3 développement sur: http://api.ign.fr
 * Clé V3 production sur: http://pro.ign.fr/api-web => Service en ligne => S'ABONNER
 * Doc sur http://api.ign.fr/jsp/site/Portal.jsp?page_id=6&document_id=80&dossier_id=53
 * IGN & photo sont automatiquement autorisé sur //localhost
 */

// Les projections Lambert
L.CRS.EPSG27571 = L.extend({},
	new L.Proj.CRS('EPSG:27571', '+title=Lambert zone 1 , LCC +proj=lcc +lat_1=49.50000000000001 +lat_0=49.50000000000001 +lon_0=0 +k_0=0.999877341 +x_0=600000 +y_0=1200000 +a=6378249.2 +b=6356515 +towgs84=-168,-60,320,0,0,0,0 +pm=paris +units=m +no_defs'), {
		bounds: L.bounds([-5.2, 48.15], [8.23, 51.1]),
		nom: 'Lambert I (Nord)'
	}
);

L.CRS.EPSG27572 = L.extend({},
	L.CRS.EPSG27571, // On récupère les fonctions de base
	new L.Proj.CRS('EPSG:27572', '+title=Lambert 2 étendue, LCC +proj=lcc +lat_1=46.8 +lat_0=46.8 +lon_0=0 +k_0=0.99987742 +x_0=600000 +y_0=2200000 +a=6378249.2 +b=6356515 +towgs84=-168,-60,320,0,0,0,0 +pm=paris +units=m +no_defs'), {
		bounds: L.bounds([-5.2, 42.25], [8.23, 51.1]),
		nom: 'Lambert II (Centre)'
	}
);

L.CRS.EPSG27573 = L.extend({},
	L.CRS.EPSG27571, // On récupère les fonctions de base
	new L.Proj.CRS('EPSG:27573', '+title=Lambert zone 3, LCC +proj=lcc +lat_1=44.10000000000001 +lat_0=44.10000000000001 +lon_0=0 +k_0=0.999877499 +x_0=600000 +y_0=3200000 +a=6378249.2 +b=6356515 +towgs84=-168,-60,320,0,0,0,0 +pm=paris +units=m +no_defs'), {
		bounds: L.bounds([-1.76, 42.33], [7.77, 45.45]),
		nom: 'Lambert III (Sud)'
	}
);

L.CRS.EPSG27574 = L.extend({},
	L.CRS.EPSG27571, // On récupère les fonctions de base
	new L.Proj.CRS('EPSG:27574', '+title=Lambert zone 4, +proj=lcc +lat_1=42.16500000000001 +lat_0=42.16500000000001 +lon_0=0 +k_0=0.99994471 +x_0=234.358 +y_0=4185861.369 +a=6378249.2 +b=6356515 +towgs84=-168,-60,320,0,0,0,0 +pm=paris +units=m +no_defs'), {
		bounds: L.bounds([8.5, 41.33], [9.6, 43.05]),
		nom: 'Lambert IV (Corse)'
	}
);

// Le layer
L.TileLayer.IGN = L.TileLayer.extend({
	options: {
		l: 'GEOGRAPHICALGRIDSYSTEMS.MAPS',
		attribution: '&copy; <a href="http://www.ign.fr/">IGN</a>',
		url: "http://gpp3-wxs.ign.fr/" +
			(typeof key == 'object' ? key.ign : null) +
			"/wmts" +
			"?LAYER={l}" +
			"&EXCEPTIONS=text/xml" +
			"&FORMAT=image/jpeg" +
			"&SERVICE=WMTS" +
			"&VERSION=1.0.0" +
			"&REQUEST=GetTile" +
			"&STYLE=normal" +
			"&TILEMATRIXSET=PM" +
			"&TILEMATRIX={z}" +
			"&TILECOL={x}" +
			"&TILEROW={y}"
	},

	initialize: function(layer, options) {
		L.setOptions(this, options);
		if (layer)
			this.options.l = layer;
		L.TileLayer.prototype.initialize.call(this, this.options.url);
	}
});