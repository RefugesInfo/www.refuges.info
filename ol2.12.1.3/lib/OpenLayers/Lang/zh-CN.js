/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["zh-CN"]
 * Dictionary for Simplified Chinese.  Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang["zh-CN"] = {

    'unhandledRequest': "æªå¤ççè¯·æ±ï¼è¿åå¼ä¸º ${statusText}",

    'Permalink': "æ°¸ä¹é¾æ¥",

    'Overlays': "å å å±",

    'Base Layer': "åºç¡å¾å±",

    'noFID': "æ æ³æ´æ°featureï¼ç¼ºå°FIDã",

    'browserNotSupported':
        "ä½ ä½¿ç¨çæµè§å¨ä¸æ¯æç¢éæ¸²æãå½åæ¯æçæ¸²ææ¹å¼åæ¬ï¼\n${renderers}",

    // console message
    'minZoomLevelError':
        "minZoomLevelå±æ§ä»éåç¨äº" +
        "ä½¿ç¨äºåºå®ç¼©æ¾çº§å«çå¾å±ãè¿ä¸ª " +
        "wfs å¾å±æ£æ¥ minZoomLevel æ¯è¿å»éçä¸æ¥çã" +
        "ç¶èï¼æä»¬ä¸è½ç§»é¤å®ï¼" +
        "èç ´åä¾èµäºå®çåºäºOLçåºç¨ç¨åºã" +
        "å æ­¤ï¼æä»¬åºé¤äºå® -- minZoomLevel " +
        "å°ä¼å¨3.0ä¸­è¢«ç§»é¤ãè¯·æ¹ç¨ " +
        "min/max resolution è®¾ç½®ï¼åèï¼" +
        "http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "WFS Transaction: æåã ${response}",

    'commitFailed': "WFS Transaction: å¤±è´¥ã ${response}",

    'googleWarning':
        "Googleå¾å±ä¸è½æ­£ç¡®å è½½ã<br><br>" +
        "è¦æ¶é¤è¿ä¸ªä¿¡æ¯ï¼è¯·å¨å³ä¸è§ç" +
        "å¾å±æ§å¶é¢æ¿ä¸­éæ©å¶ä»çåºç¡å¾å±ã<br><br>" +
        "è¿ç§æåµå¾å¯è½æ¯æ²¡ææ­£ç¡®çåå«Googleå°å¾èæ¬åºï¼" +
        "æèæ¯æ²¡æåå«å¨ä½ çç«ç¹ä¸" +
        "ä½¿ç¨çæ­£ç¡®çGoogle Maps APIå¯åã<br><br>" +
        "å¼åèï¼è·åä½¿å¶æ­£ç¡®å·¥ä½çå¸®å©ä¿¡æ¯ï¼" +
        "<a href='http://trac.openlayers.org/wiki/Google' " +
        "target='_blank'>ç¹å»è¿é</a>",

    'getLayerWarning':
        "${layerType} å¾å±ä¸è½æ­£ç¡®å è½½ã<br><br>" +
        "è¦æ¶é¤è¿ä¸ªä¿¡æ¯ï¼è¯·å¨å³ä¸è§ç" +
        "å¾å±æ§å¶é¢æ¿ä¸­éæ©å¶ä»çåºç¡å¾å±ã<br><br>" +
        "è¿ç§æåµå¾å¯è½æ¯æ²¡ææ­£ç¡®çåå«" +
        "${layerLib} èæ¬åºã<br><br>" +
        "å¼åèï¼è·åä½¿å¶æ­£ç¡®å·¥ä½çå¸®å©ä¿¡æ¯ï¼" +
        "<a href='http://trac.openlayers.org/wiki/${layerLib}' " +
        "target='_blank'>ç¹å»è¿é</a>",

    'Scale = 1 : ${scaleDenom}': "æ¯ä¾å°º = 1 : ${scaleDenom}",

    // console message
    'reprojectDeprecated':
        "ä½ æ­£å¨ä½¿ç¨ ${layerName} å¾å±ä¸ç'reproject'éé¡¹ã" +
        "è¿ä¸ªéé¡¹å·²ç»ä¸åä½¿ç¨ï¼" +
        "å®æ¯è¢«è®¾è®¡ç¨æ¥æ¯ææ¾ç¤ºåä¸çå°å¾æ°æ®ï¼" + 
        "ä¸è¿ç°å¨è¯¥åè½å¯ä»¥éè¿ä½¿ç¨Spherical Mercatoræ¥å®ç°ã" +
        "æ´å¤ä¿¡æ¯å¯ä»¥åé" +
        "http://trac.openlayers.org/wiki/SphericalMercator.",

    // console message
    'methodDeprecated':
        "è¯¥æ¹æ³å·²ç»ä¸åè¢«æ¯æï¼å¹¶ä¸å°å¨3.0ä¸­è¢«ç§»é¤ã" +
        "è¯·ä½¿ç¨ ${newMethod} æ¹æ³æ¥æ¿ä»£ã",

    'end': ''
};
