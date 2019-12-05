<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messager', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_from_id');
            $table->foreign('user_from_id')->references('id')->on('users')->onDelete('Cascade');
            $table->unsignedBigInteger('user_to_id');
            $table->foreign('user_to_id')->references('id')->on('users')->onDelete('Cascade');

            $table->string('text');

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
        Schema::dropIfExists('messager');
    }
}
