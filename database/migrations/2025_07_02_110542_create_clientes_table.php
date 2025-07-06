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
            $table->string('nome');
            $table->integer('idade');
            $table->enum('estado_civil',['solteira[o]','casada[o]','divorciada[o]','viuva[o]']);
            $table->integer('quantidade_filhos');
            $table->integer('dia_mes');
            $table->enum('dia_semana',['domingo','segunda','terca','quarta','quinta','sexta','sabado']);
            $table->time('horario');
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
