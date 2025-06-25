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
        //Esta migration foi adicionada para permitir pin nullable na tabela presenca, em casos de check-out não existe pin
        //Sendo assim, validações foram incluidas no PresecaController para garantir que na acao 'check-in' o pin seja unique e not null
        Schema::table('presencas', function (Blueprint $table) {
            $table->integer('pin')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('presencas', function (Blueprint $table) {
            $table->integer('pin')->nullable(false)->change();
        });
    }
};
