<?php

namespace Modules\BusFacilitySchedule\Repositories;

use Modules\BusFacilitySchedule\Interfaces\BusFacilityScheduleRepositoryInterface;
use Modules\BusFacilitySchedule\Models\BusFacilitySchedule;
use Modules\Core\Services\Abstracts\AbstractRepository;

class BusFacilityScheduleRepository extends AbstractRepository implements BusFacilityScheduleRepositoryInterface
{
    /**
     * Class constructor.
     *
     * @param BusFacilitySchedule $model
     */
    public function __construct(BusFacilitySchedule $model)
    {
        parent::__construct($model);
    }
}
