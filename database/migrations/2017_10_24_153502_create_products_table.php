<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('status')->nullable();
            $table->string('condition')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('listing_duration')->nullable();
            $table->string('category')->nullable();
            $table->decimal('delivery_charge', 8, 2)->nullable();
            $table->string('features')->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
