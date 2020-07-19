<?php

namespace Modules\BusFacility\Repositories;

use Modules\BusFacility\Interfaces\BusFacilityRepositoryInterface;
use Modules\BusFacility\Models\BusFacility;
use Modules\Core\Services\Abstracts\AbstractRepository;

class BusFacilityRepository extends AbstractRepository implements BusFacilityRepositoryInterface
{
    /**
     * Class constructor.
     *
     * @param BusFacility $model
     */
    public function __construct(BusFacility $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     * @see \Modules\BusFacility\Interfaces\BusFacilityRepositoryInterface::createBusFacility()
     */
    public function createBusFacility(int $busId, int $busStopId, string $direction, int $stopNumber)
    {
        return $this->create([
            'bus_id'      => $busId,
            'bus_stop_id' => $busStopId,
            'direction'   => $direction,
            'stop_number' => $stopNumber,
        ]);
    }

    /**
     * @inheritDoc
     * @see \Modules\BusFacility\Interfaces\BusFacilityRepositoryInterface::facilityExists()
     */
    public function facilityExists(int $busId, int $busStopId)
    {
        $existingCount = $this->model
            ->newQuery()
            ->where('bus_id', $busId)
            ->where('bus_stop_id', $busStopId)
            ->count();

        return 0 < $existingCount;
    }

    /**
     * @inheritDoc
     * @see \Modules\BusFacility\Interfaces\BusFacilityRepositoryInterface::stopNumberExists()
     */
    public function stopNumberExists(int $busId, string $direction, int $stopNumber)
    {
        $existingCount = $this->model
            ->newQuery()
            ->where('bus_id', $busId)
            ->where('direction', $direction)
            ->where('stop_number', $stopNumber)
            ->count();

        return 0 < $existingCount;
    }
}
