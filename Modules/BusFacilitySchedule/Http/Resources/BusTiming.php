<?php

namespace Modules\BusFacilitySchedule\Http\Resources;

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
        return [
            'bus_number'        => $this->service_number,
            'next_arrival_time' => $this->next_arrival_time,
        ];
    }
}
