/**
 * @requires OpenLayers/Lang.js
 */

/**
 * Namespace: OpenLayers.Lang["lt"]
 * Dictionary for Lithuanian.  Keys for entries are used in calls to
 *     <OpenLayers.Lang.translate>.  Entry bodies are normal strings or
 *     strings formatted for use with <OpenLayers.String.format> calls.
 */
OpenLayers.Lang['lt'] = OpenLayers.Util.applyDefaults({

    'unhandledRequest': "Neapdorota uÅ¾klausa graÅ¾ino ${statusText}",

    'Permalink': "Pastovi nuoroda",

    'Overlays': "Papildomi sluoksniai",

    'Base Layer': "Pagrindinis sluoksnis",

    'noFID': "Negaliu atnaujinti objekto, kuris neturi FID.",

    'browserNotSupported':
	"JÅ«sÅ³ narÅ¡yklÄ nemoka parodyti vektoriÅ³. Å iuo metu galima naudotis tokiais rodymo varikliais:\n{renderers}",

    'commitSuccess': "WFS Tranzakcija: PAVYKO ${response}",

    'commitFailed': "WFS Tranzakcija: Å½LUGO ${response}",

    'Scale = 1 : ${scaleDenom}': "Mastelis = 1 : ${scaleDenom}",
    
    //labels for the graticule control
    'W': 'V',
    'E': 'R',
    'N': 'Å ',
    'S': 'P',
    'Graticule': 'Tinklelis',

    // console message
    'methodDeprecated':
	"Å is metodas yra pasenÄs ir 3.0 versijoje bus paÅ¡alintas. " +
	"PraÅ¡ome naudoti ${newMethod}.",

    // **** end ****
    'end': ''
    
});
