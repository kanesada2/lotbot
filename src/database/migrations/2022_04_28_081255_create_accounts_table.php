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
            $table->string('twitter_id')->comment('twitterのアカウントID');
            $table->string('screen_name')->comment('twitterの表示名');
            $table->string('access_token')->nullable()->comment('twitterのアクセストークン');
            $table->string('access_secret')->nullable()->comment('twitterのアクセストークンシークレット');
            $table->unique(['type', 'twitter_id'], 'unique_accounts_type_twitter_id');
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
