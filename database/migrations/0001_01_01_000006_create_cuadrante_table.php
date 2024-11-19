<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cuadrantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peluquero_id')->constrained()->onDelete('cascade');
            $table->foreignId('servicio_id')->constrained()->onDelete('cascade');
            $table->date('fecha');
            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cuadrantes');
    }
};