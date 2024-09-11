<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('vendedores', function (Blueprint $table) {
            $table->id(); // Chave primária auto-incremento
            $table->string('nome'); // Campo para o nome
            $table->string('documento'); // Campo para o documento (CPF ou CNPJ)
            $table->enum('tipo_documento', ['CPF', 'CNPJ']); // Campo para tipo de documento
            $table->date('data_fechamento')->nullable(); // Campo para data de fechamento
            $table->timestamps(); // Campos de timestamps: created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('vendedores');
    }
}       
