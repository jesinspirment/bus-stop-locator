<?php

return [
    'name'     => 'Geo',
    'bindings' => [
        \Modules\Geo\Interfaces\GeoInterface::class => \Modules\Geo\Services\GeoService::class,
    ],
];
