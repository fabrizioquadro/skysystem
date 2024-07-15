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
        Schema::create('rastreadors', function (Blueprint $table) {
            $table->id();
            $table->string('cod_rastreador')->unique();
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('tiporastreador_id');
            $table->unsignedBigInteger('modelorastreador_id');
            $table->string('st_rastreador');
            $table->text('ds_motivo_baixa')->nullable();
            $table->unsignedBigInteger('simcard_id')->nullable();
            $table->unsignedBigInteger('estoque_id')->nullable();
            $table->unsignedBigInteger('veiculo_id')->nullable();
            $table->foreign('simcard_id')->references('id')->on('simcards');
            $table->foreign('estoque_id')->references('id')->on('estoques');
            $table->foreign('tiporastreador_id')->references('id')->on('tiporastreadors');
            $table->foreign('modelorastreador_id')->references('id')->on('modelorastreadors');
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rastreadors');
    }
};
