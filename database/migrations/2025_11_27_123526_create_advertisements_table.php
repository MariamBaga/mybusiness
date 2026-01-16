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
            // Ajouter ces colonnes pour gérer le paiement et les annonceurs externes (section 13.2)
$table->enum('target', ['members', 'public'])->default('members');
$table->foreignId('advertiser_id')->nullable()->constrained('users')->nullOnDelete();
$table->string('advertiser_name')->nullable(); // Pour annonceurs non-connectés
$table->decimal('price_paid', 10, 2)->nullable();
$table->string('payment_status')->default('pending'); // pending, paid, failed
$table->string('payment_method')->nullable();
$table->string('transaction_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
};
