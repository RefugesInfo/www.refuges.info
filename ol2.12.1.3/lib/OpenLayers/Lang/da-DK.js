/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["da-DK"]
 * Dictionary for Danish.  Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang['da-DK'] = {

    'unhandledRequest': "En ikke hÃ¥ndteret forespÃ¸rgsel returnerede ${statusText}",

    'Permalink': "Permalink",

    'Overlays': "Kortlag",

    'Base Layer': "Baggrundslag",

    'noFID': "Kan ikke opdateret en feature (et objekt) der ikke har et FID.",

    'browserNotSupported':
        "Din browser understÃ¸tter ikke vektor visning. FÃ¸lgende vektor visninger understÃ¸ttes:\n${renderers}",

    // console message
    'minZoomLevelError':
        "Egenskaben minZoomLevel er kun beregnet til brug " +
        "med FixedZoomLevels. At dette WFS lag kontrollerer " +
        "minZoomLevel egenskaben, er et levn fra en tidligere " +
        "version. Vi kan desvÃ¦rre ikke fjerne dette uden at risikere " +
        "at Ã¸delÃ¦gge eksisterende OL baserede programmer der " +
        " benytter denne funktionalitet. " +
        "Egenskaben bÃ¸r derfor ikke anvendes, og minZoomLevel " +
        "kontrollen herunder vil blive fjernet i version 3.0. " +
        "Benyt istedet min/max oplÃ¸snings indstillingerne, som " +
        "er beskrevet her: " +
        "http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "WFS transaktion: LYKKEDES ${response}",

    'commitFailed': "WFS transaktion: MISLYKKEDES ${response}",

    'googleWarning':
        "Google laget kunne ikke indlÃ¦ses.<br><br>" +
        "For at fjerne denne besked, vÃ¦lg et nyt bagrundskort i " +
        "lagskifteren i Ã¸verste hÃ¸jre hjÃ¸rne.<br><br>" +
        "Fejlen skyldes formentlig at Google Maps bibliotekts " +
        "scriptet ikke er inkluderet, eller ikke indeholder den " +
        "korrkte API nÃ¸gle for dit site.<br><br>" +
        "Udviklere: For hjÃ¦lp til at fÃ¥ dette til at fungere, " +
        "<a href='http://trac.openlayers.org/wiki/Google' " +
        "target='_blank'>klik her</a>",

    'getLayerWarning':
        "${layerType}-laget kunne ikke indlÃ¦ses.<br><br>" +
        "For at fjerne denne besked, vÃ¦lg et nyt bagrundskort i " +
        "lagskifteren i Ã¸verste hÃ¸jre hjÃ¸rne.<br><br>" +
        "Fejlen skyldes formentlig at ${layerLib} bibliotekts " +
        "scriptet ikke er inkluderet.<br><br>" +
        "Udviklere: For hjÃ¦lp til at fÃ¥ dette til at fungere, " +
        "<a href='http://trac.openlayers.org/wiki/${layerLib}' " +
        "target='_blank'>klik her</a>",

    'Scale = 1 : ${scaleDenom}': "MÃ¥lforhold = 1 : ${scaleDenom}",

    // console message
    'reprojectDeprecated':
        "Du anvender indstillingen 'reproject' pÃ¥ laget ${layerName}." + 
        "Denne indstilling bÃ¸r ikke lÃ¦ngere anvendes. Den var beregnet " +
        "til at vise data ovenpÃ¥ kommercielle grundkort, men den funktionalitet " +
        "bÃ¸r nu opnÃ¥s ved at anvende Spherical Mercator understÃ¸ttelsen. " +
        "Mere information er tilgÃ¦ngelig her: " +
        "http://trac.openlayers.org/wiki/SphericalMercator.",

    // console message
    'methodDeprecated':
        "Denne funktion bÃ¸r ikke lÃ¦ngere anvendes, og vil blive fjernet i version 3.0. " +
        "Anvend venligst funktionen ${newMethod} istedet."
};
