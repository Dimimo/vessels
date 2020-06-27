<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reservee_id');
            $table->foreign('reservee_id')->references('id')->on('reservees');
            $table->unsignedInteger('reservation_id');
            $table->foreign('reservation_id')->references('id')->on('reservations');
            $table->string('name');
            $table->unsignedSmallInteger('age')->nullable();
            $table->string('nationality')->nullable();
            $table->unsignedInteger('reduction_id')->nullable();
            $table->boolean('wheelchair')->default(0)->nullable();
            $table->decimal('price', 7, 2)->nullable();
            $table->decimal('taxes', 7, 2)->nullable();
            $table->decimal('reductions', 7, 2)->nullable();
            $table->boolean('approved')->default(0)->comment('Pre approved by Vessel Operator');
            $table->boolean('departed')->default(0)->comment('By cashier, person has departed');
            $table->unsignedInteger('user_id')->nullable()->comment('Cashier who approved boarding');
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
        Schema::dropIfExists('passengers');
    }
}
