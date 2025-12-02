<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('advertisements', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('image');
    $table->string('url')->nullable();
    $table->string('placement'); // header, sidebar, footer, hero…
    $table->date('start_date');
    $table->date('end_date');
    $table->integer('views')->default(0);
    $table->integer('clicks')->default(0);
    $table->enum('type', ['adherent', 'externe', 'premium'])->default('externe');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
