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
        Schema::create('justificativas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('presenca_id')->constrained()->onDelete('cascade');
            $table->text('texto')->nullable();
            $table->string('anexo')->nullable(); // caminho do arquivo
            $table->enum('status', ['pendente', 'aprovada', 'recusada'])->default('pendente');
            $table->foreignId('avaliado_por')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('avaliado_em')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('justificativas');
    }
};
