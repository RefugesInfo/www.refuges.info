/* Translators (2009 onwards):
 *  - Helix84
 */

/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["sk"]
 * Dictionary for SlovenÄina.  Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang["sk"] = OpenLayers.Util.applyDefaults({

    'unhandledRequest': "NeobslÃºÅ¾enÃ© poÅ¾iadavky vracajÃº ${statusText}",

    'Permalink': "TrvalÃ½ odkaz",

    'Overlays': "Prekrytia",

    'Base Layer': "ZÃ¡kladnÃ¡ vrstva",

    'noFID': "Nie je moÅ¾nÃ© aktualizovaÅ¥ vlastnosÅ¥, pre ktorÃº neexistuje FID.",

    'browserNotSupported': "VÃ¡Å¡ prehliadaÄ nepodporuje vykresÄ¾ovanie vektorov. MomentÃ¡lne podporovanÃ© vykresÄ¾ovaÄe sÃº:\n${renderers}",

    'minZoomLevelError': "VlastnosÅ¥ minZoomLevel je urÄenÃ½ iba na pouÅ¾itie s vrstvami odvodenÃ½mi od FixedZoomLevels. To, Å¾e tÃ¡to wfs vrstva kontroluje minZoomLevel je pozostatok z minulosti. NemÃ´Å¾eme ho vÅ¡ak odstrÃ¡niÅ¥, aby sme sa vyhli moÅ¾nÃ©mu poruÅ¡eniu aplikÃ¡ciÃ­ zaloÅ¾enÃ½ch na Open Layers, ktorÃ© na tomto mÃ´Å¾e zÃ¡visieÅ¥. Preto ho oznaÄujeme ako zavrhovanÃ½ - dolu uvedenÃ¡ kontrola minZoomLevel bude odstrÃ¡nenÃ¡ vo verzii 3.0. PouÅ¾ite prosÃ­m namiesto toho kontrolu min./max. rozlÃ­Å¡enia podÄ¾a tu uvedenÃ©ho popisu: http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "Transakcia WFS: ÃSPEÅ NÃ ${response}",

    'commitFailed': "Transakcia WFS: ZLYHALA ${response}",

    'googleWarning': "Vrstvu Google nebolo moÅ¾nÃ© sprÃ¡vne naÄÃ­taÅ¥.\x3cbr\x3e\x3cbr\x3eAby ste sa tejto sprÃ¡vy zbavili vyberte novÃº BaseLayer v prepÃ­naÄi vrstiev v pravom hornom rohu.\x3cbr\x3e\x3cbr\x3eToto sa stalo pravdepodobne preto, Å¾e skript kniÅ¾nice Google Maps buÄ nebol naÄÃ­tanÃ½ alebo neobsahuje sprÃ¡vny kÄ¾ÃºÄ API pre vaÅ¡u lokalitu.\x3cbr\x3e\x3cbr\x3eVÃ½vojÃ¡ri: Tu mÃ´Å¾ete zÃ­skaÅ¥ \x3ca href=\'http://trac.openlayers.org/wiki/Google\' target=\'_blank\'\x3epomoc so sfunkÄnenÃ­m\x3c/a\x3e",

    'getLayerWarning': "Vrstvu ${layerType} nebolo moÅ¾nÃ© sprÃ¡vne naÄÃ­taÅ¥.\x3cbr\x3e\x3cbr\x3eAby ste sa tejto sprÃ¡vy zbavili vyberte novÃº BaseLayer v prepÃ­naÄi vrstiev v pravom hornom rohu.\x3cbr\x3e\x3cbr\x3eToto sa stalo pravdepodobne preto, Å¾e skript kniÅ¾nice ${layerType} buÄ nebol naÄÃ­tanÃ½ alebo neobsahuje sprÃ¡vny kÄ¾ÃºÄ API pre vaÅ¡u lokalitu.\x3cbr\x3e\x3cbr\x3eVÃ½vojÃ¡ri: Tu mÃ´Å¾ete zÃ­skaÅ¥ \x3ca href=\'http://trac.openlayers.org/wiki/${layerType}\' target=\'_blank\'\x3epomoc so sfunkÄnenÃ­m\x3c/a\x3e",

    'Scale = 1 : ${scaleDenom}': "Mierka = 1 : ${scaleDenom}",

    'reprojectDeprecated': "PouÅ¾Ã­vate voÄ¾by âreprojectâ vrstvy ${layerType}. TÃ¡to voÄ¾ba je zzavrhovanÃ¡: jej pouÅ¾itie bolo navrhnutÃ© na podporu zobrazovania Ãºdajov nad komerÄnÃ½mi zÃ¡kladovÃ½mi mapami, ale tÃºto funkcionalitu je teraz moÅ¾nÃ© dosiahnuÅ¥ pomocou Spherical Mercator. ÄalÅ¡ie informÃ¡cie zÃ­skate na strÃ¡nke http://trac.openlayers.org/wiki/SphericalMercator.",

    'methodDeprecated': "TÃ¡to metÃ³da je zavrhovanÃ¡ a bude odstrÃ¡nenÃ¡ vo verzii 3.0. PouÅ¾ite prosÃ­m namiesto nej metÃ³du ${newMethod}."
});
