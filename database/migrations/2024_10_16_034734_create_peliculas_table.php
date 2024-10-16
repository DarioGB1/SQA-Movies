<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');  // Título de la película
            $table->integer('duracion');  // Duración en minutos
            $table->date('fecha_estreno');  // Fecha de estreno de la película
            $table->text('sinopsis')->nullable();  // Sinopsis de la película
            $table->string('director');  // Director de la película
            $table->string('genero');  // Género de la película
            $table->string('imagen_url')->nullable(); // URL de la imagen de la película
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peliculas');
    }
}
