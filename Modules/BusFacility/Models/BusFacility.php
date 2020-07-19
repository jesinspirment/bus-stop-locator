<?php

namespace Modules\BusFacility\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Bus\Models\Bus;
use Modules\BusFacilitySchedule\Models\BusFacilitySchedule;
use Modules\BusStop\Models\BusStop;

/**
 * Represents bus facility model.
 *
 * @package Modules\Bus\Models
 */
class BusFacility extends Model
{
    use SoftDeletes;

    /**
     * Table name;
     *
     * @var string
     */
    protected $table = 'bus_facilities';

    /**
     * Mass assignable attributes.
     *
     * @var string[]
     */
    protected $fillable = [
        'bus_id',
        'bus_stop_id',
        'direction',
        'stop_number',
    ];

    /**
     * Relation to schedules.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schedules()
    {
        return $this->hasMany(BusFacilitySchedule::class, 'bus_id');
    }

    /**
     * Relation to bus.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    /**
     * Relation to bus stop.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function busStop()
    {
        return $this->belongsTo(BusStop::class, 'bus_stop_id');
    }
}
