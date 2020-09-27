<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeyApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_api', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('hubVerifyToken')->nullable();
            $table->longText('accessToken')->nullable();
            $table->longText('id_page')->nullable();
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
        Schema::dropIfExists('key_api');
    }
}
