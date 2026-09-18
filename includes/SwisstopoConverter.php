<?php
// From https://github.com/antistatique/swisstopo

declare(strict_types=1);

namespace Antistatique\Swisstopo;

/**
 * Convert GPS (WGS84) to Swiss (LV03 or LV95) coordinates - and vice versa.
 *
 * @psalm-api
 */
class SwisstopoConverter
{
    /**
     * Convert the given Swiss (MN95) coordinate points into WGS notation.
     *
     * @param float|int $east
     *   The East Swiss (MN95) coordinate point
     * @param float|int $north
     *   The North Swiss (MN95) coordinate point
     *
     * @return array
     *   The array containing WGS latitude & longitude coordinates
     */
    public static function fromMN95ToWGS(float|int $east, float|int $north): array
    {
        return [
            'lat' => self::fromMN95ToWGSLatitude($east, $north),
            'long' => self::fromMN95ToWGSLongitude($east, $north),
        ];
    }

    /**
     * Convert the given WGS coordinate points into Swiss (MN95) notation.
     *
     * @param float $lat
     *   The WGS latitude coordinate point in degree
     * @param float $long
     *   The WGS longitude coordinate point in degree
     *
     * @return array
     *   The array containing Swiss (MN95) East & North coordinates
     */
    public static function fromWGSToMN95(float $lat, float $long): array
    {
        return [
            'east' => self::fromWGSToMN95East($lat, $long),
            'north' => self::fromWGSToMN95North($lat, $long),
        ];
    }

    /**
     * Convert the given Swiss (MN03) coordinate points into WGS notation.
     *
     * @param int $y
     *   The Y Swiss (MN03) coordinate point
     * @param int $x
     *   The X Swiss (MN03) coordinate point
     *
     * @return array
     *   The array containing WGS latitude & longitude coordinates
     */
    public static function fromMN03ToWGS(int $y, int $x): array
    {
        return [
            'lat' => self::fromMN03ToWGSLatitude($y, $x),
            'long' => self::fromMN03ToWGSLongitude($y, $x),
        ];
    }

    /**
     * Convert the given WGS coordinate points into Swiss (MN03) notation.
     *
     * @param float $lat
     *   The WGS latitude coordinate point in degree
     * @param float $long
     *   The WGS longitude coordinate point in degree
     *
     * @return array
     *   The array containing Swiss (MN03) x & y coordinates
     */
    public static function fromWGSToMN03(float $lat, float $long): array
    {
        return [
            'x' => self::fromWGSToMN03x($lat, $long),
            'y' => self::fromWGSToMN03y($lat, $long),
        ];
    }

    /**
     * Convert WGS coordinates latitude & longitude into Swiss (MN03) Y value.
     *
     * @param float $lat
     *   The WGS latitude coordinate point in degree
     * @param float $long
     *   The WGS longitude coordinate point in degree
     *
     * @return float
     *   The converted WGS coordinates to Swiss (MN03) Y
     */
    private static function fromWGSToMN03y(float $lat, float $long): float
    {
        // Converts Decimal Degrees to Sexagesimal Degree.
        $lat = self::degToSex($lat);
        $long = self::degToSex($long);

        // Convert Decimal Degrees to Seconds of Arc.
        $lat = self::degToSec($lat);
        $long = self::degToSec($long);

        // Auxiliary values (% Bern).
        $lat_aux = ($lat - 169028.66) / 10000.0;
        $long_aux = ($long - 26782.5) / 10000.0;

        // Process Swiss (MN03) Y calculation.
        return 600072.37
          + 211455.93 * $long_aux
          - 10938.51 * $long_aux * $lat_aux
          - 0.36 * $long_aux * pow($lat_aux, 2)
          - 44.54 * pow($long_aux, 3);
    }

    /**
     * Convert WGS coordinates latitude & longitude into Swiss (MN03) X value.
     *
     * @param float $lat
     *   The WGS latitude coordinate point in degree
     * @param float $long
     *   The WGS longitude coordinate point in degree
     *
     * @return float
     *   The converted WGS coordinates to Swiss (MN03) X
     */
    private static function fromWGSToMN03x(float $lat, float $long): float
    {
        // Converts Decimal Degrees to Sexagesimal Degree.
        $lat = self::degToSex($lat);
        $long = self::degToSex($long);

        // Convert Decimal Degrees to Seconds of Arc.
        $lat = self::degToSec($lat);
        $long = self::degToSec($long);

        // Auxiliary values (% Bern).
        $lat_aux = ($lat - 169028.66) / 10000.0;
        $long_aux = ($long - 26782.5) / 10000.0;

        // Process Swiss (MN03) X calculation.
        return 200147.07
          + 308807.95 * $lat_aux
          + 3745.25 * pow($long_aux, 2)
          + 76.63 * pow($lat_aux, 2)
          - 194.56 * pow($long_aux, 2) * $lat_aux
          + 119.79 * pow($lat_aux, 3);
    }

