<?php

namespace Modules\BusFacilitySchedule\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Bus\Interfaces\BusRepositoryInterface;
use Modules\BusFacilitySchedule\Interfaces\BusFacilityScheduleInterface;

class BusFacilityScheduleDatabaseSeeder extends Seeder
{
    /**
     * Bus repository.
     *
     * @var BusRepositoryInterface
     */
    protected $busRepo;

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
     * @param BusFacilityScheduleInterface $scheduleService
     */
    public function __construct(BusRepositoryInterface $busRepo, BusFacilityScheduleInterface $scheduleService)
    {
        $this->busRepo         = $busRepo;
        $this->scheduleService = $scheduleService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Throwable
     */
    public function run()
    {
        Model::unguard();

        DB::beginTransaction();

        try {
            $this->generateSchedules();
            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();
            throw $t;
        }
    }

    /**
     * Generate schedules for all buses.
     */
    private function generateSchedules()
    {
        $buses = $this->busRepo->all(['id'], ['facilities']);

        foreach ($buses as $bus) {
            $this->scheduleService->generateScheduleForBus($bus);
        }
    }
}
