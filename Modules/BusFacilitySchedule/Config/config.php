<?php

return [
    'name'     => 'BusFacilitySchedule',
    'bindings' => [
        \Modules\BusFacilitySchedule\Interfaces\BusFacilityScheduleInterface::class           => \Modules\BusFacilitySchedule\Services\BusFacilityScheduleService::class,
        \Modules\BusFacilitySchedule\Interfaces\BusFacilityScheduleRepositoryInterface::class => \Modules\BusFacilitySchedule\Repositories\BusFacilityScheduleRepository::class,
    ],
];
