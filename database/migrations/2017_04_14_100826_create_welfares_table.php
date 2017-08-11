<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWelfaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welfares', function (Blueprint $table) {
            $table->increments('id');

            $table->string('tab_member_no');
            $table->integer('user_id')->unsigned();
            $table->string('withdraw_firstname');
            $table->string('withdraw_lastname');
            $table->string('withdraw_phone_number');
            $table->string('type');
            $table->integer('amount');
            $table->text('comment')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('welfares');
    }
}
