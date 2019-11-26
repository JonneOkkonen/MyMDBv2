<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('movieID');
            $table->unsignedBigInteger('userID');
            $table->string('name');
            $table->string('type');
            $table->string('runtime');
            $table->string('year');
            $table->string('genre');
            $table->string('rated');
            $table->string('released');
            $table->string('actors');
            $table->string('director');
            $table->string('writer');
            $table->string('rating');
            $table->string('rottenTomatoes');
            $table->string('plot');
            $table->string('posterURL');
            $table->timestamps();
            
            // Add Foreign Keys
            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
