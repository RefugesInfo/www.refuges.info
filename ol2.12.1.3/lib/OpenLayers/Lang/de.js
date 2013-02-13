/* Translators (2009 onwards):
 *  - Grille chompa
 *  - Nikiwaibel
 *  - Umherirrender
 */

/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["de"]
 * Dictionary for Deutsch.  Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang["de"] = OpenLayers.Util.applyDefaults({

    'unhandledRequest': "Unbehandelte AnfragerÃ¼ckmeldung ${statusText}",

    'Permalink': "Permalink",

    'Overlays': "Overlays",

    'Base Layer': "Grundkarte",

    'noFID': "Ein Feature, fÃ¼r das keine FID existiert, kann nicht aktualisiert werden.",

    'browserNotSupported': "Ihr Browser unterstÃ¼tzt keine Vektordarstellung. Aktuell unterstÃ¼tzte Renderer:\n${renderers}",

    'minZoomLevelError': "Die \x3ccode\x3eminZoomLevel\x3c/code\x3e-Eigenschaft ist nur fÃ¼r die Verwendung mit \x3ccode\x3eFixedZoomLevels\x3c/code\x3e-untergeordneten Layers vorgesehen. Das dieser \x3ctt\x3ewfs\x3c/tt\x3e-Layer die \x3ccode\x3eminZoomLevel\x3c/code\x3e-Eigenschaft Ã¼berprÃ¼ft ist ein Relikt der Vergangenheit. Wir kÃ¶nnen diese ÃberprÃ¼fung nicht entfernen, ohne das OL basierende Applikationen nicht mehr funktionieren. Daher markieren wir es als veraltet - die \x3ccode\x3eminZoomLevel\x3c/code\x3e-ÃberprÃ¼fung wird in Version 3.0 entfernt werden. Bitte verwenden Sie stattdessen die Min-/Max-LÃ¶sung, wie sie unter http://trac.openlayers.org/wiki/SettingZoomLevels beschrieben ist.",

    'commitSuccess': "WFS-Transaktion: Erfolgreich ${response}",

    'commitFailed': "WFS-Transaktion: Fehlgeschlagen ${response}",

    'googleWarning': "Der Google-Layer konnte nicht korrekt geladen werden.\x3cbr\x3e\x3cbr\x3eUm diese Meldung nicht mehr zu erhalten, wÃ¤hlen Sie einen anderen Hintergrundlayer aus dem LayerSwitcher in der rechten oberen Ecke.\x3cbr\x3e\x3cbr\x3eSehr wahrscheinlich tritt dieser Fehler auf, weil das Skript der Google-Maps-Bibliothek nicht eingebunden wurde oder keinen gÃ¼ltigen API-SchlÃ¼ssel fÃ¼r Ihre URL enthÃ¤lt.\x3cbr\x3e\x3cbr\x3eEntwickler: Besuche \x3ca href=\'http://trac.openlayers.org/wiki/Google\' target=\'_blank\'\x3edas Wiki\x3c/a\x3e fÃ¼r Hilfe zum korrekten Einbinden des Google-Layers",

    'getLayerWarning': "Der ${layerType}-Layer konnte nicht korrekt geladen werden.\x3cbr\x3e\x3cbr\x3eUm diese Meldung nicht mehr zu erhalten, wÃ¤hlen Sie einen anderen Hintergrundlayer aus dem LayerSwitcher in der rechten oberen Ecke.\x3cbr\x3e\x3cbr\x3eSehr wahrscheinlich tritt dieser Fehler auf, weil das Skript der \'${layerLib}\'-Bibliothek nicht eingebunden wurde.\x3cbr\x3e\x3cbr\x3eEntwickler: Besuche \x3ca href=\'http://trac.openlayers.org/wiki/${layerLib}\' target=\'_blank\'\x3edas Wiki\x3c/a\x3e fÃ¼r Hilfe zum korrekten Einbinden von Layern",

    'Scale = 1 : ${scaleDenom}': "MaÃstab = 1 : ${scaleDenom}",

    'W': "W",

    'E': "O",

    'N': "N",

    'S': "S",

    'reprojectDeprecated': "Sie verwenden die âReprojectâ-Option des Layers ${layerName}. Diese Option ist veraltet: Sie wurde entwickelt um die Anzeige von Daten auf kommerziellen Basiskarten zu unterstÃ¼tzen, aber diese Funktion sollte jetzt durch UnterstÃ¼tzung der âSpherical Mercatorâ erreicht werden. Weitere Informationen sind unter http://trac.openlayers.org/wiki/SphericalMercator verfÃ¼gbar.",

    'methodDeprecated': "Die Methode ist veraltet und wird in 3.0 entfernt. Bitte verwende stattdessen ${newMethod}."

});
