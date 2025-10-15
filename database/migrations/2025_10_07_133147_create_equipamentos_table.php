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
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('codigo_patrimonio')->nullable()->unique();// codigo no patrimonio tem que ser unique certo? e porque ele pode ser nullabe? documentos devem ter sempre o codigo certo?
            $table->text('descricao')->nullable();
            
            $table->foreignId('categoria_id')->constrained('categoria_equipamentos');
            $table->foreignId('marca_id')->constrained('marcas_equipamentos');
            $table->foreignId('status_id')->constrained('equipamentos_status');
            $table->foreignId('inventario_id')->constrained('inventario');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete(); // deixar nulo caso o usuario seja deletado
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipamentos');
    }
};
