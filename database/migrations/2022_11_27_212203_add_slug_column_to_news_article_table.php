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
        Schema::table('news_article', function (Blueprint $table) {
            $table->string('slug_en')->after('title_id')->unique()->required();
            $table->string('slug_id')->after('slug_en')->unique()->required();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_article', function (Blueprint $table) {
            $table->drop('slug_en');
            $table->drop('slug_id');
        });
    }
};
