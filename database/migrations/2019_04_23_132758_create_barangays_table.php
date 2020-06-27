<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBarangaysTable
 */
class CreateBarangaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangays',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 80);
                $table->string('slug');
                $table->unsignedInteger('city_id')->index();
                $table->foreign('city_id')->references('id')->on('cities');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangays');
    }
}
