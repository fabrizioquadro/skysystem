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
        Schema::create('instalacao_ferramentas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instalacao_id');
            $table->unsignedBigInteger('ferramenta_id');
            $table->unsignedBigInteger('estoque_id');
            $table->foreign('instalacao_id')->references('id')->on('instalacaos');
            $table->foreign('ferramenta_id')->references('id')->on('ferramentas');
            $table->foreign('estoque_id')->references('id')->on('estoques');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intalacao_ferramentas');
    }
};
