<?php

namespace Modules\BusFacilitySchedule\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BusTiming extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $arrivalTime       = Carbon::parse($this->next_arrival_time);
        $differenceMinutes = $arrivalTime->diffInMinutes(now());

        if (60 < $differenceMinutes) {
            $differenceMinutes = 'N.A';
        } elseif (0 == $differenceMinutes) {
            $differenceMinutes = 'Arriving';
        }

        return [
            'bus_number'          => $this->service_number,
            'next_arrival_time'   => $this->next_arrival_time,
            'arriving_in_minutes' => $differenceMinutes
        ];
    }
}
