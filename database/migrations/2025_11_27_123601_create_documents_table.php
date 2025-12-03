<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('file');
            $table->integer('file_size')->default(0);
            $table->string('file_type');
            $table->enum('type', ['pdf', 'doc', 'excel', 'image', 'video', 'other'])->default('other');
            $table->text('description')->nullable();
            $table->integer('download_count')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
