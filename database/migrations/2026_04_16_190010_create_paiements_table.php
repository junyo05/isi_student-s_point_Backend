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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->double('montant');
            $table->enum('type', ['mensualite', 'frais annexes', 'inscription']);
            $table->enum('status', ['a venir', 'payer', 'impayer']);
            $table->date('date_paiement')->nullable();
            $table->string('reference');
            $table->foreignId('etudiant_id')->nullable()->constrained('utilisateurs')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
