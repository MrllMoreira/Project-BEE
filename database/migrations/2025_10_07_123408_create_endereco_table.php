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
        Schema::create('endereco', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->enum("uf", ["AC","AL","AM","AP","BA","CE","DF","ES",
                "GO","MA","MG","MS","MT","PA","PB","PE","PI","PR","RJ",
                "RN","RO","RR","RS","SC","SE","SP","TO"]);
            $table->string("regiao");
            $table->string("cidade");
            $table->string("bairro");
            $table->string("rua");
            $table->integer("numero");
            $table->text("complemento");
            $table->string("cep");
            $table->timestamps(); //todas as tabelas devem contar o timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endereco');
    }
};
