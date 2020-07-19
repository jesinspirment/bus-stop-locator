<?php

namespace Modules\Geo\Entities;

/**
 * A basic class that represents a coordinate in latitude and longitude.
 *
 * @package Modules\GeoCalculator\Entities
 */
class Coordinate
{
    /**
     * Latitude.
     *
     * @var float
     */
    private $latitude;

    /**
     * Longitude.
     *
     * @var float
     */
    private $longitude;

    /**
     * Class constructor.
     *
     * @param float $lat
     * @param float $lon
     */
    public function __construct(float $lat, float $lon)
    {
        $this->latitude  = $lat;
        $this->longitude = $lon;
    }

    /**
     * Getter for latitude.
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Getter for longitude.
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'lat' => $this->getLatitude(),
            'lon' => $this->getLongitude(),
        ];
    }
}
