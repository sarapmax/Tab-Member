<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tab_members', function (Blueprint $table) {
            $table->increments('id');

            $table->string('no');
            $table->string('old_no')->nullable();
            $table->integer('name_prefix_id')->unsigned();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('gender');
            $table->date('birthday');
            $table->string('nationality');
            $table->string('race');
            $table->string('religion');
            $table->string('idcard');
            $table->string('home_number');
            $table->string('moo');
            $table->string('village')->nullable();
            $table->string('soi')->nullable();
            $table->string('road')->nullable();
            $table->integer('sub_district_id')->unsigned();
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->string('type');
            $table->string('period_type');
            $table->string('blind_name')->nullable();
            $table->string('blind_no');
            $table->string('blind_level');
            $table->text('blind_cause');
            $table->string('education_lavel');
            $table->string('education_name');
            $table->string('status');
            $table->string('career');
            $table->string('training');
            $table->string('salary');
            $table->string('guarantor_type');
            $table->string('guarantor_name');
            $table->string('remark')->nullable();
            $table->string('profile_img')->nullable();
            $table->boolean('dead')->nullable();
            $table->date('dead_date')->nullable();
            $table->string('dead_no')->nullable();

            $table->timestamps();

            $table->foreign('name_prefix_id')->references('id')->on('name_prefixes');
            // $table->foreign('sub_district_id')->references('id')->on('sub_districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tab_members');
    }
}
