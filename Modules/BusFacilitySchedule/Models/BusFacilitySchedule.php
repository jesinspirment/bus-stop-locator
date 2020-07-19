<?php

namespace Modules\BusFacilitySchedule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\BusFacility\Models\BusFacility;

/**
 * Represents bus facility schedule model.
 *
 * @package Modules\BusFacilitySchedule\Models
 */
class BusFacilitySchedule extends Model
{
    use SoftDeletes;

    /**
     * Table name;
     *
     * @var string
     */
    protected $table = 'bus_facility_schedules';

    /**
     * Mass assignable attributes.
     *
     * @var string[]
     */
    protected $fillable = [
        'bus_facility_id',
        'trip_number',
        'estimated_arrival_time',
    ];

    /**
     * Relation to bus facility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function busFacility()
    {
        return $this->belongsTo(BusFacility::class, 'bus_facility_id');
    }
}
