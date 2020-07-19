<?php

namespace Modules\BusFacilitySchedule\Interfaces;

use Modules\Core\Interfaces\RepositoryInterface;

interface BusFacilityScheduleRepositoryInterface extends RepositoryInterface
{
    /**
     * Get bus timings for all buses linked to a bus stop.
     *
     * @param int $busStopId
     * @return mixed
     */
    public function getBusTimingsForBusStop(int $busStopId);
}
