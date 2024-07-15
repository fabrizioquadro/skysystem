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
        Schema::create('simcards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operadora_id');
            $table->string('nr_tel');
            $table->string('nr_icc');
            $table->string('st_simcard');
            $table->text('ds_motivo_baixa')->nullable();
            $table->foreign('operadora_id')->references('id')->on('operadoras');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simcards');
    }
};
