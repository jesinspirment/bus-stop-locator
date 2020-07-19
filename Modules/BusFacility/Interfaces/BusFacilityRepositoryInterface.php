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
    public function createBusFacility(int $busId, int $busStopId, string $direction, int $stopNumber);

    /**
     * Check if facility exists.
     *
     * @param int $busId
     * @param int $busStopId
     * @return boolean
     */
    public function facilityExists(int $busId, int $busStopId);

    /**
     * Check if stop number already exists.
     *
     * @param int $busId
     * @param string $direction
     * @param int $stopNumber
     * @return mixed
     */
    public function stopNumberExists(int $busId, string $direction, int $stopNumber);
}
