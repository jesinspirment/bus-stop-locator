<?php

return [
    'name'     => 'BusStop',
    'bindings' => [
        \Modules\BusStop\Interfaces\BusStopRepositoryInterface::class => \Modules\BusStop\Repositories\BusStopRepository::class,
    ],
];
