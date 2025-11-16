/**
 * Strategy for loading elements based on fixed tile grid
 * Following layer option
     tiledBBoxStrategy: {
       1000: 10, // tilesize = 1000 Mercator unit up to resolution = 10 meters per pixel
     },
 */
export function tiledBboxStrategy(extent, resolution) {
  //TODO BUG obsolescence de toutes les tuiles après 1 modif: pb hors ligne
  /* eslint-disable-next-line consistent-this, no-invalid-this */
  const layer = this,
    tsur = layer.options.tiledBBoxStrategy || {},
    found = Object.keys(tsur).find(k => tsur[k] > resolution),
    tileSize = parseInt(found, 10),
    tiledExtent = [];

  if (typeof found === 'undefined')
    return [extent]; // Fall back to bbox strategy

  for (let lon = Math.floor(extent[0] / tileSize); lon < Math.ceil(extent[2] / tileSize); lon++)
    for (let lat = Math.floor(extent[1] / tileSize); lat < Math.ceil(extent[3] / tileSize); lat++)
      tiledExtent.push([
        Math.round(lon * tileSize),
        Math.round(lat * tileSize),
        Math.round(lon * tileSize + tileSize),
        Math.round(lat * tileSize + tileSize),
      ]);

  if (layer.options.debug) {
    layer.logs = {
      tileSize: Math.round(tileSize / 1414) + '*' + Math.round(tileSize / 1414) + 'km',
      isCluster: resolution > layer.options.serverClusterMinResolution,
    };
    console.info(
      'Request ' + tiledExtent.length +
      ' tile' + (tiledExtent.length > 1 ? 's ' : ' ') +
      layer.logs.tileSize + ' for ' +
      Math.round(resolution) + 'm/px resolution '
    );
  }

  return tiledExtent;
}