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
            $table->boolean('is_negotiable')->default(0);
            $table->integer('listing_duration')->nullable();
            $table->string('category')->nullable();
            $table->boolean('home_delivery')->default(0);
            $table->decimal('delivery_charge', 8, 2)->nullable();
            $table->boolean('is_featured')->default(0);
            $table->integer('discount')->nullable();
            $table->integer('views')->default(0);
            $table->text('features')->nullable();
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
