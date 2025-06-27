<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        //migration feita para tirar 'presenca_id', e adicionar: 'aluno_id', 'cronograma_id', 'periodo'
        Schema::table('justificativas', function (Blueprint $table) {

            if (Schema::hasColumn('justificativas', 'presenca_id')) {
                $table->dropForeign(['presenca_id']);
                $table->dropColumn('presenca_id');
            }

            $table->unsignedBigInteger('aluno_id')->after('id');
            $table->unsignedBigInteger('cronograma_id')->after('aluno_id');
            $table->unsignedBigInteger('cronograma_id')->after('aluno_id');

            $table->string('periodo')->after('cronograma_id');

            $table->foreign('aluno_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cronograma_id')->references('id')->on('cronogramas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('justificativas', function (Blueprint $table) {

            $table->dropForeign(['aluno_id']);
            $table->dropForeign(['cronograma_id']);
            $table->dropColumn(['aluno_id', 'cronograma_id', 'periodo']);

            $table->unsignedBigInteger('presenca_id')->nullable()->after('id');
            $table->foreign('presenca_id')->references('id')->on('presencas')->onDelete('set null');
        });
    }
};