    /**
     * Convert WGS coordinates latitude & longitude into Swiss (MN95) North value.
     *
     * @param float $lat
     *   The WGS latitude coordinate point in degree
     * @param float $long
     *   The WGS longitude coordinate point in degree
     *
     * @return float
     *   The converted WGS coordinates to Swiss (MN95) North
     */
    private static function fromWGSToMN95North(float $lat, float $long): float
    {
        // Converts Decimal Degrees to Sexagesimal Degree.
        $lat = self::degToSex($lat);
        $long = self::degToSex($long);

        // Convert Decimal Degrees to Seconds of Arc.
        $phi = self::degToSec($lat);
        $lambda = self::degToSec($long);

        // Calculate the auxiliary values (differences of latitude and longitude
        // relative to Bern in the unit[10000"]).
        $phi_aux = ($phi - 169028.66) / 10000.0;
        $lambda_aux = ($lambda - 26782.5) / 10000.0;

        // Process Swiss (MN95) North calculation.
        return 1200147.07
          + 308807.95 * $phi_aux
          + 3745.25 * pow($lambda_aux, 2)
          + 76.63 * pow($phi_aux, 2)
          - 194.56 * pow($lambda_aux, 2) * $phi_aux
          + 119.79 * pow($phi_aux, 3);
    }

    /**
     * Convert WGS coordinates latitude & longitude into Swiss (MN95) East value.
     *
     * @param float $lat
     *   The WGS latitude coordinate point in degree
     * @param float $long
     *   The WGS longitude coordinate point in degree
     *
     * @return float
     *   The converted WGS coordinates to Swiss (MN95) East
     */
    private static function fromWGSToMN95East(float $lat, float $long): float
    {
        // Converts Decimal Degrees to Sexagesimal Degree.
        $lat = self::degToSex($lat);
        $long = self::degToSex($long);

        // Convert Decimal Degrees to Seconds of Arc.
        $phi = self::degToSec($lat);
        $lambda = self::degToSec($long);

        // Calculate the auxiliary values (differences of latitude and longitude
        // relative to Bern in the unit[10000"]).
        $phi_aux = ($phi - 169028.66) / 10000.0;
        $lambda_aux = ($lambda - 26782.5) / 10000.0;

        // Process Swiss (MN95) East calculation.
        return 2600072.37
          + 211455.93 * $lambda_aux
          - 10938.51 * $lambda_aux * $phi_aux
          - 0.36 * $lambda_aux * pow($phi_aux, 2)
          - 44.54 * pow($lambda_aux, 3);
    }

    /**
     * Convert Swiss (MN95) coordinates East & North to WGS latitude value.
     *
     * @param float|int $east
     *   The East Swiss (MN95) coordinate point
     * @param float|int $north
     *   The North Swiss (MN95) coordinate point
     *
     * @return float
     *   The converted Swiss (MN95) coordinates to WGS latitude
     */
    public static function fromMN95ToWGSLatitude(float|int $east, float|int $north): float
    {
        // Convert the projection coordinates E (easting) and N (northing) in MN95
        // into the civilian system (Bern = 0 / 0) and express in the unit 1000 km.
        $y_aux = ((float) $east - 2600000.0) / 1000000.0;
        $x_aux = ((float) $north - 1200000.0) / 1000000.0;

        // Process latitude calculation.
        $lat = 16.9023892
          + 3.238272 * $x_aux
          - 0.270978 * pow($y_aux, 2)
          - 0.002528 * pow($x_aux, 2)
          - 0.0447 * pow($y_aux, 2) * $x_aux
          - 0.0140 * pow($x_aux, 3);

        // Unit 10000" to 1" and converts seconds to degrees notation.
        $lat = $lat * 100.0 / 36.0;

        return $lat;
    }

