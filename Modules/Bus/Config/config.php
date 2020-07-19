<?php

return [
    'name'     => 'Bus',
    'bindings' => [
        \Modules\Bus\Interfaces\BusRepositoryInterface::class => \Modules\Bus\Repositories\BusRepository::class,
    ],
];
