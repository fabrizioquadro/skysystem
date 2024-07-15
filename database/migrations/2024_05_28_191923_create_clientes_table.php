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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nm_cliente');
            $table->string('tp_pessoa')->nullable();
            $table->string('nr_cnpjcpf')->nullable();
            $table->string('nr_rgie')->nullable();
            $table->string('nr_tel')->nullable();
            $table->string('nr_cel')->nullable();
            $table->string('ds_email')->nullable();
            $table->string('nr_cep')->nullable();
            $table->text('ds_endereco')->nullable();
            $table->text('nr_endereco')->nullable();
            $table->text('ds_complemento')->nullable();
            $table->text('ds_bairro')->nullable();
            $table->text('nm_cidade')->nullable();
            $table->string('ds_uf')->nullable();
            $table->text('ds_obs')->nullable();
            $table->string('nm_contato')->nullable();
            $table->string('nr_telcontato')->nullable();
            $table->string('nr_celcontato')->nullable();
            $table->string('ds_emailcontato')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
