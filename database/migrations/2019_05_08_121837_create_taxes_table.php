<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTaxesTable
 */
class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('port_id')->nullable();
            $table->foreign('port_id')->references('id')->on('ports');
            $table->decimal('amount', 6, 2);
            $table->enum('tax_at', ['departure', 'arrival'])->default('departure')->index();
            $table->text('body')->nullable();
            $table->text('official_info')->nullable();
            $table->boolean('optional')->default(false)->index()->comment('Some taxes are optional, fex disability or locals');
            $table->boolean('global')->default(false)->index()->comment('Global means the tax is not port relative, fex BIR');
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
        Schema::dropIfExists('taxes');
    }
}
