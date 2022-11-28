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
        Schema::create('news_article', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoryID')->required();
            $table->foreign('categoryID')->references('id')->on('news_category')->onDelete('restrict');
            $table->string('title_en')->required();
            $table->string('title_id')->required();
            $table->string('slug_en')->unique()->required();
            $table->string('slug_id')->unique()->required();
            $table->longText('content_en')->required();
            $table->longText('content_id')->required();
            $table->text('tags_en')->nullable();
            $table->text('tags_id')->nullable();
            $table->string('image')->required();
            $table->string('author', 100)->required();
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
        Schema::dropIfExists('news_article');
    }
};
