<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_name')->nullable();
            $table->string('description')->nullable();
            $table->text('image_path');
            $table->string('mime_type')->nullable();
            $table->string('image_size')->nullable();
            $table->string('page')->nullable();
            $table->integer('position')->nullable();
            $table->string('type')->nullable()->default('image');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
    }

}