    /**
     * Convert Swiss (MN95) coordinates East & North to WGS longitude value.
     *
     * @param float|int $east
     *   The East Swiss (MN95) coordinate point
     * @param float|int $north
     *   The North Swiss (MN95) coordinate point
     *
     * @return float
     *   The converted Swiss (MN95) coordinates to WGS longitude
     */
    private static function fromMN95ToWGSLongitude(float|int $east, float|int $north): float
    {
        // Convert the projection coordinates E (easting) and N (northing) in MN95
        // into the civilian system (Bern = 0 / 0) and express in the unit 1000 km.
        $y_aux = ((float) $east - 2600000.0) / 1000000.0;
        $x_aux = ((float) $north - 1200000.0) / 1000000.0;

        // Process longitude calculation.
        $long = 2.6779094
          + 4.728982 * $y_aux
          + 0.791484 * $y_aux * $x_aux
          + 0.1306 * $y_aux * pow($x_aux, 2)
          - 0.0436 * pow($y_aux, 3);

        // Unit 10000" to 1" and converts seconds to degrees notation.
        $long = $long * 100.0 / 36.0;

        return $long;
    }

    /**
     * Convert Swiss (MN03) coordinates y & x to WGS latitude value.
     *
     * @param float $y
     *   The Y Swiss (MN03) coordinate point
     * @param float $x
     *   The X Swiss (MN03) coordinate point
     *
     * @return float
     *   The converted Swiss (MN03) coordinates to WGS latitude
     */
    public static function fromMN03ToWGSLatitude(float $y, float $x): float
    {
        // Convert the projection coordinates y and x in MN03 into the civilian
        // system (Bern = 0 / 0) and express in the unit [1000 km].
        $y_aux = ($y - 600000.0) / 1000000.0;
        $x_aux = ($x - 200000.0) / 1000000.0;

        // Process latitude calculation.
        $lat = 16.9023892
          + 3.238272 * $x_aux
          - 0.270978 * pow($y_aux, 2)
          - 0.002528 * pow($x_aux, 2)
          - 0.0447 * pow($y_aux, 2) * $x_aux
          - 0.0140 * pow($x_aux, 3);

        // Unit 10000" to 1" and converts seconds to degrees notation.
        $lat = $lat * 100.0 / 36.0;

        return $lat;
    }

    /**
     * Convert Swiss (MN03) coordinates y & x to WGS longitude value.
     *
     * @param float $y
     *   The Y Swiss (MN03) coordinate point
     * @param float $x
     *   The X Swiss (MN03) coordinate point
     *
     * @return float
     *   The converted Swiss (MN03) coordinates to WGS longitude
     */
    private static function fromMN03ToWGSLongitude(float $y, float $x): float
    {
        // Convert the projection coordinates y and x in MN03 into the civilian
        // system (Bern = 0 / 0) and express in the unit [1000 km].
        $y_aux = ($y - 600000.0) / 1000000.0;
        $x_aux = ($x - 200000.0) / 1000000.0;

        // Process longitude calculation.
        $long = 2.6779094
          + 4.728982 * $y_aux
          + 0.791484 * $y_aux * $x_aux
          + 0.1306 * $y_aux * pow($x_aux, 2)
          - 0.0436 * pow($y_aux, 3);

        // Unit 10000" to 1" and converts seconds to degrees notation.
        $long = $long * 100.0 / 36.0;

        return $long;
    }

    /**
     * Convert Decimal Degrees to Sexagesimal Degrees.
     *
     * @param float|int $angle
     *   The Decimal Degrees notation of angle to convert in Sexagesimal notation
     *
     * @return float
     *   The converted Decimal Degrees to Sexagesimal Degrees
     */
    private static function degToSex(float|int $angle): float
    {
        $angle = (float) $angle;

        // Extract D°M'S".
        $deg = (int) $angle;
        $min = (int) (($angle - (float) $deg) * 60.0);
        $sec = ((($angle - (float) $deg) * 60.0) - (float) $min) * 60.0;

        // Result in degrees sec (dd.mmss)
        return (float) $deg + (float) $min / 100.0 + $sec / 10000.0;
    }

    /**
     * Convert Decimal Degrees to Seconds of Arc (seconds only of D°M'S").
     *
     * @param float|int $angle
     *   The Decimal Degrees notation of angle to convert in Seconds of Arc
     *
     * @return float
     *   The converted Decimal Degrees to Seconds of Arc
     */
    private static function degToSec(float|int $angle): float
    {
        $angle = (float) $angle;

        // Extract D°M'S".
        $deg = (int) $angle;
        $min = (int) (($angle - (float) $deg) * 100.0);
        $sec = ((($angle - (float) $deg) * 100.0) - (float) $min) * 100.0;

        // Result in degrees sec (dd.mmss).
        return $sec + (float) $min * 60.0 + (float) $deg * 3600.0;
    }
}
