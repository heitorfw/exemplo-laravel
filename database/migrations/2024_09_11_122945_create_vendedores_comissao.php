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
        Schema::create('vendedores_comissao', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('ativo');
            $table->unsignedBigInteger('vendedor_id');
            $table->unsignedBigInteger('comissoes_id');
            $table->foreign('vendedor_id')->references('id')->on('vendedores')->onDelete('cascade');
            $table->foreign('comissoes_id')->references('id')->on('comissoes')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendedores_comissao');
    }
};
