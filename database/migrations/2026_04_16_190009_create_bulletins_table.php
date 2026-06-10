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
        Schema::create('bulletins', function (Blueprint $table) {
            $table->id();
            $table->String('semestre');
            $table->double('moyenne');
            $table->string('chemin_pdf');
            $table->enum('status', ['brouillon', 'publie']);
            $table->string('creer_par');
            $table->foreignId('inscriptions_id')->nullable()->constrained('inscriptions')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulletins');
    }
};
