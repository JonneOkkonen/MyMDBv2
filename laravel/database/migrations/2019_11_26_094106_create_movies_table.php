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
            $table->string('type')->nullable();
            $table->string('imdbID')->nullable();
            $table->string('language')->nullable();
            $table->string('country')->nullable();
            $table->string('runtime')->nullable();
            $table->string('year')->nullable();
            $table->string('genre')->nullable();
            $table->string('rated')->nullable();
            $table->string('released')->nullable();
            $table->string('actors')->nullable();
            $table->string('director')->nullable();
            $table->string('writer')->nullable();
            $table->string('rating')->nullable();
            $table->string('awards')->nullable();
            $table->string('production')->nullable();
            $table->string('rottenTomatoes')->nullable();
            $table->string('plot')->nullable();
            $table->string('posterURL')->nullable();
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
