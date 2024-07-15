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
        Schema::create('baixa_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('baixa_id');
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('estoque_id');
            $table->integer('qt_produto');
            $table->foreign('baixa_id')->references('id')->on('baixas');
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
        Schema::dropIfExists('baixa_produtos');
    }
};
