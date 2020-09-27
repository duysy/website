<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunTemMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_tem_mes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('loai');
            $table->longText('code');
            $table->boolean('issetting')->default(false);
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
        Schema::dropIfExists('fun_tem_mes');
    }
}
