<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDummyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // SEE: https://laravel.com/docs/8.x/migrations#creating-tables
        //
        // The above shows how to use the table builder
        //
        // Run php artisan migrate:fresh --seed to create and seed tables every
        // time you make a change

        Schema::create('dummy', function (Blueprint $table) {
            $table->id();
            // put in $table->COLUMN_TYPE(column name, optional params), add ->nullable() if you need
            $table->integer('an_integer')->nullable();
            $table->timestamps();
        });

        /// AFTER YOU HAVE MADE A NEW TABLE YOU SHOULD ADD A MODEL
        /// php artisan make:model ModelName
        /// ModelName automatically connects to a table in plural form
        /// i.e: model called User will auto connect to table called 'Users'
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dummy');
    }
}
