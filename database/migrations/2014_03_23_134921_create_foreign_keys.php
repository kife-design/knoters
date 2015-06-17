<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration
{

    public function up()
    {

        Schema::table('uploads', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('status')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('upload_emails', function (Blueprint $table) {
            $table->foreign('upload_id')->references('id')->on('uploads')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('assets', function (Blueprint $table) {
            $table->foreign('upload_id')->references('id')->on('uploads')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('traffic', function (Blueprint $table) {
            $table->foreign('upload_id')->references('id')->on('uploads')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('traffic', function (Blueprint $table) {
            $table->foreign('from_id')->references('id')->on('emails')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
        Schema::table('traffic', function (Blueprint $table) {
            $table->foreign('to_id')->references('id')->on('emails')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
        Schema::table('notes', function (Blueprint $table) {
            $table->foreign('upload_id')->references('id')->on('uploads')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
        Schema::table('notes', function (Blueprint $table) {
            $table->foreign('asset_id')->references('id')->on('assets')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('notes', function (Blueprint $table) {
            $table->foreign('from_id')->references('id')->on('emails')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
        Schema::table('replies', function (Blueprint $table) {
            $table->foreign('note_id')->references('id')->on('notes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('replies', function (Blueprint $table) {
            $table->foreign('from_id')->references('id')->on('emails')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('asset_parameters', function (Blueprint $table) {
            $table->foreign('asset_id')->references('id')->on('assets')
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
        Schema::table('uploads', function (Blueprint $table) {
            $table->dropForeign('uploads_status_id_foreign');
        });
        Schema::table('upload_emails', function (Blueprint $table) {
            $table->dropForeign('upload_emails_upload_id_foreign');
        });
        Schema::table('assets', function (Blueprint $table) {
            $table->dropForeign('assets_upload_id_foreign');
        });
        Schema::table('traffic', function (Blueprint $table) {
            $table->dropForeign('traffic_upload_id_foreign');
        });
        Schema::table('traffic', function (Blueprint $table) {
            $table->dropForeign('traffic_from_id_foreign');
        });
        Schema::table('traffic', function (Blueprint $table) {
            $table->dropForeign('traffic_to_id_foreign');
        });
        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign('notes_upload_id_foreign');
        });
        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign('notes_asset_id_foreign');
        });
        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign('notes_from_id_foreign');
        });
        Schema::table('replies', function (Blueprint $table) {
            $table->dropForeign('replies_note_id_foreign');
        });
        Schema::table('replies', function (Blueprint $table) {
            $table->dropForeign('replies_from_id_foreign');
        });
        Schema::table('asset_parameters', function (Blueprint $table) {
            $table->dropForeign('asset_parameters_asset_id_foreign');
        });
        Schema::table('note_parameters', function (Blueprint $table) {
            $table->dropForeign('note_parameters_note_id_foreign');
        });
    }
}