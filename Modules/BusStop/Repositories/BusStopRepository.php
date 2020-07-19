<?php

namespace Modules\BusStop\Repositories;

use Modules\BusStop\Interfaces\BusStopRepositoryInterface;
use Modules\BusStop\Models\BusStop;
use Modules\Core\Services\Abstracts\AbstractRepository;

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
}
