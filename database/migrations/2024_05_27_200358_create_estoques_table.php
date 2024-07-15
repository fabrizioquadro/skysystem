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
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();
            $table->string('nm_estoque');
            $table->string('ds_local')->nullable();
            $table->string('nr_cnpj_cpf')->nullable();
            $table->string('ds_email')->nullable();
            $table->string('nr_tel')->nullable();
            $table->string('nr_cel')->nullable();
            $table->string('st_estoque_adm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoques');
    }
};
