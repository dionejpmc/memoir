<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemoirfeedmsgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memoirfeedmsg', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->foreign('userid')->references('id')->on('users');
            $table->string('titlememoir', 150);
            $table->text('textmemoir');
            $table->string('urlimg', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memoirfeedmsg');
    }
}
