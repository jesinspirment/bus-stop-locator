<?php

namespace Modules\BusStop\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NearestBusStopsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lat' => 'bail|required|numeric|min:-90|max:90',
            'lon' => 'bail|required|numeric|min:-180|max:180',
        ];
    }

    /**
     * Attribute names.
     *
     * @return array|string[]
     */
    public function attributes()
    {
        return [
            'lat' => 'latitude',
            'lon' => 'longitude',
        ];
    }
}
