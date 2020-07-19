<?php

namespace Modules\Bus\Interfaces;

use Modules\Core\Interfaces\RepositoryInterface;

interface BusRepositoryInterface extends RepositoryInterface
{
    /**
     * Find bus by service number.
     *
     * @param int $serviceNumber
     * @param array $columns
     * @param array $with
     * @return mixed
     */
    public function findByServiceNumber(int $serviceNumber, array $columns = ['*'], array $with = []);
}