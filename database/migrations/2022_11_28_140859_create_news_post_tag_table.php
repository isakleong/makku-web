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
        Schema::create('news_post_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('articleID')->required();
            $table->foreign('articleID')->references('id')->on('news_article')->onDelete('restrict');
            $table->unsignedBigInteger('tagID')->required();
            $table->foreign('tagID')->references('id')->on('news_tag')->onDelete('restrict');
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
        Schema::dropIfExists('news_post_tag');
    }
};
