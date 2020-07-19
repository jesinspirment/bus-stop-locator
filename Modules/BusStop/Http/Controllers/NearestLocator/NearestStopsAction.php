<?php

namespace Modules\BusStop\Http\Controllers\NearestLocator;

use App\Http\Controllers\Controller;
use Modules\BusStop\Http\Requests\NearestBusStopsRequest;
use Modules\BusStop\Http\Resources\NearestBusStop;
use Modules\BusStop\Interfaces\BusStopRepositoryInterface;

class NearestStopsAction extends Controller
{
     /**
     * Get nearest bus stops based on user location.
     *
     * @param NearestBusStopsRequest $request
     * @param BusStopRepositoryInterface $busStopRepo
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(NearestBusStopsRequest $request, BusStopRepositoryInterface $busStopRepo)
    {
        $searchRadiusMetres = config('busstop.search_radius_metres');
        $nearestBusStops = $busStopRepo->getNearestBusStops($request->lat, $request->lon, $searchRadiusMetres);

        return NearestBusStop::collection($nearestBusStops);
    }
}
