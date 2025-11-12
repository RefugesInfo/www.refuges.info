/**
 * Strategy for loading elements based on fixed position and size tiles
 * The position is centered on fixed regular Mercator patterns
 * For high resolutions, the maximum tile size corresponds to a screen square in pixels
 * For low resolutions, the minimum tile size corresponds to a ground square in meters
 */
export function tiledBbox(extent, resolution) {
  const byStepResolution = Math.exp(Math.round(Math.log(resolution))),
    tileSize = Math.max(byStepResolution * 1000, 50000), // (pixels, meters)
    extents = [];

  for (let lon = Math.floor(extent[0] / tileSize); lon < Math.ceil(extent[2] / tileSize); lon++)
    for (let lat = Math.floor(extent[1] / tileSize); lat < Math.ceil(extent[3] / tileSize); lat++)
      extents.push([
        Math.round(lon * tileSize),
        Math.round(lat * tileSize),
        Math.round(lon * tileSize + tileSize),
        Math.round(lat * tileSize + tileSize),
      ]);

  return extents;
}