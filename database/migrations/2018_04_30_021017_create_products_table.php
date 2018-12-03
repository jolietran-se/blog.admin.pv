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
            $table->integer('category_id')->unsigned();
            $table->integer('manufacture_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->boolean('status')->default(false)->nullable();
            $table->string('sale_price')->nullable();
            $table->string('origin_price')->nullable();
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
        Schema::dropIfExists('products');
    }
}
