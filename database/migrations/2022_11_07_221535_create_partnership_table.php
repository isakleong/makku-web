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
        Schema::create('partnership', function (Blueprint $table) {
            $table->id();
            $table->string('name')->required();
            $table->string('image')->nullable();
            $table->string('logo')->nullable();
            $table->string('address')->nullable();
            $table->string('instagram', 100)->nullable();
            $table->string('whatsapp', 100)->nullable();
            $table->string('phoneNo', 100)->nullable();
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
        Schema::dropIfExists('partnership');
    }
};
