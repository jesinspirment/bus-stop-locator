<?php

return [
    'name'     => 'BusFacility',
    'bindings' => [
        \Modules\BusFacility\Interfaces\BusFacilityRepositoryInterface::class => \Modules\BusFacility\Repositories\BusFacilityRepository::class,
    ],
];
