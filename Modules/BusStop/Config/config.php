<?php

return [
    'name'     => 'BusStop',
    'bindings' => [
        \Modules\BusStop\Interfaces\BusStopInterface::class           => \Modules\BusStop\Services\BusStopService::class,
        \Modules\BusStop\Interfaces\BusStopRepositoryInterface::class => \Modules\BusStop\Repositories\BusStopRepository::class,
    ],
    'search_radius_metres' => ENV('SEARCH_RADIUS_METRES'),
];
