<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_facilities', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('bus_stop_id');
            $table->char('direction', 1)->index();
            $table->unsignedInteger('stop_number');

            // Unique constraints
            $table->unique(['bus_id', 'bus_stop_id', 'direction', 'stop_number'], 'bus_stop_buses_unique');

            // Foreign keys
            $table->foreign('bus_id')
                ->references('id')
                ->on('buses');

            $table->foreign('bus_stop_id')
                ->references('id')
                ->on('bus_stops');

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
        Schema::dropIfExists('bus_facilities');
    }
}
