<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reductions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedSmallInteger('percentage')->nullable();
            $table->decimal('value', 7, 2)->nullable();
            $table->unsignedSmallInteger('max_age')->nullable();
            $table->unsignedSmallInteger('min_age')->nullable();
            $table->text('remark')->nullable();
            $table->unsignedInteger('issued_by')->nullable()->comment('Admin who created the reduction');
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
        Schema::dropIfExists('reductions');
    }
}
