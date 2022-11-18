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
        Schema::create('menu_bar', function (Blueprint $table) {
            $table->id();
            $table->string('title_en', 50)->required();
            $table->string('title_id', 50)->required();
            $table->string('orderNumber', 3)->required();
            $table->string('refer', 100)->required();
            $table->string('type', 100)->required();
            $table->string('parent', 10)->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('menu_bar');
    }
};
