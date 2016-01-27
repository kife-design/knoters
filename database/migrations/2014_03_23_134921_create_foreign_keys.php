<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration
{

    public function up()
    {

        Schema::table('projects', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('status')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('assets', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('traffic', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')
                ->onDelete('no action')
                ->onUpdate('no action');
        });

        Schema::table('replies', function (Blueprint $table) {
            $table->foreign('note_id')->references('id')->on('notes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('note_parameters', function (Blueprint $table) {
            $table->foreign('note_id')->references('id')->on('notes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('projects_status_id_foreign');
        });
        Schema::table('assets', function (Blueprint $table) {
            $table->dropForeign('assets_project_id_foreign');
        });
        Schema::table('traffic', function (Blueprint $table) {
            $table->dropForeign('traffic_project_id_foreign');
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign('notes_project_id_foreign');
        });

        Schema::table('replies', function (Blueprint $table) {
            $table->dropForeign('replies_note_id_foreign');
        });

        Schema::table('note_parameters', function (Blueprint $table) {
            $table->dropForeign('note_parameters_note_id_foreign');
        });
    }
}
