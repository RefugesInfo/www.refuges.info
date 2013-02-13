/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["es"]
 * Dictionary for Spanish, UTF8 encoding. Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang.es = {

    'unhandledRequest': "Respuesta a peticiÃ³n no gestionada ${statusText}",

    'Permalink': "Enlace permanente",

    'Overlays': "Capas superpuestas",

    'Base Layer': "Capa Base",

    'noFID': "No se puede actualizar un elemento para el que no existe FID.",

    'browserNotSupported':
        "Su navegador no soporta renderizaciÃ³n vectorial. Los renderizadores soportados actualmente son:\n${renderers}",

    // console message
    'minZoomLevelError':
        "La propiedad minZoomLevel debe sÃ³lo utilizarse " +
        "con las capas que tienen FixedZoomLevels. El hecho de que " +
        "una capa wfs compruebe minZoomLevel es una reliquia del " +
        "pasado. Sin embargo, no podemos eliminarla sin discontinuar " +
        "probablemente las aplicaciones OL que puedan depender de ello. " +
        "AsÃ­ pues estamos haciÃ©ndolo obsoleto --la comprobaciÃ³n " +
        "minZoomLevel se eliminarÃ¡ en la versiÃ³n 3.0. Utilice el ajuste " +
        "de resolution min/max en su lugar, tal como se describe aquÃ­: " +
        "http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "TransacciÃ³n WFS: ÃXITO ${response}",

    'commitFailed': "TransacciÃ³n WFS: FALLÃ ${response}",

    'googleWarning':
        "La capa Google no pudo ser cargada correctamente.<br><br>" +
        "Para evitar este mensaje, seleccione una nueva Capa Base " +
        "en el selector de capas en la esquina superior derecha.<br><br>" +
        "Probablemente, esto se debe a que el script de la biblioteca de " +
	"Google Maps no fue correctamente incluido en su pÃ¡gina, o no " +
	"contiene la clave del API correcta para su sitio.<br><br>" +
        "Desarrolladores: Para ayudar a hacer funcionar esto correctamente, " +
        "<a href='http://trac.openlayers.org/wiki/Google' " +
        "target='_blank'>haga clic aquÃ­</a>",

    'getLayerWarning':
        "La capa ${layerType} no pudo ser cargada correctamente.<br><br>" +
        "Para evitar este mensaje, seleccione una nueva Capa Base " +
        "en el selector de capas en la esquina superior derecha.<br><br>" +
        "Probablemente, esto se debe a que el script de " +
	"la biblioteca ${layerLib} " +
        "no fue correctamente incluido en su pÃ¡gina.<br><br>" +
        "Desarrolladores: Para ayudar a hacer funcionar esto correctamente, " +
        "<a href='http://trac.openlayers.org/wiki/${layerLib}' " +
        "target='_blank'>haga clic aquÃ­</a>",

    'Scale = 1 : ${scaleDenom}': "Escala = 1 : ${scaleDenom}",

    //labels for the graticule control
    'W': 'O',
    'E': 'E',
    'N': 'N',
    'S': 'S',
    'Graticule': 'RetÃ­cula',
    
    // console message
    'reprojectDeprecated':
        "EstÃ¡ usando la opciÃ³n 'reproject' en la capa " +
        "${layerName}. Esta opciÃ³n es obsoleta: su uso fue diseÃ±ado " +
        "para soportar la visualizaciÃ³n de datos sobre mapas base comerciales, " + 
        "pero ahora esa funcionalidad deberÃ­a conseguirse mediante el soporte " +
        "de la proyecciÃ³n Spherical Mercator. MÃ¡s informaciÃ³n disponible en " +
        "http://trac.openlayers.org/wiki/SphericalMercator.",

    // console message
    'methodDeprecated':
        "Este mÃ©todo es obsoleto y se eliminarÃ¡ en la versiÃ³n 3.0. " +
        "Por favor utilice el mÃ©todo ${newMethod} en su lugar.",

    // **** end ****
    'end': ''

};
