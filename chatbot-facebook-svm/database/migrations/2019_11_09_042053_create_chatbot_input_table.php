<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatbotInputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatbot_input', function (Blueprint $table) {
            $table->engine = 'InnoDB';
                $table->bigIncrements('id');
                $table->string('nhan_data');
                $table->string('input');
                $table->boolean('isfun')->default(false);
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
        Schema::dropIfExists('chatbot_input');
    }
}
