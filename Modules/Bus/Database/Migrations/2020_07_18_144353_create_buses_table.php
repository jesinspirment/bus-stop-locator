<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            $table->integer('service_number')->unique();
            $table->time('direction_a_start_time');
            $table->time('direction_a_end_time');
            $table->time('direction_b_start_time');
            $table->time('direction_b_end_time');

            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
}
