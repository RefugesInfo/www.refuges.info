/* Translators (2009 onwards):
 *  - Als-Holder
 */

/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["gsw"]
 * Dictionary for Alemannisch.  Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang["gsw"] = OpenLayers.Util.applyDefaults({

    'unhandledRequest': "Nit behandleti AafrogsruckmÃ¤ldig ${statusText}",

    'Permalink': "Permalink",

    'Overlays': "Iberlagerige",

    'Base Layer': "Grundcharte",

    'noFID': "E Feature, wu s kei FID derfir git, cha nit aktualisiert wÃ¤re.",

    'browserNotSupported': "Dyy Browser unterstitzt kei Vektordarstellig. AktuÃ¤ll unterstitzti Renderer:\n${renderers}",

    'minZoomLevelError': "D minZoomLevel-Eigeschaft isch nume dÃ¤nk fir d Layer, wu vu dr FixedZoomLevels abstamme. Ass dÃ¤Ã¤ wfs-Layer minZoomLevel prieft, scih e Relikt us dr Vergangeheit. Mir chenne s aber nit Ã¤ndere ohni OL_basierti AawÃ¤ndige villicht kaputt gehn, wu dervu abhÃ¤nge.  Us dÃ¤m Grund het die Funktion d Eigeschaft \'deprecated\' iberchuu. D minZoomLevel-Priefig unte wird in dr Version 3.0 usegnuu. Bitte verwÃ¤nd statt dÃ¤m e min/max-Uflesig wie s do bschriben isch: http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "WFS-Transaktion: ERFOLGRYCH ${response}",

    'commitFailed': "WFS-Transaktion: FÃHLGSCHLAA ${response}",

    'googleWarning': "Dr Google-Layer het nit korrÃ¤kt chenne glade wÃ¤re.\x3cbr\x3e\x3cbr\x3eGo die MÃ¤ldig nimi z kriege, wehl e andere Hintergrundlayer us em LayerSwitcher im rÃ¤chte obere Ecke.\x3cbr\x3e\x3cbr\x3eDÃ¤Ã¤ FÃ¤hler git s seli hyfig, wel s Skript vu dr Google-Maps-Bibliothek nit yybunde woren isch oder wel s kei giltige API-Schlissel fir Dyy URL din het.\x3cbr\x3e\x3cbr\x3eEntwickler: Fir Hilf zum korrÃ¤kte Yybinde vum Google-Layer \x3ca href=\'http://trac.openlayers.org/wiki/Google\' target=\'_blank\'\x3edoo drucke\x3c/a\x3e",

    'getLayerWarning': "Dr ${layerType}-Layer het nit korrÃ¤kt chenne glade wÃ¤re.\x3cbr\x3e\x3cbr\x3eGo die MÃ¤ldig nimi z kriege, wehl e andere Hintergrundlayer us em LayerSwitcher im rÃ¤chte obere Ecke.\x3cbr\x3e\x3cbr\x3eDÃ¤Ã¤ FÃ¤hler git s seli hyfig, wel s Skript vu dr \'${layerLib}\'-Bibliothek nit yybunde woren isch oder wel s kei giltige API-Schlissel fir Dyy URL din het.\x3cbr\x3e\x3cbr\x3eEntwickler: Fir Hilf zum korrÃ¤kte Yybinde vu Layer \x3ca href=\'http://trac.openlayers.org/wiki/${layerLib}\' target=\'_blank\'\x3edoo drucke\x3c/a\x3e",

    'Scale = 1 : ${scaleDenom}': "MaÃstab = 1 : ${scaleDenom}",

    'W': "W",

    'E': "O",

    'N': "N",

    'S': "S",

    'reprojectDeprecated': "Du bruchsch d \'reproject\'-Option bim ${layerName}-Layer. Die Option isch nimi giltig: si isch aagleit wore go   Date iber kommerziÃ¤lli Grundcharte lege, aber des sott mer jetz mache mit dr Unterstitzig vu Spherical Mercator. Meh Informatione git s uf http://trac.openlayers.org/wiki/SphericalMercator.",

    'methodDeprecated': "Die Methode isch veraltet un wird us dr Version 3.0 usegnuu. Bitte verwÃ¤bnd statt dÃ¤m ${newMethod}."

});
