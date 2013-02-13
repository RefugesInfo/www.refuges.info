/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["nb"]
 * Dictionary for norwegian bokmÃ¥l (Norway). Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang["nb"] = {

    'unhandledRequest': "Ubehandlet forespÃ¸rsel returnerte ${statusText}",

    'Permalink': "Kobling til denne siden",

    'Overlays': "Kartlag",

    'Base Layer': "Bakgrunnskart",

    'noFID': "Kan ikke oppdatere et feature (et objekt) som ikke har FID.",

    'browserNotSupported':
        "Din nettleser stÃ¸tter ikke vektortegning. Tegnemetodene som stÃ¸ttes er:\n${renderers}",

    // console message
    'minZoomLevelError':
        "Egenskapen minZoomLevel er kun ment til bruk pÃ¥ lag " +
        "basert pÃ¥ FixedZoomLevels. At dette wfs-laget sjekker " +
        "minZoomLevel er en etterlevning fra tidligere versjoner. Det kan dog ikke " +
        "tas bort uten Ã¥ risikere at OL-baserte applikasjoner " +
        "slutter Ã¥ virke, sÃ¥ det er merket som foreldet: " +
        "minZoomLevel i sjekken nedenfor vil fjernes i 3.0. " +
        "Vennligst bruk innstillingene for min/maks opplÃ¸sning " +
        "som er beskrevet her: "+
        "http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "WFS-transaksjon: LYKTES ${response}",

    'commitFailed': "WFS-transaksjon: MISLYKTES ${response}",

    'googleWarning':
        "Google-laget kunne ikke lastes.<br><br>" +
        "Bytt til et annet bakgrunnslag i lagvelgeren i " +
        "Ã¸vre hÃ¸yre hjÃ¸rne for Ã¥ slippe denne meldingen.<br><br>" +
        "Sannsynligvis forÃ¥rsakes feilen av at Google Maps-biblioteket " +
        "ikke er riktig inkludert pÃ¥ nettsiden, eller at det ikke er " +
        "angitt riktig API-nÃ¸kkel for nettstedet.<br><br>" +
        "Utviklere: For hjelp til Ã¥ fÃ¥ dette til Ã¥ virke se "+
        "<a href='http://trac.openlayers.org/wiki/Google' " +
        "target='_blank'>her</a>.",

    'getLayerWarning':
        "${layerType}-laget kunne ikke lastes.<br><br>" +
        "Bytt til et annet bakgrunnslag i lagvelgeren i " +
        "Ã¸vre hÃ¸yre hjÃ¸rne for Ã¥ slippe denne meldingen.<br><br>" +
        "Sannsynligvis forÃ¥rsakes feilen av at " +
        "${layerLib}-biblioteket ikke var riktig inkludert " +
        "pÃ¥ nettsiden.<br><br>" +
        "Utviklere: For hjelp til Ã¥ fÃ¥ dette til Ã¥ virke se " +
        "<a href='http://trac.openlayers.org/wiki/${layerLib}' " +
        "target='_blank'>her</a>.",

    'Scale = 1 : ${scaleDenom}': "<strong>Skala</strong> 1 : ${scaleDenom}",

    // console message
    'reprojectDeprecated':
        "Du bruker innstillingen 'reproject' pÃ¥ laget ${layerName}. " +
        "Denne innstillingen er foreldet, den var ment for Ã¥ stÃ¸tte " +
        "visning av kartdata over kommersielle bakgrunnskart, men det " +
        "bÃ¸r nÃ¥ gjÃ¸res med stÃ¸tten for Spherical Mercator. Mer informasjon " +
        "finnes pÃ¥ http://trac.openlayers.org/wiki/SphericalMercator.",

    // console message
    'methodDeprecated':
        "Denne metoden er markert som foreldet og vil bli fjernet i 3.0. " +
        "Vennligst bruk ${newMethod} i stedet.",

    'end': ''
};

OpenLayers.Lang["no"] = OpenLayers.Lang["nb"];
