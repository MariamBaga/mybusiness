<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('url')->nullable();
            $table->enum('placement', ['header', 'sidebar', 'footer', 'popup'])->default('sidebar');
            $table->enum('type', ['banner', 'video', 'text'])->default('banner');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('views')->default(0);
            $table->integer('clicks')->default(0);
            $table->integer('priority')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
};
