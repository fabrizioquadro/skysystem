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
        Schema::create('instalacaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('veiculo_id');
            $table->unsignedBigInteger('rastreador_id');
            $table->unsignedBigInteger('simcard_id');
            $table->unsignedBigInteger('user_id');
            $table->date('dt_instalacao');
            $table->date('dt_desinstalacao')->nullable();
            $table->string('st_instalacao');
            $table->text('ds_obs')->nullable();
            $table->text('ds_obs_desinstalacao')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
            $table->foreign('rastreador_id')->references('id')->on('rastreadors');
            $table->foreign('simcard_id')->references('id')->on('simcards');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instalacaos');
    }
};
