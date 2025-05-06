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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('product_id')->constrained('product_lists')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
        
            $table->integer('quantity');
        
            // Utilisation d'un enum si tu connais les différents statuts possibles
            $table->enum('status', ['pending', 'processus', 'complete', 'cancelled']);
        
            // Correction de la faute de frappe
            $table->string('payment_method');
        
            // Utilisation d'un champ text si l'adresse peut être longue
            $table->text('address');
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
