<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCitiesTable
 */
class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 80);
                $table->string('slug');
                $table->string('postcode', 12)->nullable();
                $table->unsignedInteger('province_id')->index();
                $table->foreign('province_id')->references('id')->on('provinces');
                $table->decimal('lng', 12, 7)->index();
                $table->decimal('lat', 12, 7)->index();
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
        Schema::dropIfExists('cities');
    }
}
