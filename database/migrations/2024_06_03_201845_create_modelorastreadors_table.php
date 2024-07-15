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
        Schema::create('modelorastreadors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('tiporastreador_id');
            $table->string('nm_modelo');
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('tiporastreador_id')->references('id')->on('tiporastreadors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelorastreadors');
    }
};
