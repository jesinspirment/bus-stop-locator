<?php

namespace Modules\BusStop\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NearestBusStop extends JsonResource
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
            'id'             => $this->id,
            'reference_code' => $this->reference_code,
            'location_name'  => $this->location_name,
            'buses'          => explode(' ', $this->buses),
            'distance'       => $this->distance,
        ];
    }
}
