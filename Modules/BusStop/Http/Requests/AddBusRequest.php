<?php

namespace Modules\BusStop\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Modules\Bus\Interfaces\BusRepositoryInterface;
use Modules\BusFacility\Interfaces\BusFacilityRepositoryInterface;

class AddBusRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'service_number' => 'bail|required|integer|min:1|max:999',
            'direction'      => 'bail|required|in:A,B',
            'stop_number'    => 'bail|required|integer|min:1',
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
            'service_number' => 'bus service number',
            'direction'      => 'direction',
            'stop_number'    => 'stop number',
        ];
    }

    /**
     * More validation.
     *
     * @param Validator $validator
     */
    public function withValidator(Validator $validator)
    {
        if ($validator->errors()->isEmpty()) {
            $validator->after(function (Validator $validator) {
                $busStopId = $this->route()->parameter('busStopId');

                $busRepo = resolve(BusRepositoryInterface::class);
                $facilityRepo = resolve(BusFacilityRepositoryInterface::class);

                $bus = $busRepo->findByServiceNumber($this->service_number);

                if (!empty($bus) && $facilityRepo->facilityExists($bus->id, $busStopId)) {
                    $validator->errors()->add('service_number', 'Bus facility already exists for this bus stop');
                } elseif (!empty($bus) && $facilityRepo->stopNumberExists($bus->id, $this->direction, $this->stop_number)) {
                    $validator->errors()->add('stop_number', 'Stop number already exists for this bus and selected direction');
                }
            });
        }
    }
}
