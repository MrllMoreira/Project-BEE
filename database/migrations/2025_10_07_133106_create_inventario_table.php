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
        Schema::create('inventario', function (Blueprint $table) {
            $table->id()->autoIncrement(); // nao é obrigatorio ser auto increment porque por padrao o id ja é , mas se quiser deixar tudo bem
            $table->string("nome");
            $table->foreignId("unidade_id")->constrained('unidades');
            $table->foreignId("status")->constrained('inventario_status');
            $table->foreignId("created_by")->constrained('users');
            $table->foreignId("updated_by")->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};
