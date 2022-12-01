<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoryID')->required();
            $table->foreign('categoryID')->references('id')->on('product_category')->onDelete('restrict');
            $table->unsignedBigInteger('brandID')->required();
            $table->foreign('brandID')->references('id')->on('product_brand')->onDelete('restrict');
            $table->string('name_en')->required();
            $table->string('name_id')->required();
            $table->string('slug')->required();
            $table->string('image')->required();
            $table->string('active', 1)->required();
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
        Schema::dropIfExists('product');
    }
};
