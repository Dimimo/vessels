<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateReserveesTable
 */
class CreateReserveesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->index();
            $table->string('email');
            $table->string('password');
            $table->unsignedInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->enum('title', ['', 'Mr. ', 'Mrs. ', 'Miss ']);
            $table->string('contact_nr')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->rememberToken();
            $table->text('description')->nullable();
            $table->text('settings')->nullable();
            $table->string('picture')->nullable();
            $table->boolean('status')->default(false);
            $table->string('stripe_id')->nullable()->collation('utf8mb4_bin');
            $table->string('card_brand')->nullable();
            $table->string('card_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('reservees');
    }
}
