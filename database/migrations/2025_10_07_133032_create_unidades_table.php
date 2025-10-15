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
        Schema::create('unidades', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nome');
            $table->string('codigo_unidade')->unique(); //deve ser unico

            $table->string('telefone');
            $table->string('celular');
            $table->string('email')->unique(); //deve ser unico
            
            $table->foreignId('unidade_tipo_id')->constrained('unidades_tipo');
            $table->foreignId('endereco_id')->constrained('endereco');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->string('responsavel')->constrained('users');
            $table->timestamps();
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};
