<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsteriskCdrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cdrs', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('calldate');
            $table->string('clid', 80);
            $table->string('src', 80);
            $table->string('dst', 80);
            $table->string('dcontext', 80);
            $table->string('channel', 80);
            $table->string('dstchannel', 80);
            $table->string('lastapp', 80);
            $table->string('lastdata', 80);
            $table->integer('duration');
            $table->integer('billsec');
            $table->string('disposition', 45);
            $table->integer('amaflags');
            $table->string('accountcode', 20);
            $table->string('uniqueid', 32);
            $table->string('recordingfile');
            $table->string('cnum', 40);
            $table->string('cnam', 40);
            $table->string('outbound_cnum', 40);
            $table->string('outbound_cnam', 40);
            $table->string('dst_cnam', 40);
            $table->string('did', 50);
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
        //
    }
}
