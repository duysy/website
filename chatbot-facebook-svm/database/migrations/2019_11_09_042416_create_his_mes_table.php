<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHisMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('his_mes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('message_in')->charset('utf8');
            $table->string('nhan_data');
            $table->string('idfacebook', 100);
            $table->bigInteger('user_id')->unsigned()->nullable();
                $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('his_mes');
    }
}
