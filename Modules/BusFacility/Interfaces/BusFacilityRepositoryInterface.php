<?php

namespace Modules\BusFacility\Interfaces;

use Modules\Core\Interfaces\RepositoryInterface;

interface BusFacilityRepositoryInterface extends RepositoryInterface
{
    /**
     * Create new bus facility.
     *
     * @param int $busId
     * @param int $busStopId
     * @param string $direction
     * @param int $stopNumber
     * @return mixed
     */
    public function addBusToBusStop(int $busId, int $busStopId, string $direction, int $stopNumber);
}
