<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOperatorPortPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_port', function (Blueprint $table) {
            $table->integer('operator_id')->unsigned()->index();
            $table->foreign('operator_id')->references('id')->on('operators')->onDelete('cascade');
            $table->integer('port_id')->unsigned()->index();
            $table->foreign('port_id')->references('id')->on('ports')->onDelete('cascade');
            $table->primary(['operator_id', 'port_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('operator_port');
    }
}
