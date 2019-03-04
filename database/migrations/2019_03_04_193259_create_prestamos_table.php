<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('fecha_prestamo');
            $table->timestamp('fecha_devosucion');
            $table->text('observaciones');
            $table->timestamps();

            $table->unsignedBigInteger('libros_id');
            $table->foreign('libros_id')->references('id')->on('libros');

            $table->unsignedBigInteger('alumnos_id');
            $table->foreign('alumnos_id')->references('id')->on('alumnos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
}
