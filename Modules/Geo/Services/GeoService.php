<?php

namespace Modules\Geo\Services;

use Modules\Geo\Entities\Coordinate;
use Modules\Geo\Interfaces\GeoInterface;

class GeoService implements GeoInterface
{
    /**
     * @inheritDoc
     * @see \Modules\Geo\Interfaces\GeoInterface::project()
     */
    public function project(Coordinate $coordinates, int $distance, int $heading)
    {
        $lat      = deg2rad($coordinates->getLatitude());
        $lon      = deg2rad($coordinates->getLongitude());
        $distance = $distance / self::EARTH_RADIUS;
        $heading  = deg2rad($heading);

        $newLat = asin(
            sin($lat) * cos($distance) +
            cos($lat) * sin($distance) * cos($heading)
        );

        $newLon = $lon + atan2(
            sin($heading) * sin($distance) * cos($lat),
            cos($distance) - sin($lat) * sin($newLat)
        );

        $newLon = fmod(($newLon + 3 * M_PI), (2 * M_PI)) - M_PI;

        return new Coordinate(rad2deg($newLat), rad2deg($newLon));
    }

    /**
     * @inheritDoc
     * @see \Modules\Geo\Interfaces\GeoInterface::randomCoordinate()
     */
    public function randomCoordinate(Coordinate $coordinates, int $maxDistance): Coordinate
    {
        $heading  = mt_rand(0, 359);
        $distance = mt_rand(0, $maxDistance);

        return $this->project($coordinates, $distance, $heading);
    }

    /**
     * @inheritDoc
     * @see \Modules\Geo\Interfaces\GeoInterface::computeDistanceMetres()
     */
    public function computeDistanceMetres(Coordinate $c1, Coordinate $c2)
    {
        $lat1 = deg2rad($c1->getLatitude());
        $lon1 = deg2rad($c1->getLongitude());
        $lat2 = deg2rad($c2->getLatitude());
        $lon2 = deg2rad($c2->getLongitude());

        return self::EARTH_RADIUS * acos(
            sin($lat2) * sin($lat1) +
            cos($lat2) * cos($lat1) * cos($lon2 - $lon1)
        );
    }
}
