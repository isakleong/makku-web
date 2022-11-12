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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoryID')->required();
            $table->foreign('categoryID')->references('id')->on('news_category')->onDelete('restrict');
            $table->unsignedBigInteger('articleID')->required();
            $table->foreign('articleID')->references('id')->on('news_article')->onDelete('restrict');
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
        Schema::dropIfExists('news');
    }
};
