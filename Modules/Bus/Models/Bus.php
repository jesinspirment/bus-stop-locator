<?php

namespace Modules\Bus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\BusFacility\Models\BusFacility;

/**
 * Represents bus model.
 *
 * @package Modules\Bus\Models
 */
class Bus extends Model
{
    use SoftDeletes;

    /**
     * Table name;
     *
     * @var string
     */
    protected $table = 'buses';

    /**
     * Mass assignable attributes.
     *
     * @var string[]
     */
    protected $fillable = [
        'service_number',
        'direction_a_start_time',
        'direction_a_end_time',
        'direction_b_start_time',
        'direction_b_end_time',
    ];

    /**
     * Relation to facilities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facilities()
    {
        return $this->hasMany(BusFacility::class, 'bus_id')
            ->orderBy('direction', 'ASC')
            ->orderBy('stop_number', 'ASC');
    }
}
