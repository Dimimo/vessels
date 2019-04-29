<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateVesselsTable
 */
class CreateVesselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->index();
            $table->string('nickname')->nullable();
            $table->unsignedInteger('vessel_type_id');
            $table->foreign('vessel_type_id')->references('id')->on('vessel_types');
            $table->unsignedInteger('operator_id');
            $table->foreign('operator_id')->references('id')->on('operators');
            $table->unsignedInteger('captain_id')->nullable(); //a captain can be assigned but it doesn't have to be
            $table->foreign('captain_id')->references('id')->on('captains');
            $table->unsignedSmallInteger('capacity')->nullable();
            $table->string('description')->nullable();
            $table->text('body')->nullable();
            $table->boolean('in_service')->default(1);
            $table->date('operational_since')->nullable();
            $table->string('picture')->nullable();
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
        Schema::drop('vessels');
    }
}
