<?php

namespace Modules\Geo\Interfaces;

use Modules\Geo\Entities\Coordinate;

/**
 * A generic interface for Geo-related functions.
 *
 * @package Modules\Geo\Interfaces
 */
interface GeoInterface
{
    /**
     * Earth radius in meters.
     *
     * @var int
     */
    const EARTH_RADIUS = 6371000;

    /**
     * Value of deg2rad(1). Define and use a constant like this
     * for consistency reasons.
     */
    const RAD = M_PI / 180;

    /**
     * Calculates the center point between 2 or more locations.
     *
     * @param Coordinate $coordinates
     * @param int         $distance
     * @param int         $heading
     *
     * @return Coordinate
     */
    public function project(Coordinate $coordinates, int $distance, int $heading);

    /**
     * Generate random coordinate based which is random distance away from a fixed coordinate.
     *
     * @param Coordinate $coordinates
     * @param int         $maxDistance
     *
     * @return Coordinate
     */
    public function randomCoordinate(Coordinate $coordinates, int $maxDistance);

    /**
     * Compute the distance between 2 coordinates in metres (rounded down).
     *
     * @param Coordinate $c1
     * @param Coordinate $c2
     * @return mixed
     */
    public function computeDistanceMetres(Coordinate $c1, Coordinate $c2);
}
