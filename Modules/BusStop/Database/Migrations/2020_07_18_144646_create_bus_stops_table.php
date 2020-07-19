<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusStopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_stops', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            $table->string('reference_code')->unique();
            $table->string('location_name')->unique();
            $table->decimal('latitude', 10, 8);
            $table->unsignedDecimal('longitude', 11, 8);
            $table->boolean('is_bus_interchange')->default(false);

            // Constraints
            $table->unique(['latitude', 'longitude'], 'bus_stop_location_unique');

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
        Schema::dropIfExists('bus_stops');
    }
}
