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
        Schema::create('movimentacaoferramentas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ferramenta_id');
            $table->unsignedBigInteger('user_id');
            $table->text('ds_movimentacao');
            $table->double('vl_manutencao',10,2)->nullable();
            $table->foreign('ferramenta_id')->references('id')->on('ferramentas');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacaoferramentas');
    }
};
