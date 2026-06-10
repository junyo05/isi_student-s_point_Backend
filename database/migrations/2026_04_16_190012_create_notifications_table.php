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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['etudiant', 'enseignant', 'admin'])->nullable();
            $table->enum('type', ['role', 'classe', 'individuel']);
            $table->string('titre');
            $table->string('contenu');
            $table->boolean('est_lu');
            $table->foreignId('cible_id')->nullable();
            $table->string('cible_type')->nullable();
            $table->foreignId('classes_id')->nullable()->constrained('classes')->nullOnDelete();
            $table->foreignId('utilisateur_id')->nullable()->constrained('utilisateurs')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
