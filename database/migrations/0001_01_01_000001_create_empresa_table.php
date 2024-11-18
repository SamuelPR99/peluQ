<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa');
            $table->string('email')->unique();
            $table->string('telefono');
            $table->string('direccion');
            $table->string('codigo_postal');
            $table->string('coordenadas');
            $table->enum('estado_subscripcion', ['activo', 'inactivo'])->default('activo');
            $table->enum('tipo_empresa', ['peluqueria', 'barberia', 'peluqueria y barberia']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};