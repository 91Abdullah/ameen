<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplyTosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply_tos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('personal');
            $table->string('mailbox');
            $table->string('host');
            $table->string('mail');
            $table->string('full');
            $table->integer('inbox_id')->unsigned();
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
        Schema::dropIfExists('reply_tos');
    }
}
