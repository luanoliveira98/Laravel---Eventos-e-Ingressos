<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantify');
            $table->enum('half_entrance', ['N', 'S'])->default('N');
            $table->integer('event_id')->unsigned();
            $table->integer('lots_id')->unsigned();
            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('lots_id')->references('id')->on('lots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
