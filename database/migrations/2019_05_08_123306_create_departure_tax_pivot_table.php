<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDepartureTaxPivotTable
 */
class CreateDepartureTaxPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departure_tax', function (Blueprint $table) {
            $table->integer('departure_id')->unsigned()->index();
            $table->foreign('departure_id')->references('id')->on('departures')->onDelete('cascade');
            $table->integer('tax_id')->unsigned()->index();
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade');
            $table->primary(['departure_id', 'tax_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departure_tax');
    }
}
