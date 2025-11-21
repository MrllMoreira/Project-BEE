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
            $table->id();
            $table->string("nome");
            $table->string("descricao")->nullable();
            $table->string("status");

            $table->foreignId("unidade_id")->constrained('unidades')->cascadeOnDelete();
            $table->foreignId("created_by")->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId("updated_by")->nullable()->constrained('users')->nullOnDelete();
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
