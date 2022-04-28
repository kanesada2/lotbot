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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['bot', 'target'])->index()->comment('アカウントの種別');
            $table->string('twitter_id')->unique()->comment('twitterのアカウントID');
            $table->string('screen_name')->comment('twitterの表示名');
            $table->string('access_token')->comment('twitterのアクセストークン');
            $table->string('access_secret')->comment('twitterのアクセストークンシークレット');
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
        Schema::dropIfExists('accounts');
    }
};
