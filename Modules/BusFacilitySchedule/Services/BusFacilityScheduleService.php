<?php

namespace Modules\BusFacilitySchedule\Services;

use Modules\Bus\Interfaces\BusRepositoryInterface;
use Modules\BusFacilitySchedule\Interfaces\BusFacilityScheduleInterface;
use Modules\BusFacilitySchedule\Interfaces\BusFacilityScheduleRepositoryInterface;

class BusFacilityScheduleService implements BusFacilityScheduleInterface
{
    /**
     * Travel time between bus stops in minutes.
     */
    const TRAVEL_TIME_PER_STOP = 10;

    /**
     * Trip interval in minutes.
     */
    const TRIP_INTERVAL = 20;

    /**
     * Bus repository.
     *
     * @var BusRepositoryInterface
     */
    protected $busRepo;

    /**
     * Bus facility schedule repository.
     *
     * @var BusFacilityScheduleRepositoryInterface
     */
    protected $scheduleRepo;

    /**
     * Class constructor.
     *
     * @param BusRepositoryInterface $busRepo
     * @param BusFacilityScheduleRepositoryInterface $scheduleRepo
     */
    public function __construct(BusRepositoryInterface $busRepo, BusFacilityScheduleRepositoryInterface $scheduleRepo)
    {
        $this->busRepo      = $busRepo;
        $this->scheduleRepo = $scheduleRepo;
    }

    /**
     * @inheritDoc
     * @throws \Exception
     * @see \Modules\BusFacilitySchedule\Interfaces\BusFacilityScheduleRepositoryInterface::generateScheduleForBus()
     */
    public function generateScheduleForBus($bus)
    {
        if (is_int($bus)) {
            $bus = $this->busRepo->find($bus, ['id'], ['facilities']);

            if (empty($bus)) {
                throw new \Exception('Invalid bus ID');
            }
        }

        $schedules = [];

        /**
         * As this prototype is not meant to be 100% realistic, bus schedules are generated in this manner:
         *
         * 1. For every bus interchange, a bus will depart every 20 minutes. Hence, 3 trips per hour per bus.
         * 2. Between bus stops, a bus requires 10 minutes of travel time exactly.
         * 3. All buses will start from 7am and last bus at 10pm (i.e. bus interchange).
         */
        $groupedFacilities = $bus->facilities->groupBy('direction');
        $tripStart         = now()->setTime(7, 0);

        // Since buses operate from 7am to 10pm last bus, that's 15 hours, and total of 45 trips per day
        for ($i = 0; $i < 45; $i++) { // ($i + 1) = trip number
            foreach ($groupedFacilities as $direction => $facilities) {
                foreach ($facilities as $facility) {
                    $estimatedArrivalTime = $tripStart->copy()
                        ->addMinutes(self::TRAVEL_TIME_PER_STOP * ($facility->stop_number - 1));

                    $schedules[] = [
                        'bus_facility_id'        => $facility->id,
                        'trip_number'            => $i + 1,
                        'estimated_arrival_time' => $estimatedArrivalTime,
                    ];
                }
            }

            $tripStart->addMinutes(self::TRIP_INTERVAL);
        }

        $this->scheduleRepo->bulkCreate($schedules);
    }
}
