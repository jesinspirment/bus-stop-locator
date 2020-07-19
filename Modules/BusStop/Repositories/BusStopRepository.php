<?php

namespace Modules\BusStop\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\BusStop\Interfaces\BusStopRepositoryInterface;
use Modules\BusStop\Models\BusStop;
use Modules\Core\Services\Abstracts\AbstractRepository;
use Modules\Geo\Interfaces\GeoInterface;

class BusStopRepository extends AbstractRepository implements BusStopRepositoryInterface
{
    /**
     * Class constructor.
     *
     * @param BusStop $model
     */
    public function __construct(BusStop $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     * @see \Modules\BusStop\Interfaces\BusStopRepositoryInterface::getNearestBusStops()
     */
    public function getNearestBusStops(float $latitude, float $longitude, int $radiusMetres)
    {
        $earthRadius = GeoInterface::EARTH_RADIUS;
        $rad         = GeoInterface::RAD;

        // Pre-compute as much as possible, so that the SQL below does less computations
        $latitudeRad  = $latitude * $rad;
        $longitudeRad = $longitude * $rad;

        $sinLatitudeRad = sin($latitudeRad);
        $cosLatitudeRad = cos($latitudeRad);

        $distanceSql = "TRUNCATE($earthRadius * ACOS("
            . "COS(latitude * $rad)"
            . "* $cosLatitudeRad"
            . "* COS($longitudeRad - (longitude * $rad))"
            . "+ SIN(latitude * $rad)"
            . "* $sinLatitudeRad"
            . '), 2)';

        return $this->model
            ->newQuery()
            ->join('bus_facilities AS bf', 'bf.bus_stop_id', 'bus_stops.id')
            ->join('buses AS b', 'b.id', 'bf.bus_id')
            ->limit(10)
            ->orderBy('distance', 'ASC')
            ->groupBy('bus_stops.id')
            ->having('distance', '<=', $radiusMetres)
            ->get([
                'bus_stops.id',
                'bus_stops.reference_code',
                'bus_stops.location_name',
                DB::raw("GROUP_CONCAT(b.service_number ORDER BY service_number ASC SEPARATOR ' ') AS buses"),
                DB::raw("$distanceSql AS distance"),
            ]);
    }
}
