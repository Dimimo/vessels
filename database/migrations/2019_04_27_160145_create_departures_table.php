<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateDeparturesTable
 */
class CreateDeparturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departures', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vessel_id')->index();
            $table->foreign('vessel_id')->references('id')->on('vessels');
            $table->unsignedInteger('captain_id')->index();
            $table->foreign('captain_id')->references('id')->on('captains');
            $table->dateTime('departure');
            $table->unsignedInteger('from_port_id')->index();
            $table->foreign('from_port_id')->references('id')->on('ports');
            $table->unsignedInteger('to_port_id')->index();
            $table->foreign('to_port_id')->references('id')->on('ports');
            $table->string('travel_time')->nullable(); //string so we can use the native PHP DateTime class, f.ex. +1 day 10 hours 15 minutes
            $table->boolean('cancelled')->default(0);
            $table->text('reason')->nullable(); //if a departure is cancelled, please provide a reason (technical defect, typhoon...)
            $table->text('official_info')->nullable();
            $table->unsignedSmallInteger('passengers')->nullable()->index(); //the real number of passengers on the ship at departure
            $table->dateTime('real_departure')->nullable()->index();
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
        Schema::drop('departures');
    }
}
