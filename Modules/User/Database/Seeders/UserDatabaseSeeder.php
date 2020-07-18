<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\User\Models\User;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Create 10 dummy users.
     *
     * @return void
     * @throws \Throwable
     */
    public function run()
    {
        Model::unguard();

        try {
            factory(User::class, 10)->create();
            DB::commit();
        } catch (\Throwable $t) {
            DB::rollback();
            throw $t;
        }
    }
}
