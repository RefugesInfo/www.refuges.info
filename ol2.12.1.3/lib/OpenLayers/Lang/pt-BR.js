/* Translators (2009 onwards):
 *  - Luckas Blade
 *  - Rodrigo Avila
 */

/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["pt-br"]
 * Dictionary for PortuguÃªs do Brasil.  Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang["pt-br"] = OpenLayers.Util.applyDefaults({

    'unhandledRequest': "A requisiÃ§Ã£o retornou um erro nÃ£o tratado: ${statusText}",

    'Permalink': "Link para essa pÃ¡gina",

    'Overlays': "Camadas de SobreposiÃ§Ã£o",

    'Base Layer': "Camada Base",

    'noFID': "NÃ£o Ã© possÃ­vel atualizar uma feiÃ§Ã£o que nÃ£o tenha um FID.",

    'browserNotSupported': "Seu navegador nÃ£o suporta renderizaÃ§Ã£o de vetores. Os renderizadores suportados atualmente sÃ£o:\n${renderers}",

    'minZoomLevelError': "A propriedade minZoomLevel Ã© de uso restrito das camadas descendentes de FixedZoomLevels. A verificaÃ§Ã£o dessa propriedade pelas camadas wfs Ã© um resÃ­duo do passado. NÃ£o podemos, entretanto nÃ£o Ã© possÃ­vel removÃª-la sem possÃ­velmente quebrar o funcionamento de aplicaÃ§Ãµes OL que possuem depÃªncia com ela. Portanto estamos tornando seu uso obsoleto -- a verificaÃ§Ã£o desse atributo serÃ¡ removida na versÃ£o 3.0. Ao invÃ©s, use as opÃ§Ãµes de resoluÃ§Ã£o min/max como descrito em: http://trac.openlayers.org/wiki/SettingZoomLevels",

    'commitSuccess': "TransaÃ§Ã£o WFS : SUCESSO ${response}",

    'commitFailed': "TransaÃ§Ã£o WFS : ERRO ${response}",

    'googleWarning': "NÃ£o foi possÃ­vel carregar a camada Google corretamente.\x3cbr\x3e\x3cbr\x3ePara se livrar dessa mensagem, selecione uma nova Camada Base, na ferramenta de alternaÃ§Ã£o de camadas localizaÃ§Ã£o do canto superior direito.\x3cbr\x3e\x3cbr\x3eMuito provavelmente, isso foi causado porque o script da biblioteca do Google Maps nÃ£o foi incluÃ­do, ou porque ele nÃ£o contÃ©m a chave correta da API para o seu site.\x3cbr\x3e\x3cbr\x3eDesenvolvedores: Para obter ajuda em solucionar esse problema \x3ca href=\'http://trac.openlayers.org/wiki/Google\' target=\'_blank\'\x3ecliquem aqui\x3c/a\x3e",

    'getLayerWarning': "NÃ£o foi possÃ­vel carregar a camada ${layerType} corretamente.\x3cbr\x3e\x3cbr\x3ePara se livrar dessa mensagem, selecione uma nova Camada Base, na ferramenta de alternaÃ§Ã£o de camadas localizaÃ§Ã£o do canto superior direito.\x3cbr\x3e\x3cbr\x3eMuito provavelmente, isso foi causado porque o script da biblioteca ${layerLib} nÃ£o foi incluÃ­do corretamente.\x3cbr\x3e\x3cbr\x3eDesenvolvedores: Para obter ajuda em solucionar esse problema \x3ca href=\'http://trac.openlayers.org/wiki/${layerLib}\' target=\'_blank\'\x3ecliquem aqui\x3c/a\x3e",

    'Scale = 1 : ${scaleDenom}': "Escala = 1 : ${scaleDenom}",

    'W': "O",

    'E': "L",

    'N': "N",

    'S': "S",

    'reprojectDeprecated': "VocÃª estÃ¡ usando a opÃ§Ã£o \'reproject\' na camada ${layerName}. Essa opÃ§Ã£o estÃ¡ obsoleta: seu uso foi projetado para suportar a visualizaÃ§Ã£o de dados sobre bases de mapas comerciais, entretanto essa funcionalidade deve agora ser alcanÃ§ada usando o suporte Ã  projeÃ§Ã£o Mercator. Mais informaÃ§Ã£o estÃ¡ disponÃ­vel em: http://trac.openlayers.org/wiki/SphericalMercator.",

    'methodDeprecated': "Esse mÃ©todo estÃ¡ obsoleto e serÃ¡ removido na versÃ£o 3.0. Ao invÃ©s, por favor use ${newMethod}."

});
