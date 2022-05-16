<?php

namespace App\Services;

class Session {

    const SESSION_KEY_TWITTER_OAUTH_TOKEN = 'twitter_oauth_token';
    const SESSION_KEY_TWITTER_OAUTH_SECRET = 'twitter_oauth_secret';

    protected static function handle(string $key, string $value = null): string
    {
        if($value) {
            session()->put($key, $value);
        }

        return session()->get($key);
    }

    public static function twitterOauthToken(string $token = null): string
    {
        return static::handle(static::SESSION_KEY_TWITTER_OAUTH_TOKEN, $token);
    }

    public static function twitterOauthSecret(string $secret = null): string
    {
        return static::handle(static::SESSION_KEY_TWITTER_OAUTH_SECRET, $secret);
    }
}