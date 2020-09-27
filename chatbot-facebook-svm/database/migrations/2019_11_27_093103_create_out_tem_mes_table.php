<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutTemMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_tem_mes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nhan_data');
            $table->longText('code');
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
        Schema::dropIfExists('out_tem_mes');
    }
}
