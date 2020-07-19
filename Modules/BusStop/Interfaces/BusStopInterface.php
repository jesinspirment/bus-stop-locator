<?php

namespace Modules\BusStop\Interfaces;

interface BusStopInterface
{
    /**
     * Add bus to bus stop.
     *
     * @param int $busStopId
     * @param int $busServiceNumber
     * @param string $direction
     * @param int $stopNumber
     * @return mixed
     */
    public function addBusToBusStop(int $busStopId, int $busServiceNumber, string $direction, int $stopNumber);
}
