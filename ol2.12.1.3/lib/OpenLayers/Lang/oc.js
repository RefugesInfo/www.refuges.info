/* Translators (2009 onwards):
 *  - Cedric31
 */

/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["oc"]
 * Dictionary for Occitan.  Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang["oc"] = OpenLayers.Util.applyDefaults({

    'unhandledRequest': "RequÃ¨sta pas gerida, retorna ${statusText}",

    'Permalink': "Permaligam",

    'Overlays': "Calques",

    'Base Layer': "Calc de basa",

    'noFID': "Impossible de metre a jorn un objÃ¨cte sens identificant (fid).",

    'browserNotSupported': "VÃ²stre navegidor supÃ²rta pas lo rendut vectorial. Los renderers actualament suportats son : \n${renderers}",

    'minZoomLevelError': "La proprietat minZoomLevel deu Ã¨sser utilizada solament per de jaces FixedZoomLevels-descendent. Lo fach qu\'aqueste jaÃ§ WFS verifique la presÃ©ncia de minZoomLevel es una relica del passat. ÃaquelÃ , la podÃ¨m suprimir sens copar d\'aplicacions que ne poiriÃ¡n dependre. Es per aquÃ² que la depreciam -- la verificacion del minZoomLevel serÃ  suprimida en version 3.0. A la plaÃ§a, mercÃ©s d\'utilizar los paramÃ¨tres de resolucions min/max tal coma descrich sus : http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "Transaccion WFS : SUCCES ${response}",

    'commitFailed': "Transaccion WFS : FRACAS ${response}",

    'googleWarning': "Lo jaÃ§ Google es pas estat en mesura de se cargar corrÃ¨ctament.\x3cbr\x3e\x3cbr\x3ePer suprimir aqueste messatge, causissÃ¨tz una BaseLayer novÃ¨la dins lo selector de jaÃ§ en naut a drecha.\x3cbr\x3e\x3cbr\x3eAquÃ² es possiblament causat par la non-inclusion de la librariÃ¡ Google Maps, o alara perque que la clau de l\'API correspond pas a vÃ²stre site.\x3cbr\x3e\x3cbr\x3eDesvolopaires : per saber cossÃ­ corregir aquÃ², \x3ca href=\'http://trac.openlayers.org/wiki/Google\' target=\'_blank\'\x3eclicatz aicÃ­\x3c/a\x3e",

    'getLayerWarning': "Lo jaÃ§ ${layerType} es pas en mesura de se cargar corrÃ¨ctament.\x3cbr\x3e\x3cbr\x3ePer suprimir aqueste messatge, causissÃ¨tz una  BaseLayer novÃ¨la dins lo selector de jaÃ§ en naut a drecha.\x3cbr\x3e\x3cbr\x3eAquÃ² es possiblament causat per la non-inclusion de la librariÃ¡ ${layerLib}.\x3cbr\x3e\x3cbr\x3eDesvolopaires : per saber cossÃ­ corregir aquÃ­, \x3ca href=\'http://trac.openlayers.org/wiki/${layerLib}\' target=\'_blank\'\x3eclicatz aicÃ­\x3c/a\x3e",

    'Scale = 1 : ${scaleDenom}': "Escala ~ 1 : ${scaleDenom}",

    'W': "O",

    'E': "Ã",

    'N': "N",

    'S': "S",

    'reprojectDeprecated': "Utilizatz l\'opcion \'reproject\' sul jaÃ§ ${layerName}. Aquesta opcion es despreciada : Son usatge permetiÃ¡ d\'afichar de donadas al dessÃºs de jaces raster comercials. Aquesta foncionalitat ara es suportada en utilizant lo supÃ²rt de la projeccion Mercator Esferica. Mai d\'informacion es disponibla sus http://trac.openlayers.org/wiki/SphericalMercator.",

    'methodDeprecated': "Aqueste metÃ²de es despreciada, e serÃ  suprimida a la version 3.0. MercÃ©s d\'utilizar ${newMethod} a la plaÃ§a."

});
