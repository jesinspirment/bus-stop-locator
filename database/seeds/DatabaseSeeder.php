<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Modules\User\Database\Seeders\UserDatabaseSeeder::class);
        $this->call(\Modules\Bus\Database\Seeders\BusDatabaseSeeder::class);
        $this->call(\Modules\BusStop\Database\Seeders\BusStopDatabaseSeeder::class);
        $this->call(\Modules\BusFacility\Database\Seeders\BusFacilityDatabaseSeeder::class);
        $this->call(\Modules\BusFacilitySchedule\Database\Seeders\BusFacilityScheduleDatabaseSeeder::class);
    }
}
