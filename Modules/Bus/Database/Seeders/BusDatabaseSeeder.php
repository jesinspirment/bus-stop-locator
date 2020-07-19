<?php

namespace Modules\Bus\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Bus\Models\Bus;

class BusDatabaseSeeder extends Seeder
{
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
            factory(Bus::class, 5)->create();
            DB::commit();
        } catch (\Throwable $t) {
            DB::rollback();
            throw $t;
        }
    }
}
