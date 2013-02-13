/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["ca"]
 * Dictionary for Catalan, UTF8 encoding. Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang.ca = {

    'unhandledRequest': "Resposta a peticiÃ³ no gestionada ${statusText}",

    'Permalink': "EnllaÃ§ permanent",

    'Overlays': "Capes addicionals",

    'Base Layer': "Capa Base",

    'noFID': "No es pot actualitzar un element per al que no existeix FID.",

    'browserNotSupported':
        "El seu navegador no suporta renderitzaciÃ³ vectorial. Els renderitzadors suportats actualment sÃ³n:\n${renderers}",

    // console message
    'minZoomLevelError':
        "La propietat minZoomLevel s'ha d'utilitzar nomÃ©s " +
        "amb les capes que tenen FixedZoomLevels. El fet que " +
        "una capa wfs comprovi minZoomLevel Ã©s una relÃ­quia del " +
        "passat. No podem, perÃ², eliminar-la sense trencar " +
        "les aplicacions d'OpenLayers que en puguin dependre. " +
        "AixÃ­ doncs estem fent-la obsoleta -- la comprovaciÃ³ " +
        "minZoomLevel s'eliminarÃ  a la versiÃ³ 3.0. Feu servir " +
        "els parÃ metres min/max resolution en substituciÃ³, tal com es descriu aquÃ­: " +
        "http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "TransacciÃ³ WFS: CORRECTA ${response}",

    'commitFailed': "TransacciÃ³ WFS: HA FALLAT ${response}",

    'googleWarning':
        "La capa Google no s'ha pogut carregar correctament.<br><br>" +
        "Per evitar aquest missatge, seleccioneu una nova Capa Base " +
        "al gestor de capes de la cantonada superior dreta.<br><br>" +
        "Probablement aixÃ² Ã©s degut a que l'script de la biblioteca de " +
    "Google Maps no ha estat inclÃ²s a la vostra pÃ gina, o no " +
    "contÃ© la clau de l'API correcta per a la vostra adreÃ§a.<br><br>" +
        "Desenvolupadors: Per obtenir consells sobre com fer anar aixÃ², " +
        "<a href='http://trac.openlayers.org/wiki/Google' " +
        "target='_blank'>fÃ©u clic aquÃ­</a>",

    'getLayerWarning':
        "Per evitar aquest missatge, seleccioneu una nova Capa Base " +
        "al gestor de capes de la cantonada superior dreta.<br><br>" +
        "Probablement aixÃ² Ã©s degut a que l'script de la biblioteca " +
        "${layerLib} " +
        "no ha estat inclÃ²s a la vostra pÃ gina.<br><br>" +
        "Desenvolupadors: Per obtenir consells sobre com fer anar aixÃ², " +
        "<a href='http://trac.openlayers.org/wiki/${layerLib}' " +
        "target='_blank'>fÃ©u clic aquÃ­</a>",

    'Scale = 1 : ${scaleDenom}': "Escala = 1 : ${scaleDenom}",

    //labels for the graticule control
    'W': 'O',
    'E': 'E',
    'N': 'N',
    'S': 'S',
    'Graticule': 'RetÃ­cula',    
        
    // console message
    'reprojectDeprecated':
        "Esteu fent servir l'opciÃ³ 'reproject' a la capa " +
        "${layerName}. Aquesta opciÃ³ Ã©s obsoleta: el seu Ãºs fou concebut " +
        "per suportar la visualitzaciÃ³ de dades sobre mapes base comercials, " + 
        "perÃ² ara aquesta funcionalitat s'hauria d'assolir mitjanÃ§ant el suport " +
        "de la projecciÃ³ Spherical Mercator. MÃ©s informaciÃ³ disponible a " +
        "http://trac.openlayers.org/wiki/SphericalMercator.",

    // console message
    'methodDeprecated':
        "Aquest mÃ¨tode Ã©s obsolet i s'eliminarÃ  a la versiÃ³ 3.0. " +
        "Si us plau feu servir em mÃ¨tode alternatiu ${newMethod}.",

    // **** end ****
    'end': ''

};
