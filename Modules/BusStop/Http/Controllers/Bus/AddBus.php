<?php

namespace Modules\BusStop\Http\Controllers\Bus;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\BusStop\Http\Requests\AddBusRequest;
use Modules\BusStop\Interfaces\BusStopInterface;

class AddBus extends Controller
{
    /**
     * Get nearest bus stops based on user location.
     *
     * @param AddBusRequest $request
     * @param int $busStopId
     * @param BusStopInterface $busStopService
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function __invoke(AddBusRequest $request, int $busStopId, BusStopInterface $busStopService)
    {
        DB::beginTransaction();

        try {
            $busStopService->addBusToBusStop(
                $busStopId,
                $request->service_number,
                $request->direction,
                $request->stop_number
            );

            DB::commit();

            return response()->json(['msg' => 'Bus stop added successfully']);
        } catch (\Throwable $t) {
            DB::rollback();
            throw $t;
        }
    }
}
