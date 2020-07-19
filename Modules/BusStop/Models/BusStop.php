<?php

namespace Modules\BusStop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Represents bus stop model.
 *
 * @package Modules\Bus\Models
 */
class BusStop extends Model
{
    use SoftDeletes;

    /**
     * Table name;
     *
     * @var string
     */
    protected $table = 'bus_stops';

    /**
     * Mass assignable attributes.
     *
     * @var string[]
     */
    protected $fillable = [
        'reference_code',
        'location_name',
        'latitude',
        'longitude',
        'is_bus_interchange',
    ];
}
