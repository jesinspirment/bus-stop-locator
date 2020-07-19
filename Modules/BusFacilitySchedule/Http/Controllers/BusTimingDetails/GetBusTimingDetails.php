<?php

namespace Modules\BusFacilitySchedule\Http\Controllers\BusTimingDetails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BusFacilitySchedule\Http\Resources\BusTiming;
use Modules\BusFacilitySchedule\Interfaces\BusFacilityScheduleRepositoryInterface;
use Modules\BusStop\Interfaces\BusStopRepositoryInterface;

class GetBusTimingDetails extends Controller
{
    /**
     * Invoke action.
     *
     * @param Request $request
     * @param int $busStopId
     * @param BusFacilityScheduleRepositoryInterface $scheduleRepo
     * @param BusStopRepositoryInterface $busStopRepo
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(
        Request $request,
        int $busStopId,
        BusFacilityScheduleRepositoryInterface $scheduleRepo,
        BusStopRepositoryInterface $busStopRepo
    ) {
        // Ensure bus stop ID is valid first
        $busStop = $busStopRepo->find($busStopId);

        if (empty($busStop)) {
            abort(404);
        }

        $busTimings = $scheduleRepo->getBusTimingsForBusStop($busStopId);
        return BusTiming::collection($busTimings);
    }
}
