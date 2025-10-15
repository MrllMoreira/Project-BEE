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
        Schema::create('equipamentos_status', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string("nome")->unique();
            $table->string("descricao");
            $table->timestamps(); //todas as tabelas devem contar o timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipamentos_status');
    }
};
