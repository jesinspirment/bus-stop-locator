<?php

namespace Modules\BusStop\Interfaces;

use Modules\Core\Interfaces\RepositoryInterface;

interface BusStopRepositoryInterface extends RepositoryInterface
{
    /**
     * Get nearest bus stops given a cooridnate and radius.
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $radiusMetres
     * @return mixed
     */
    public function getNearestBusStops(float $latitude, float $longitude, int $radiusMetres);
}
