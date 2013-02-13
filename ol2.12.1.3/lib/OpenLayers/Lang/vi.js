/* Translators (2009 onwards):
 *  - Minh Nguyen
 */

/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["vi"]
 * Dictionary for Tiáº¿ng Viá»t.  Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang["vi"] = OpenLayers.Util.applyDefaults({

    'unhandledRequest': "KhÃ´ng xá»­ lÃ½ ÄÆ°á»£c pháº£n há»i ${statusText} cho yÃªu cáº§u",

    'Permalink': "LiÃªn káº¿t thÆ°á»ng trá»±c",

    'Overlays': "Láº¥p báº£n Äá»",

    'Base Layer': "Lá»p ná»n",

    'noFID': "KhÃ´ng thá» cáº­p nháº­t tÃ­nh nÄng thiáº¿u FID.",

    'browserNotSupported': "TrÃ¬nh duyá»t cá»§a báº¡n khÃ´ng há» trá»£ chá»©c nÄng váº½ báº±ng vectÆ¡. Hiá»n há» trá»£ cÃ¡c bá» káº¿t xuáº¥t:\n${renderers}",

    'minZoomLevelError': "Chá» nÃªn sá»­ dá»¥ng thuá»c tÃ­nh minZoomLevel vá»i cÃ¡c lá»p FixedZoomLevels-descendent. Viá»c lá»p wfs nÃ y tÃ¬m cho minZoomLevel lÃ  di tÃ­ch cÃ²n láº¡i tá»« xÆ°a. Tuy nhiÃªn, náº¿u chÃºng tÃ´i dá»i nÃ³ thÃ¬ sáº½ vá»¡ cÃ¡c chÆ°Æ¡ng trÃ¬nh OpenLayers mÃ  dá»±a trÃªn nÃ³. Bá»i váº­y chÃºng tÃ´i pháº£n Äá»i sá»­ dá»¥ng nÃ³\x26nbsp;â bÆ°á»c tÃ¬m cho minZoomLevel sáº½ ÄÆ°á»£c dá»i vÃ o phiÃªn báº£n 3.0. Xin sá»­ dá»¥ng thiáº¿t láº­p Äá» phÃ¢n tÃ­ch tá»i thiá»u / tá»i Äa thay tháº¿, theo hÆ°á»ng dáº«n nÃ y: http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "Giao dá»ch WFS: THÃNH CÃNG ${response}",

    'commitFailed': "Giao dá»ch WFS: THáº¤T Báº I ${response}",

    'googleWarning': "KhÃ´ng thá» táº£i lá»p Google ÄÃºng Äáº¯n.\x3cbr\x3e\x3cbr\x3eÄá» trÃ¡nh thÃ´ng bÃ¡o nÃ y láº§n sau, hÃ£y chá»n BaseLayer má»i dÃ¹ng Äiá»u khiá»n chá»n lá»p á» gÃ³c trÃªn pháº£i.\x3cbr\x3e\x3cbr\x3eCháº¯c script thÆ° viá»n Google Maps hoáº·c khÃ´ng ÄÆ°á»£c bao gá»m hoáº·c khÃ´ng chá»©a khÃ³a API há»£p vá»i website cá»§a báº¡n.\x3cbr\x3e\x3cbr\x3e\x3ca href=\'http://trac.openlayers.org/wiki/Google\' target=\'_blank\'\x3eTrá»£ giÃºp vá» tÃ­nh nÄng nÃ y\x3c/a\x3e cho ngÆ°á»i phÃ¡t triá»n.",

    'getLayerWarning': "KhÃ´ng thá» táº£i lá»p ${layerType} ÄÃºng Äáº¯n.\x3cbr\x3e\x3cbr\x3eÄá» trÃ¡nh thÃ´ng bÃ¡o nÃ y láº§n sau, hÃ£y chá»n BaseLayer má»i dÃ¹ng Äiá»u khiá»n chá»n lá»p á» gÃ³c trÃªn pháº£i.\x3cbr\x3e\x3cbr\x3eCháº¯c script thÆ° viá»n ${layerLib} khÃ´ng ÄÆ°á»£c bao gá»m ÄÃºng kiá»u.\x3cbr\x3e\x3cbr\x3e\x3ca href=\'http://trac.openlayers.org/wiki/${layerLib}\' target=\'_blank\'\x3eTrá»£ giÃºp vá» tÃ­nh nÄng nÃ y\x3c/a\x3e cho ngÆ°á»i phÃ¡t triá»n.",

    'Scale = 1 : ${scaleDenom}': "Tá»· lá» = 1 : ${scaleDenom}",

    'W': "T",

    'E': "Ä",

    'N': "B",

    'S': "N",

    'reprojectDeprecated': "Báº¡n Äang Ã¡p dá»¥ng cháº¿ Äá» âreprojectâ vÃ o lá»p ${layerName}. Cháº¿ Äá» nÃ y ÄÃ£ bá» pháº£n Äá»i: nÃ³ cÃ³ má»¥c ÄÃ­ch há» trá»£ láº¥p dá»¯ liá»u trÃªn cÃ¡c ná»n báº£n Äá» thÆ°Æ¡ng máº¡i; nÃªn thá»±c hiá»n hiá»u á»©ng ÄÃ³ dÃ¹ng tÃ­nh nÄng Mercator HÃ¬nh cáº§u. CÃ³ sáºµn thÃªm chi tiáº¿t táº¡i http://trac.openlayers.org/wiki/SphericalMercator .",

    'methodDeprecated': "PhÆ°Æ¡ng thá»©c nÃ y ÄÃ£ bá» pháº£n Äá»i vÃ  sáº½ bá» dá»i vÃ o phiÃªn báº£n 3.0. Xin hÃ£y sá»­ dá»¥ng ${newMethod} thay tháº¿."

});
