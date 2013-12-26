/*DCM++ © Dominique Cavailhez 2012
 * Published under the Clear BSD license.
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the full text of the license. */
 
/**
 * Namespace: Util
 */

// On mémorise le contenu des cookies à l'entrée de la page, sinon ils sont écrasés
OpenLayers.Util.initialCookies = document.cookie;

OpenLayers.Util.writeCookie = function (nom, valeur, expire) { // "expire" en secondes aprés le temps présent
	if (typeof expire == 'undefined')
		expire = false;
	if (expire == true)
		expire = new Date (); // Pour supprimer le Cookie
	document.cookie =
		'Ol' + escape (nom) + '=' + escape (valeur) + ';path=/'
		+ (expire ? ';expires=' + new Date (new Date().getTime() + expire*1000).toGMTString() : '');
}

OpenLayers.Util.readCookie = function (nom, defaut) {
	var nom = 'Ol' + escape (nom);
	var deb = OpenLayers.Util.initialCookies.indexOf (nom + '=');
	if (deb >= 0) {
		deb += nom.length + 1;
		var fin = OpenLayers.Util.initialCookies.indexOf (';',deb);
		if (fin < 0) fin = OpenLayers.Util.initialCookies.length;
		return unescape (OpenLayers.Util.initialCookies.substring (deb, fin));
	}
	return typeof defaut == 'undefined' ? null : defaut;
}
