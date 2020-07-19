<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusFacilitySchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_facility_schedules', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            $table->unsignedBigInteger('bus_facility_id');
            $table->unsignedInteger('trip_number');
            $table->time('estimated_arrival_time');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bus_facility_id')
                ->references('id')
                ->on('bus_facilities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_facility_schedules');
    }
}
