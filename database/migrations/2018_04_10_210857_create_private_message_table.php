<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_message', function (Blueprint $table) {
            Schema::enableForeignKeyConstraints();
            $table->increments('id');
            $table->string('message', 150);
            $table->integer('idreceiver');
            $table->integer('idsender');
            $table->foreign('idreceiver')->references('id')->on('users');
            $table->foreign('idsender')->references('id')->on('users');
            $table->integer('status_msg');
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
        Schema::dropIfExists('private_message');
    }
}
