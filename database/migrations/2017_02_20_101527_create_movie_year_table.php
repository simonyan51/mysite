<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieYearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('year_movie', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('movie_id')->unsigned();
            $table->foreign('year_id')->references('id')->on('movies');

            $table->integer('year_id')->unsigned();
            $table->foreign('year_id')->references('id')->on('years');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('year_movie');
    }
}
