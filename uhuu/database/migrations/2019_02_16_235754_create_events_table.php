<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('max_tickets_order');
            $table->date('date');
            $table->date('date_end');
            $table->time('time');
            $table->time('time_end');
            $table->string('image')->nullable();
            $table->text('description');
            $table->string('place_name');
            $table->string('place_city');
            $table->string('place_uf');
            $table->enum('closed', ['N', 'S'])->default('N');
            $table->enum('sold', ['N', 'S'])->default('N');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
