<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('contact_nr')->nullable(); //official info
            $table->string('contact_name')->nullable(); //official info
            $table->boolean('is_super_admin')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_statistical')->default(0);
            $table->boolean('is_editor')->default(0);
            $table->boolean('is_port_authority')->default(0);
            $table->boolean('is_operator')->default(0);
            $table->boolean('is_agent')->default(0);
            $table->boolean('is_captain')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('title')->nullable(); //official info
            $table->text('description')->nullable(); //official info
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
