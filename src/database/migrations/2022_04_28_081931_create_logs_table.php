<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->integer('bot_id')->index()->comment('APIリクエスト時のBOTのアカウントID');
            $table->integer('target_id')->index()->comment('APIリクエスト時の対象アカウントID');
            $table->integer('code')->index()->comment('API実行結果のステータスコード');
            $table->string('message')->comment('APIのメッセージ');
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
        Schema::dropIfExists('logs');
    }
};
