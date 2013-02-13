/* Translators:
 *  - Arkadiusz Grabka
 */

/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["pl"]
 * Dictionary for Polish.  Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang["pl"] = OpenLayers.Util.applyDefaults({

    'unhandledRequest': "NieobsÅugiwane Å¼Ädanie zwrÃ³ciÅo ${statusText}",

    'Permalink': "Permalink",

    'Overlays': "NakÅadki",

    'Base Layer': "Warstwa podstawowa",

    'noFID': "Nie moÅ¼na zaktualizowaÄ funkcji, dla ktÃ³rych nie ma FID.",

    'browserNotSupported':
        "Twoja przeglÄdarka nie obsÅuguje renderowania wektorÃ³w. Obecnie obsÅugiwane renderowanie to:\n${renderers}",

    // console message
    'minZoomLevelError':
        "WÅaÅciwoÅÄ minZoomLevel jest przeznaczona tylko do uÅ¼ytku " +
        "z warstwami FixedZoomLevels-descendent." +
        "Warstwa wfs, ktÃ³ra sprawdza minZoomLevel jest reliktem przeszÅoÅci." +
        "Nie moÅ¼emy jej jednak usunÄc bez mozliwoÅci Åamania OL aplikacji, " +
        "ktÃ³re mogÄ byÄ od niej zaleÅ¼ne. " +
        "Dlatego jesteÅmy za deprecjacjÄ -- minZoomLevel " +
        "zostanie usuniÄta w wersji 3.0. W zamian prosze uÅ¼yj " +
        "min/max rozdzielczoÅci w sposÃ³b opisany tutaj: " +
        "http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "Transakcja WFS: SUKCES ${response}",

    'commitFailed': "Transakcja WFS: FAILED ${response}",

    'googleWarning':
        "Warstwa Google nie byÅ w stanie zaÅadowaÄ siÄ poprawnie.<br><br>" +
        "Aby pozbyÄ siÄ tej wiadomoÅci, wybierz nowÄ Warstwe podstawowÄ " +
        "w przeÅÄczniku warstw w gÃ³rnym prawym rogu mapy.<br><br>" +
        "Najprawdopodobniej jest to spowodowane tym, Å¼e biblioteka Google Maps " +
        "nie jest zaÅadowana, lub nie zawiera poprawnego klucza do API dla twojej strony<br><br>" +
        "Programisto: Aby uzyskaÄ pomoc , " +
        "<a href='http://trac.openlayers.org/wiki/Google' " +
        "target='_blank'>kliknij tutaj</a>",

    'getLayerWarning':
        "Warstwa ${layerType} nie mogÅa zostaÄ zaÅadowana poprawnie.<br><br>" +
		"Aby pozbyÄ siÄ tej wiadomoÅci, wybierz nowÄ Warstwe podstawowÄ " +
        "w przeÅÄczniku warstw w gÃ³rnym prawym rogu mapy.<br><br>" +
        "Najprawdopodobniej jest to spowodowane tym, Å¼e biblioteka ${layerLib} " +
        "nie jest zaÅadowana, lub moÅ¼e(o ile biblioteka tego wymaga) " +
		"byc potrzebny klucza do API dla twojej strony<br><br>" +
        "Programisto: Aby uzyskaÄ pomoc , " +
        "<a href='http://trac.openlayers.org/wiki/${layerLib}' " +
        "target='_blank'>kliknij tutaj</a>",

    'Scale = 1 : ${scaleDenom}': "Skala = 1 : ${scaleDenom}",
    
    //labels for the graticule control
    'W': 'ZACH',
    'E': 'WSCH',
    'N': 'PN',
    'S': 'PD',
    'Graticule': 'Siatka',

    // console message
    'reprojectDeprecated':
        "w warstwie ${layerName} uÅ¼ywasz opcji 'reproject'. " +
        "Ta opcja jest przestarzaÅa: " +
        "jej zastosowanie zostaÅ zaprojektowany, aby wspieraÄ wyÅwietlania danych przez komercyjne mapy, "+
		"jednak obecnie ta funkcjonalnoÅÄ powinien zostaÄ osiÄgniÄty za pomocÄ Spherical Mercator " +
		"its use was designed to support displaying data over commercial. WiÄcje informacji na ten temat moÅ¼esz znaleÅºÄ na stronie " + 
        "http://trac.openlayers.org/wiki/SphericalMercator.",

    // console message
    'methodDeprecated':
        "Ta metoda jest przestarzaÅa i bÄdzie usuniÄta od wersji 3.0. " +
        "W zamian uÅ¼yj ${newMethod}.",

    'proxyNeeded': "Prawdopodobnie musisz ustawiÄ OpenLayers.ProxyHost aby otrzymaÄ dostÄp do ${url}."+
        "See http://trac.osgeo.org/openlayers/wiki/FrequentlyAskedQuestions#ProxyHost"

});