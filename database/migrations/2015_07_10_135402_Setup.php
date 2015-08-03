<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Setup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('users', function(Blueprint $table)
        {
            $table -> increments('id');
            $table -> string('nome');
            $table -> string('cognome');
            $table -> string('indirizzo');
            $table -> string('im_profilo');
            $table -> string('slug');
        });

        Schema::create('numbers', function(Blueprint $table)
        {
            $table -> increments('id');
            $table -> string('phone');
            $table -> integer('user_id') -> unsigned();
            $table -> foreign('user_id') -> references('id') -> on('users') -> onDelete('cascade');
        });

        Schema::create('emails', function(Blueprint $table)
        {
            $table -> increments('id');
            $table -> string('email');
            $table -> integer('user_id') -> unsigned();
            $table -> foreign('user_id') -> references('id') -> on('users') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('numbers');
        Schema::drop('emails');
        Schema::drop('users');

    }
}
