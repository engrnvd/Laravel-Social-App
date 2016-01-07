<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("user_id");
            $table->enum("who_can_see_my_skills",[
                'Everyone',
                'Only me',
                'Only those who are following me',
                'Only those I am following'
            ])->default('Everyone');
            $table->enum("who_can_see_who_i_am_following",[
                'Everyone',
                'Only me',
                'Only those who are following me',
                'Only those I am following'
            ])->default('Everyone');
            $table->timestamps();

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
        Schema::drop('settings');
    }
}
