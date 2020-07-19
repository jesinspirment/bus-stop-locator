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
     * @see \Modules\BusFacility\Interfaces\BusFacilityRepositoryInterface::addBusToBusStop()
     */
    public function addBusToBusStop(int $busId, int $busStopId, string $direction, int $stopNumber)
    {
        return $this->create([
            'bus_id'      => $busId,
            'bus_stop_id' => $busStopId,
            'direction'   => $direction,
            'stop_number' => $stopNumber,
        ]);
    }
}
