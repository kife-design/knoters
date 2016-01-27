<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_user', function (Blueprint $table) {
            $table->integer('project_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('is_host');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('project_user', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('project_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('traffic', function (Blueprint $table) {
            $table->foreign('from_id')->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
        Schema::table('traffic', function (Blueprint $table) {
            $table->foreign('to_id')->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
        Schema::table('notes', function (Blueprint $table) {
            $table->foreign('from_id')->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
        Schema::table('replies', function (Blueprint $table) {
            $table->foreign('from_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_user', function (Blueprint $table) {
            $table->dropForeign('project_user_project_id_foreign');
        });

        Schema::table('project_user', function (Blueprint $table) {
            $table->dropForeign('project_user_user_id_foreign');
        });

        Schema::table('traffic', function (Blueprint $table) {
            $table->dropForeign('traffic_from_id_foreign');
        });
        Schema::table('traffic', function (Blueprint $table) {
            $table->dropForeign('traffic_to_id_foreign');
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign('notes_from_id_foreign');
        });

        Schema::table('replies', function (Blueprint $table) {
            $table->dropForeign('replies_from_id_foreign');
        });

        Schema::drop('project_user');
    }
}
