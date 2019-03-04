<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo', 100);
            $table->string('autor', 80)->nullable();
            $table->string('editorial', 60)->nullable();
            $table->string('edicion', 60)->nullable();
            $table->text('observaciones')->nullable();
            $table->integer('publicacion');
            $table->timestamp('adquisicion')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('ubicaciones_id');
            $table->foreign('ubicaciones_id')->references('id')->on('ubicaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
