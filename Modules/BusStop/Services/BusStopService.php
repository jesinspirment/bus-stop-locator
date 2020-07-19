<?php

namespace Modules\BusStop\Services;

use Modules\Bus\Interfaces\BusRepositoryInterface;
use Modules\BusFacility\Interfaces\BusFacilityRepositoryInterface;
use Modules\BusFacilitySchedule\Interfaces\BusFacilityScheduleInterface;
use Modules\BusStop\Interfaces\BusStopInterface;

class BusStopService implements BusStopInterface
{
    /**
     * Bus repository.
     *
     * @var BusRepositoryInterface
     */
    protected $busRepo;

    /**
     * Bus facility repository.
     *
     * @var BusFacilityRepositoryInterface
     */
    protected $facilityRepo;

    /**
     * Bus facility schedule service.
     *
     * @var BusFacilityScheduleInterface
     */
    protected $scheduleService;

    /**
     * Class constructor.
     *
     * @param BusRepositoryInterface $busRepo
     * @param BusFacilityRepositoryInterface $facilityRepo
     * @param BusFacilityScheduleInterface $scheduleService
     */
    public function __construct(BusRepositoryInterface $busRepo, BusFacilityRepositoryInterface $facilityRepo, BusFacilityScheduleInterface $scheduleService)
    {
        $this->busRepo         = $busRepo;
        $this->facilityRepo    = $facilityRepo;
        $this->scheduleService = $scheduleService;
    }

    /**
     * @inheritDoc
     * @throws \Exception
     * @see \Modules\BusStop\Interfaces\BusStopInterface::addBusToBusStop()
     */
    public function addBusToBusStop(int $busStopId, int $busServiceNumber, string $direction, int $stopNumber)
    {
        // Firstly, check if bus number already exists
        $bus = $this->busRepo->findByServiceNumber($busServiceNumber);

        if (empty($bus)) {
            // Timings hardcoded for now as this is just prototype
            $bus = $this->busRepo->create([
                'service_number'         => $busServiceNumber,
                'direction_a_start_time' => '07:00',
                'direction_a_end_time'   => '23:00',
                'direction_b_start_time' => '07:00',
                'direction_b_end_time'   => '23:00',
            ]);
        }

        // Next, check if we already have bus facility for the bus stop
        if ($this->facilityRepo->facilityExists($bus->id, $busStopId)) {
            throw new \Exception('Facility alraedy exists');
        }

        $this->facilityRepo->createBusFacility($bus->id, $busStopId, $direction, $stopNumber);

        // Just generate a bus schedule straight, this is just prototype, so is ok
        $this->scheduleService->generateScheduleForBus($bus->id);
    }
}
