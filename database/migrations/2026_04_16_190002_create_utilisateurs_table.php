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
        Schema::create('utilisateurs', function (Blueprint $table) {
             $table->id();
             $table->string('prenom');
             $table->string('nom');
             $table->string('mot_de_passe');
             $table->string('matricule')->unique();
             $table->date('date_naissance')->nullable();
             $table->string('lieu_naissance')->nullable();
             $table->enum('sexe', ['Masculin', 'Feminin'])->nullable();
             $table->string('adresse')->nullable();
             $table->string('mail')->unique();
             $table->enum('role', ['etudiant', 'enseignant', 'admin']);
             $table->string('tel')->nullable();
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
