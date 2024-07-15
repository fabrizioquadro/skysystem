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
        Schema::create('entradaprodutos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entrada_id');
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('estoque_id');
            $table->integer('qt_produto');
            $table->double('vl_produto');
            $table->foreign('entrada_id')->references('id')->on('entradas');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('estoque_id')->references('id')->on('estoques');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradaprodutos');
    }
};
