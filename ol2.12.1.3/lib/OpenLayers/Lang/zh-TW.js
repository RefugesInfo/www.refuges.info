/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["zh-TW"]
 * Dictionary for Traditional Chinese. (Used Mainly in Taiwan) 
 * Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang["zh-TW"] = {

    'unhandledRequest': "æªèççè«æ±ï¼å³åå¼çº ${statusText}ã",

    'Permalink': "æ°¸ä¹é£çµ",

    'Overlays': "é¡å¤åå±¤",

    'Base Layer': "åºç¤åå±¤",

    'noFID': "å çºæ²æ FID æä»¥ç¡æ³æ´æ° featureã",

    'browserNotSupported':
        "æ¨ççè¦½å¨æªæ¯æ´åéæ¸²æ. ç®åæ¯æ´çæ¸²ææ¹å¼æ¯:\n${renderers}",

    // console message
    'minZoomLevelError':
        "minZoomLevel å±¬æ§åé©åç¨å¨ " +
        "FixedZoomLevels-descendent é¡åçåå±¤. éå" +
        "wfs layer ç minZoomLevel æ¯éå»æéºçä¸ä¾çï¼" +
        "ç¶èæåä¸è½ç§»é¤å®èä¸è®å®å°" +
        "éå»çç¨å¼ç¸å®¹æ§çµ¦ç ´å£æã" +
        "å æ­¤æåå°æè¿´é¿ä½¿ç¨å® -- minZoomLevel " +
        "æå¨3.0è¢«ç§»é¤ï¼è«æ¹" +
        "ç¨å¨ééæè¿°ç min/max resolution è¨­å®: " +
        "http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "WFS Transaction: æå ${response}",

    'commitFailed': "WFS Transaction: å¤±æ ${response}",

    'googleWarning':
        "The Google Layer åå±¤ç¡æ³è¢«æ­£ç¢ºçè¼å¥ã<br><br>" +
        "è¦è¿´é¿éåè¨æ¯, è«å¨å³ä¸è§çåå±¤æ¹è®å¨è£¡ï¼" +
        "é¸ä¸åæ°çåºç¤åå±¤ã<br><br>" +
        "å¾æå¯è½æ¯å çº Google Maps çå½å¼åº«" +
        "è³æ¬æ²æè¢«æ­£ç¢ºçç½®å¥ï¼ææ²æåå« " +
        "æ¨ç¶²ç«ä¸æ­£ç¢ºç API key <br><br>" +
        "éç¼è: è¦å¹«å©éåè¡çºæ­£ç¢ºå®æï¼" +
        "<a href='http://trac.openlayers.org/wiki/Google' " +
        "target='_blank'>è«æéè£¡</a>",

    'getLayerWarning':
        "${layerType} åå±¤ç¡æ³è¢«æ­£ç¢ºçè¼å¥ã<br><br>" +
        "è¦è¿´é¿éåè¨æ¯, è«å¨å³ä¸è§çåå±¤æ¹è®å¨è£¡ï¼" +
        "é¸ä¸åæ°çåºç¤åå±¤ã<br><br>" +
        "å¾æå¯è½æ¯å çº ${layerLib} çå½å¼åº«" +
        "è³æ¬æ²æè¢«æ­£ç¢ºçç½®å¥ã<br><br>" +
        "éç¼è: è¦å¹«å©éåè¡çºæ­£ç¢ºå®æï¼" +
        "<a href='http://trac.openlayers.org/wiki/${layerLib}' " +
        "target='_blank'>è«æéè£¡</a>",

    'Scale = 1 : ${scaleDenom}': "Scale = 1 : ${scaleDenom}",

    // console message
    'reprojectDeprecated':
        "ä½ æ­£ä½¿ç¨ 'reproject' éåé¸é  " +
        "å¨ ${layerName} å±¤ãéåé¸é å·²ç¶ä¸åä½¿ç¨:" +
        "å®çä½¿ç¨åæ¬æ¯è¨­è¨ç¨ä¾æ¯æ´å¨åæ¥­å°åä¸ç§åºè³æï¼" + 
        "ä½éååè½å·²ç¶è¢«" +
        "Spherical Mercatoræåä»£ãæ´å¤çè³è¨å¯ä»¥å¨ " +
        "http://trac.openlayers.org/wiki/SphericalMercator æ¾å°ã",

    // console message
    'methodDeprecated':
        "éåæ¹æ³å·²ç¶ä¸åä½¿ç¨ä¸å¨3.0å°æè¢«ç§»é¤ï¼" +
        "è«ä½¿ç¨ ${newMethod} ä¾ä»£æ¿ã",

    'end': ''
};
