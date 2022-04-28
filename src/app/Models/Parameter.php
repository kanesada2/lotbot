<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;

    const KEY_TWITTER_CONSUMER_KEY = 'consumer_key';
    const KEY_TWITTER_CONSUMER_SECRET = 'consumer_secret';

    /**
     * keyによって一件取得する
     * 
     * @param string $key
     * @return static
     */
    public static function findByKey(string $key): static
    {
        return static::where('key', $key)->first();
    }

    /**
     * twitter用のconsumerKeyを取得する
     * 
     * @return static
     */
    public static function findConsumerKey(): static
    {
        return static::findByKey(static::KEY_TWITTER_CONSUMER_KEY);
    }

    /**
     * twitter用のconsumerSecretを取得する
     * 
     * @return static
     */
    public static function findConsumerSecret(): static
    {
        return static::findByKey(static::KEY_TWITTER_CONSUMER_SECRET);
    } 

}