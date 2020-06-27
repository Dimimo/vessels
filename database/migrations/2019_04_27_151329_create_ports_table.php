<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreatePortsTable
 */
class CreatePortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->index();
            $table->string('email')->unique()->nullable();
            $table->unsignedInteger('city_id')->index();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('contact_nr')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('emergency_nr')->nullable(); //official info
            $table->string('emergency_name')->nullable(); //official info
            $table->text('official_info')->nullable(); //official info
            $table->string('url')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->text('body')->nullable();
            $table->decimal('lat', 12, 7)->nullable()->index();
            $table->decimal('lng', 12, 7)->nullable()->index();
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
        Schema::dropIfExists('ports');
    }
}
