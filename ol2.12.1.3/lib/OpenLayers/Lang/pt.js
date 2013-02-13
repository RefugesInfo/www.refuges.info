/* Translators (2009 onwards):
 *  - Hamilton Abreu
 *  - Malafaya
 *  - Waldir
 */

/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["pt"]
 * Dictionary for PortuguÃªs.  Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang["pt"] = OpenLayers.Util.applyDefaults({

    'unhandledRequest': "Servidor devolveu erro nÃ£o contemplado ${statusText}",

    'Permalink': "LigaÃ§Ã£o permanente",

    'Overlays': "SobreposiÃ§Ãµes",

    'Base Layer': "Camada Base",

    'noFID': "NÃ£o Ã© possÃ­vel atualizar um elemento para a qual nÃ£o hÃ¡ FID.",

    'browserNotSupported': "O seu navegador nÃ£o suporta renderizaÃ§Ã£o vetorial. Actualmente os renderizadores suportados sÃ£o:\n${renderers}",

    'minZoomLevelError': "A propriedade minZoomLevel sÃ³ deve ser usada com as camadas descendentes da FixedZoomLevels. A verificaÃ§Ã£o da propriedade por esta camada wfs Ã© uma relÃ­quia do passado. No entanto, nÃ£o podemos removÃª-la sem correr o risco de afectar aplicaÃ§Ãµes OL que dependam dela. Portanto, estamos a tornÃ¡-la obsoleta -- a verificaÃ§Ã£o minZoomLevel serÃ¡ removida na versÃ£o 3.0. Em vez dela, por favor, use as opÃ§Ãµes de resoluÃ§Ã£o min/max descritas aqui: http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "TransacÃ§Ã£o WFS: SUCESSO ${response}",

    'commitFailed': "TransacÃ§Ã£o WFS: FALHOU ${response}",

    'googleWarning': "A Camada Google nÃ£o foi correctamente carregada.\x3cbr\x3e\x3cbr\x3ePara deixar de receber esta mensagem, seleccione uma nova Camada-Base no \'\'switcher\'\' de camadas no canto superior direito.\x3cbr\x3e\x3cbr\x3eProvavelmente, isto acontece porque o \'\'script\'\' da biblioteca do Google Maps nÃ£o foi incluÃ­do ou nÃ£o contÃ©m a chave API correcta para o seu sÃ­tio.\x3cbr\x3e\x3cbr\x3eProgramadores: Para ajuda sobre como solucionar o problema \x3ca href=\'http://trac.openlayers.org/wiki/Google\' target=\'_blank\'\x3eclique aqui\x3c/a\x3e .",

    'getLayerWarning': "A camada ${layerType} nÃ£o foi correctamente carregada.\x3cbr\x3e\x3cbr\x3ePara desactivar esta mensagem, seleccione uma nova Camada-Base no \'\'switcher\'\' de camadas no canto superior direito.\x3cbr\x3e\x3cbr\x3eProvavelmente, isto acontece porque o \'\'script\'\' da biblioteca ${layerLib} nÃ£o foi incluÃ­do correctamente.\x3cbr\x3e\x3cbr\x3eProgramadores: Para ajuda sobre como solucionar o problema \x3ca href=\'http://trac.openlayers.org/wiki/${layerLib}\' target=\'_blank\'\x3eclique aqui\x3c/a\x3e .",

    'Scale = 1 : ${scaleDenom}': "Escala = 1 : ${scaleDenom}",

    'W': "O",

    'E': "E",

    'N': "N",

    'S': "S",

    'reprojectDeprecated': "EstÃ¡ usando a opÃ§Ã£o \'reproject\' na camada ${layerName}. Esta opÃ§Ã£o Ã© obsoleta: foi concebida para permitir a apresentaÃ§Ã£o de dados sobre mapas-base comerciais, mas esta funcionalidade Ã© agora suportada pelo Mercator EsfÃ©rico. Mais informaÃ§Ã£o estÃ¡ disponÃ­vel em http://trac.openlayers.org/wiki/SphericalMercator.",

    'methodDeprecated': "Este mÃ©todo foi declarado obsoleto e serÃ¡ removido na versÃ£o 3.0. Por favor, use ${newMethod} em vez disso."

});
