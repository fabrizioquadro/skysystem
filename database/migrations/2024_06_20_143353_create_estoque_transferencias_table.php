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
        Schema::create('estoque_transferencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('origem_estoque_id');
            $table->unsignedBigInteger('destino_estoque_id');
            $table->integer('qt_produto');
            $table->date('dt_transferencia');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('origem_estoque_id')->references('id')->on('estoques');
            $table->foreign('destino_estoque_id')->references('id')->on('estoques');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoque_transferencias');
    }
};
