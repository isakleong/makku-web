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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('name')->required();
            $table->text('highlight_en')->required();
            $table->text('highlight_id')->required();
            $table->text('description_en')->required();
            $table->text('description_id')->required();
            $table->string('image')->required();
            $table->string('logoPrimary')->required();
            $table->string('logoSecondary')->required();
            $table->string('address')->required();
            $table->string('email')->required();
            $table->string('facebook')->required();
            $table->string('instagram')->required();
            $table->string('whatsapp')->required();
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
        Schema::dropIfExists('company');
    }
};
