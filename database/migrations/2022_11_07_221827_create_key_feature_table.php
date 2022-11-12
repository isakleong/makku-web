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
        Schema::create('key_feature', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->required();
            $table->string('name_id')->required();
            $table->string('image')->nullable();
            $table->string('orderNumber', 3)->required();
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
        Schema::dropIfExists('key_feature');
    }
};
