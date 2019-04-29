<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateOperatorsTable
 */
class CreateOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->index();
            $table->string('company_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('logo')->nullable(); //the path to the logo file of the company
            $table->string('city')->index();
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
        Schema::dropIfExists('operators');
    }
}
