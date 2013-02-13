/* Translators (2009 onwards):
 *  - Sannab
 */

/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["sv"]
 * Dictionary for Svenska.  Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang["sv"] = OpenLayers.Util.applyDefaults({

    'unhandledRequest': "Ej hanterad frÃ¥ga retur ${statusText}",

    'Permalink': "PermalÃ¤nk",

    'Overlays': "Kartlager",

    'Base Layer': "Bakgrundskarta",

    'noFID': "Kan ej uppdatera feature (objekt) fÃ¶r vilket FID saknas.",

    'browserNotSupported': "Din webblÃ¤sare stÃ¶der inte vektorvisning. FÃ¶r nÃ¤rvarande stÃ¶ds fÃ¶ljande visning:\n${renderers}",

    'minZoomLevelError': "Egenskapen minZoomLevel Ã¤r endast avsedd att anvÃ¤ndas med lager med FixedZoomLevels. Att detta WFS-lager kontrollerar minZoomLevel Ã¤r en relik frÃ¥n Ã¤ldre versioner. Vi kan dock inte ta bort det utan att riskera att OL-baserade tillÃ¤mpningar som anvÃ¤nder detta slutar fungera. DÃ¤rfÃ¶r Ã¤r det satt som deprecated, minZoomLevel kommer att tas bort i version 3.0. AnvÃ¤nd i stÃ¤llet instÃ¤llning av min/max resolution som beskrivs hÃ¤r: http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "WFS-transaktion: LYCKADES ${response}",

    'commitFailed': "WFS-transaktion: MISSLYCKADES ${response}",

    'googleWarning': "Google-lagret kunde inte laddas korrekt.\x3cbr\x3e\x3cbr\x3eFÃ¶r att slippa detta meddelande, vÃ¤lj en annan bakgrundskarta i lagervÃ¤ljaren i Ã¶vre hÃ¶gra hÃ¶rnet.\x3cbr\x3e\x3cbr\x3eSannolikt beror felet pÃ¥ att Google Maps-biblioteket inte Ã¤r inkluderat pÃ¥ webbsidan eller pÃ¥ att sidan inte anger korrekt API-nyckel fÃ¶r webbplatsen.\x3cbr\x3e\x3cbr\x3eUtvecklare: hjÃ¤lp fÃ¶r att Ã¥tgÃ¤rda detta, \x3ca href=\'http://trac.openlayers.org/wiki/Google\' target=\'_blank\'\x3eklicka hÃ¤r\x3c/a\x3e.",

    'getLayerWarning': "${layerType}-lagret kunde inte laddas korrekt.\x3cbr\x3e\x3cbr\x3eFÃ¶r att slippa detta meddelande, vÃ¤lj en annan bakgrundskarta i lagervÃ¤ljaren i Ã¶vre hÃ¶gra hÃ¶rnet.\x3cbr\x3e\x3cbr\x3eSannolikt beror felet pÃ¥ att ${layerLib}-biblioteket inte Ã¤r inkluderat pÃ¥ webbsidan.\x3cbr\x3e\x3cbr\x3eUtvecklare: hjÃ¤lp fÃ¶r att Ã¥tgÃ¤rda detta, \x3ca href=\'http://trac.openlayers.org/wiki/${layerLib}\' target=\'_blank\'\x3eklicka hÃ¤r\x3c/a\x3e.",

    'Scale = 1 : ${scaleDenom}': "\x3cstrong\x3eSkala\x3c/strong\x3e 1 : ${scaleDenom}",

    'reprojectDeprecated': "Du anvÃ¤nder instÃ¤llningen \'reproject\' pÃ¥ lagret ${layerName}. Denna instÃ¤llning markerad som deprecated: den var avsedd att anvÃ¤ndas fÃ¶r att stÃ¶dja visning av kartdata pÃ¥ kommersiella bakgrundskartor, men nu bÃ¶r man i stÃ¤llet anvÃ¤nda Spherical Mercator-stÃ¶d fÃ¶r den funktionaliteten. Mer information finns pÃ¥ http://trac.openlayers.org/wiki/SphericalMercator.",

    'methodDeprecated': "Denna metod Ã¤r markerad som deprecated och kommer att tas bort i 3.0. AnvÃ¤nd ${newMethod} i stÃ¤llet."

});
