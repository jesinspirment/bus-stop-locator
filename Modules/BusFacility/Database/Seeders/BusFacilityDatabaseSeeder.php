<?php

namespace Modules\BusFacility\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Bus\Interfaces\BusRepositoryInterface;
use Modules\Bus\Models\Bus;
use Modules\BusFacility\Interfaces\BusFacilityRepositoryInterface;

class BusFacilityDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param BusRepositoryInterface $busRepo
     * @param BusFacilityRepositoryInterface $busFacilityRepo
     * @return void
     * @throws \Throwable
     */
    public function run(BusRepositoryInterface $busRepo, BusFacilityRepositoryInterface $busFacilityRepo)
    {
        Model::unguard();

        DB::beginTransaction();

        try {
            $buses = $busRepo->all();

            /**
             * As this prototype is not meant to be 100% realistic, bus facilities are genrated under the following simple rules:
             *
             * 1. There are only 2 bus routes (i.e. from Ang Mo Kio interchange to Yio Chu Kang interchange, and opposite direction).
             * 2. All 5 buses use the same route.
             * 3. In between the bus interchanges, there are only 3 bus stops in the middle. Hence, 5 bus stops per route.
             */
            foreach ($buses as $bus) {
                // Direction A
                for ($i = 1; $i <= 5; $i++) {
                    $busFacilityRepo->createBusFacility($bus->id, $i, 'A', $i);
                }

                // Direction B
                for ($i = 5; $i <= 8; $i++) {
                    $busFacilityRepo->createBusFacility($bus->id, $i, 'B', $i - 4);
                }

                // Last bus stop for direction B (bus interchange)
                $busFacilityRepo->createBusFacility($bus->id, 1, 'B', 5);
            }

            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();
            throw $t;
        }
    }
}
