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
        Schema::create('movimentacaosimcards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('simcard_id');
            $table->unsignedBigInteger('user_id');
            $table->text('ds_movimentacao');
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
        Schema::dropIfExists('movimentacaosimcards');
    }
};
