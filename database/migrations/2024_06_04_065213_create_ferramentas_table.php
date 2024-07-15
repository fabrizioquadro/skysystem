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
        Schema::create('ferramentas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('estoque_id')->nullable();
            $table->string('nm_ferramenta');
            $table->text('ds_ferramenta')->nullable();
            $table->double('vl_ferramenta',10,2);
            $table->string('st_ferramenta');
            $table->text('ds_motivo_baixa')->nullable();
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('estoque_id')->references('id')->on('estoques');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ferramentas');
    }
};
