<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('slug');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('street')->nullable();
            $table->string('area_location')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('gender')->nullable();
            $table->string('profile_picture')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable();
            $table->string('api_token', 60)->unique();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        \DB::table('users')->insert([
            'full_name' => 'admin',
            'slug'      => 'admin',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt('admin'),
            'confirmed' => 1,
            'is_admin'  => 1,
            'api_token' => str_random(60),
        ]);
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
