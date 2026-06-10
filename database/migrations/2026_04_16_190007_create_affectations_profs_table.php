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
        Schema::create('affectations_profs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enseignant_id')->nullable()->constrained('utilisateurs')->nullOnDelete();
            $table->foreignId('matieres_id')->nullable()->constrained('matieres')->nullOnDelete();
            $table->foreignId('classes_id')->nullable()->constrained('classes')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affectations_profs');
    }
};
