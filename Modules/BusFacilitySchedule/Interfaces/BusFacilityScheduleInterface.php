<?php

namespace Modules\BusFacilitySchedule\Interfaces;

interface BusFacilityScheduleInterface
{
    /**
     * Generate schedule for bus.
     *
     * @param mixed $bus
     * @return mixed
     */
    public function generateScheduleForBus($bus);
}
