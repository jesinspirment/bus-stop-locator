<?php

namespace Modules\Bus\Repositories;

use Modules\Bus\Interfaces\BusRepositoryInterface;
use Modules\Bus\Models\Bus;
use Modules\Core\Services\Abstracts\AbstractRepository;

class BusRepository extends AbstractRepository implements BusRepositoryInterface
{
    /**
     * Class constructor.
     *
     * @param Bus $model
     */
    public function __construct(Bus $model)
    {
        parent::__construct($model);
    }
}
