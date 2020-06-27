<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateReservationsTable
 */
class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reservee_id');
            $table->foreign('reservee_id')->references('id')->on('reservees');
            $table->unsignedInteger('departure_id');
            $table->foreign('departure_id')->references('id')->on('departures');
            $table->unsignedInteger('operator_id');
            $table->foreign('operator_id')->references('id')->on('operators');
            $table->boolean('confirmed')->default(0)->comment('By Reservee');
            $table->timestamp('confirmed_at')->nullable();
            $table->boolean('accepted')->default(0)->comment('By Operator');
            $table->timestamp('accepted_at')->nullable()->comment('By Operator');
            $table->boolean('departed')->default(0)->comment('By cashier');
            $table->timestamp('departed_at')->nullable()->comment('By cashier, physically in the port, ready to embark');
            $table->decimal('total_price', 7, 2)->nullable();
            $table->decimal('total_taxes', 7, 2)->nullable();
            $table->decimal('total_reductions', 7, 2)->nullable();
            $table->text('reservee_remark')->nullable();
            $table->text('operator_remark')->nullable();
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
        Schema::dropIfExists('reservations');
    }
}
