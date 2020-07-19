<?php

namespace Modules\BusStop\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\BusStop\Interfaces\BusStopRepositoryInterface;

class BusStopDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param BusStopRepositoryInterface $busStopRepo
     * @return void
     * @throws \Throwable
     */
    public function run(BusStopRepositoryInterface $busStopRepo)
    {
        Model::unguard();

        DB::beginTransaction();

        try {
            // Ang Mo Kio (Nanyang Polytechnic)
            $busStopRepo->bulkCreate([
                [
                    'reference_code'     => 'B0010000',
                    'location_name'      => 'Ang Mo Kio Bus Interchange',
                    'latitude'           => '1.385449',
                    'longitude'          => '103.849813',
                    'is_bus_interchange' => true,
                ], [
                    'reference_code'     => 'B0011001',
                    'location_name'      => 'Ang Mo Kio Ave 1',
                    'latitude'           => '1.384179',
                    'longitude'          => '103.851162',
                    'is_bus_interchange' => false,
                ], [
                    'reference_code'     => 'B0011002',
                    'location_name'      => 'Ang Mo Kio Ave 2',
                    'latitude'           => '1.382889',
                    'longitude'          => '103.850893',
                    'is_bus_interchange' => false,
                ], [
                    'reference_code'     => 'B0011003',
                    'location_name'      => 'Ang Mo Kio Ave 3',
                    'latitude'           => '1.381625',
                    'longitude'          => '103.850786',
                    'is_bus_interchange' => false,
                ], [
                    'reference_code'     => 'B0020000',
                    'location_name'      => 'Yio Chu Kang Bus Interchange',
                    'latitude'           => '1.379172',
                    'longitude'          => '103.850860',
                    'is_bus_interchange' => true,
                ], [
                    'reference_code'     => 'B0012001',
                    'location_name'      => 'Opposite Ang Mo Kio Ave 3',
                    'latitude'           => '1.379295',
                    'longitude'          => '103.849199',
                    'is_bus_interchange' => false,
                ], [
                    'reference_code'     => 'B0012002',
                    'location_name'      => 'Opposite Ang Mo Kio Ave 2',
                    'latitude'           => '1.379624',
                    'longitude'          => '103.848466',
                    'is_bus_interchange' => false,
                ], [
                    'reference_code'     => 'B0012003',
                    'location_name'      => 'Opposite Ang Mo Kio Ave 1',
                    'latitude'           => '1.382577',
                    'longitude'          => '103.848999',
                    'is_bus_interchange' => false,
                ]
            ]);

            DB::commit();
        } catch (\Throwable $t) {
            DB::rollback();
            throw $t;
        }
    }
}
