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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained();
            $table->foreignId('module_id')->constrained();
            $table->foreignId('session_id')->constrained();
            $table->decimal('CF_N',9,2)->nullable();
            $table->decimal('TP_N',9,2)->nullable();
            $table->decimal('MG_N',9,2)->nullable();
            $table->decimal('CF_R',9,2)->nullable();
            $table->decimal('MG_R',9,2)->nullable();
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
