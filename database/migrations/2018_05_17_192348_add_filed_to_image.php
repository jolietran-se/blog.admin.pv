<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiledToImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gallary_images', function (Blueprint $table) {
            $table->integer('color_id')->unsigned();
            $table->foreign('color_id')->references('id')->on('colors');
            $table->string('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallary_images', function (Blueprint $table) {
            Schema::dropIfExists('product_details');
        });
    }
}
