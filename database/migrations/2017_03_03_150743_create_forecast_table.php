<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForecastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forecast', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id')->unsigned();
            $table->integer('weather_id')->unsigned();

            $table->date('day');

            $table->tinyInteger('c_min');
            $table->tinyInteger('c_max');
            $table->tinyInteger('f_min');
            $table->tinyInteger('f_max');
            

        });

        Schema::table('forecast', function($table) {

            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onDelete('cascade');

            $table->foreign('weather_id')
                ->references('id')->on('weather')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forecast');
    }
}
