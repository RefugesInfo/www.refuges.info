/* Translators (2009 onwards):
 *  - ToliÃ±o
 */

/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["gl"]
 * Dictionary for Galego.  Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang["gl"] = OpenLayers.Util.applyDefaults({

    'unhandledRequest': "Solicitude non xerada; a resposta foi: ${statusText}",

    'Permalink': "LigazÃ³n permanente",

    'Overlays': "Capas superpostas",

    'Base Layer': "Capa base",

    'noFID': "Non se pode actualizar a funcionalidade para a que non hai FID.",

    'browserNotSupported': "O seu navegador non soporta a renderizaciÃ³n de vectores. Os renderizadores soportados actualmente son:\n${renderers}",

    'minZoomLevelError': "A propiedade minZoomLevel Ã© sÃ³ para uso conxuntamente coas capas FixedZoomLevels-descendent. O feito de que esa capa wfs verifique o minZoomLevel Ã© unha reliquia do pasado. Non podemos, con todo, eliminala sen a posibilidade de non romper as aplicaciÃ³ns baseadas en OL que poidan depender dela. Por iso a estamos deixando obsoleta (a comprobaciÃ³n minZoomLevel de embaixo serÃ¡ eliminada na versiÃ³n 3.0). Por favor, no canto diso use o axuste de resoluciÃ³n mÃ­n/mÃ¡x tal e como estÃ¡ descrito aquÃ­: http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "TransacciÃ³n WFS: ÃXITO ${response}",

    'commitFailed': "TransacciÃ³n WFS: FALLIDA ${response}",

    'googleWarning': "A capa do Google non puido cargarse correctamente.\x3cbr\x3e\x3cbr\x3ePara evitar esta mensaxe, escolla unha nova capa base no seleccionador de capas na marxe superior dereita.\x3cbr\x3e\x3cbr\x3eProbablemente, isto acontece porque a escritura da librarÃ­a do Google Maps ou ben non foi incluÃ­da ou ben non contÃ©n a clave API correcta para o seu sitio.\x3cbr\x3e\x3cbr\x3eDesenvolvedores: para axudar a facer funcionar isto correctamente, \x3ca href=\'http://trac.openlayers.org/wiki/Google\' target=\'_blank\'\x3epremede aquÃ­\x3c/a\x3e",

    'getLayerWarning': "A capa ${layerType} foi incapaz de cargarse correctamente.\x3cbr\x3e\x3cbr\x3ePara evitar esta mensaxe, escolla unha nova capa base no seleccionador de capas na marxe superior dereita.\x3cbr\x3e\x3cbr\x3eProbablemente, isto acontece porque a escritura da librarÃ­a ${layerLib} non foi ben incluÃ­da.\x3cbr\x3e\x3cbr\x3eDesenvolvedores: para axudar a facer funcionar isto correctamente, \x3ca href=\'http://trac.openlayers.org/wiki/${layerLib}\' target=\'_blank\'\x3epremede aquÃ­\x3c/a\x3e",

    'Scale = 1 : ${scaleDenom}': "Escala = 1 : ${scaleDenom}",

    'W': "O",

    'E': "L",

    'N': "N",

    'S': "S",

    'reprojectDeprecated': "EstÃ¡ usando a opciÃ³n \"reproject\" na capa ${layerName}. Esta opciÃ³n estÃ¡ obsoleta: o seu uso foi deseÃ±ado para a visualizaciÃ³n de datos sobre mapas base comerciais, pero esta funcionalidade debera agora ser obtida utilizando a proxecciÃ³n Spherical Mercator. Hai dispoÃ±ible mÃ¡is informaciÃ³n en http://trac.openlayers.org/wiki/SphericalMercator.",

    'methodDeprecated': "Este mÃ©todo estÃ¡ obsoleto e serÃ¡ eliminado na versiÃ³n 3.0. Por favor, no canto deste use ${newMethod}."

});
