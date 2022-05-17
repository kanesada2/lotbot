<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;

    const KEY_CONSUMER_KEY = 'consumer_key';
    const KEY_CONSUMER_SECRET = 'consumer_secret';
    const KEY_CALL_BACK_URL = 'call_back_url';
    const KEY_RETWEET_RATE = 'retweet_rate';
    const KEY_LIKE_RAKE = 'like_rate';
    const KEY_DURATION_MINUTES = 'duration_minutes';

    /**
     * keyによって一件取得する
     * 
     * @param string $key
     * @return static
     */
    protected static function findByKey(string $key): static
    {
        return static::where('key', $key)->first();
    }

    /**
     * keyに対応するvalueを返す
     * 
     * @param string $key
     */
    protected static function extractValueByKey(string $key)
    {
        $model = static::findByKey($key);
        return $model->value;
    }

    /**
     * twitter用のconsumerKeyを取得する
     * 
     * @return string
     */
    public static function consumerKey(): string
    {
        return static::extractValueByKey(static::KEY_CONSUMER_KEY);
    }

    /**
     * twitter用のconsumerSecretを取得する
     * 
     * @return string
     */
    public static function consumerSecret(): string
    {
        return static::extractValueByKey(static::KEY_CONSUMER_SECRET);
    } 

}