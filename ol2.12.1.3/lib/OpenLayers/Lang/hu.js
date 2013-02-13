/* Translators (2009 onwards):
 *  - City-busz
 *  - Glanthor Reviol
 */

/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["hu"]
 * Dictionary for Magyar.  Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang["hu"] = OpenLayers.Util.applyDefaults({

    'unhandledRequest': "Nem kezelt kÃ©rÃ©s visszatÃ©rÃ©se ${statusText}",

    'Permalink': "Permalink",

    'Overlays': "RÃ¡vetÃ­tÃ©sek",

    'Base Layer': "AlaprÃ©teg",

    'noFID': "Nem frissÃ­thetÅ olyan jellemzÅ, amely nem rendelkezik FID-del.",

    'browserNotSupported': "A bÃ¶ngÃ©szÅje nem tÃ¡mogatja a vektoros renderelÃ©st. A jelenleg tÃ¡mogatott renderelÅk:\n${renderers}",

    'minZoomLevelError': "A minZoomLevel tulajdonsÃ¡got csak a kÃ¶vetkezÅvel valÃ³ hasznÃ¡latra szÃ¡ntÃ¡k: FixedZoomLevels-leszÃ¡rmazott fÃ³liÃ¡k. Ez azt jelenti, hogy a minZoomLevel wfs fÃ³lia jelÃ¶lÅnÃ©gyzetei mÃ¡r a mÃºltÃ©. Mi azonban nem tÃ¡volÃ­thatjuk el annak a veszÃ©lye nÃ©lkÃ¼l, hogy az esetlegesen ettÅl fÃ¼ggÅ OL alapÃº alkalmazÃ¡sokat tÃ¶nkretennÃ©nk. EzÃ©rt ezt Ã©rvÃ©nytelenÃ­tjÃ¼k -- a minZoomLevel az alul levÅ jelÃ¶lÅnÃ©gyzet a 3.0-s verziÃ³bÃ³l el lesz tÃ¡volÃ­tva. KÃ©rjÃ¼k, helyette hasznÃ¡lja a  min/max felbontÃ¡s beÃ¡llÃ­tÃ¡st, amelyrÅl az alÃ¡bbi helyen talÃ¡l leÃ­rÃ¡st: http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "WFS tranzakciÃ³: SIKERES ${response}",

    'commitFailed': "WFS tranzakciÃ³: SIKERTELEN ${response}",

    'googleWarning': "A Google fÃ³lia betÃ¶ltÃ©se sikertelen.\x3cbr\x3e\x3cbr\x3eAhhoz, hogy ez az Ã¼zenet eltÅ±njÃ¶n, vÃ¡lasszon egy Ãºj BaseLayer fÃ³liÃ¡t a jobb felsÅ sarokban talÃ¡lhatÃ³ fÃ³liakapcsolÃ³ segÃ­tsÃ©gÃ©vel.\x3cbr\x3e\x3cbr\x3eNagy valÃ³szÃ­nÅ±sÃ©ggel ez azÃ©rt van, mert a Google Maps kÃ¶nyvtÃ¡r parancsfÃ¡jlja nem talÃ¡lhatÃ³, vagy nem tartalmazza az Ãn oldalÃ¡hoz tartozÃ³ megfelelÅ API-kulcsot.\x3cbr\x3e\x3cbr\x3eFejlesztÅknek: A helyes mÅ±kÃ¶dtetÃ©sre vonatkozÃ³ segÃ­tsÃ©g az alÃ¡bbi helyen Ã©rhetÅ el, \x3ca href=\'http://trac.openlayers.org/wiki/Google\' target=\'_blank\'\x3ekattintson ide\x3c/a\x3e",

    'getLayerWarning': "A(z) ${layerType} fÃ³lia nem tÃ¶ltÅdÃ¶tt be helyesen.\x3cbr\x3e\x3cbr\x3eAhhoz, hogy ez az Ã¼zenet eltÅ±njÃ¶n, vÃ¡lasszon egy Ãºj BaseLayer fÃ³liÃ¡t a jobb felsÅ sarokban talÃ¡lhatÃ³ fÃ³liakapcsolÃ³ segÃ­tsÃ©gÃ©vel.\x3cbr\x3e\x3cbr\x3eNagy valÃ³szÃ­nÅ±sÃ©ggel ez azÃ©rt van, mert a(z) ${layerLib} kÃ¶nyvtÃ¡r parancsfÃ¡jlja helytelen.\x3cbr\x3e\x3cbr\x3eFejlesztÅknek: A helyes mÅ±kÃ¶dtetÃ©sre vonatkozÃ³ segÃ­tsÃ©g az alÃ¡bbi helyen Ã©rhetÅ el, \x3ca href=\'http://trac.openlayers.org/wiki/${layerLib}\' target=\'_blank\'\x3ekattintson ide\x3c/a\x3e",

    'Scale = 1 : ${scaleDenom}': "LÃ©ptÃ©k = 1 : ${scaleDenom}",

    'W': "Ny",

    'E': "K",

    'N': "Ã",

    'S': "D",

    'reprojectDeprecated': "Ãn a \'reproject\' beÃ¡llÃ­tÃ¡st hasznÃ¡lja a(z) ${layerName} fÃ³liÃ¡n. Ez a beÃ¡llÃ­tÃ¡s Ã©rvÃ©nytelen: hasznÃ¡lata az Ã¼zleti alaptÃ©rkÃ©pek fÃ¶lÃ¶tti adatok megjelenÃ­tÃ©sÃ©nek tÃ¡mogatÃ¡sÃ¡ra szolgÃ¡lt, de ezt a funkciÃ³ ezentÃºl a GÃ¶mbi Mercator hasznÃ¡latÃ¡val Ã©rhetÅ el. TovÃ¡bbi informÃ¡ciÃ³ az alÃ¡bbi helyen Ã©rhetÅ el: http://trac.openlayers.org/wiki/SphericalMercator",

    'methodDeprecated': "Ez a mÃ³dszer Ã©rvÃ©nytelenÃ­tve lett Ã©s a 3.0-s verziÃ³bÃ³l el lesz tÃ¡volÃ­tva. HasznÃ¡lja a(z) ${newMethod} mÃ³dszert helyette."

});
