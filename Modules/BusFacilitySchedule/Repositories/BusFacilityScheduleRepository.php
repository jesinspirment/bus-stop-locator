<?php

namespace Modules\BusFacilitySchedule\Repositories;

use Illuminate\Support\Facades\DB;
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

    /**
     * @inheritDoc
     * @see \Modules\BusFacilitySchedule\Interfaces\BusFacilityScheduleRepositoryInterface::getBusTimingsForBusStop()
     */
    public function getBusTimingsForBusStop(int $busStopId)
    {
        return $this->model
            ->join('bus_facilities AS bf', 'bf.id', 'bus_facility_schedules.bus_facility_id')
            ->join('bus_stops AS bs', 'bs.id', 'bf.bus_stop_id')
            ->join('buses AS b', 'b.id', 'bf.bus_id')
            ->whereNull('bs.deleted_at')
            ->whereNull('bf.deleted_at')
            ->whereNull('bus_facility_schedules.deleted_at')
            ->whereNull('b.deleted_at')
            ->where('bf.bus_stop_id', $busStopId)
            ->where('bus_facility_schedules.estimated_arrival_time', '>', now()->toTimeString())
            ->groupBy('bf.bus_id')
            ->orderBy('b.service_number', 'ASC')
            ->get([
                'b.service_number',
                DB::raw('MIN(bus_facility_schedules.estimated_arrival_time) AS next_arrival_time'),
            ]);
    }
}
