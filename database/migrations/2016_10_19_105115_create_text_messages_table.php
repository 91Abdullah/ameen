<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sender');
            $table->string('type');
            $table->string('reciever');
            $table->string('message');
            $table->string('status');
            $table->string('message_id');
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
        Schema::dropIfExists('text_messages');
    }
}
