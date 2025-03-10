<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_cita');
            $table->time('hora_cita');
            $table->text('observaciones')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('peluquero_id');
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('servicio_id');
            $table->enum('estado_cita', ['pendiente', 'confirmada', 'anulada', 'expirada'])->default('pendiente'); // Cambiar a enum
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('peluquero_id')->references('id')->on('peluqueros')->onDelete('cascade');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
};