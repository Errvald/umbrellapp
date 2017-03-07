<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->timestamps();

           $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });

        // Schema::table('favorites', function($table) {

        //     $table->foreign('city_id')
        //         ->references('id')->on('cities')
        //         ->onDelete('cascade');

        //     $table->foreign('user_id')
        //         ->references('id')->on('users')
        //         ->onDelete('cascade');

        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('favorites');
    }
}
