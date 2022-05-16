<?php

namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\Account;
use App\Models\Parameter;

class TwitterAPI {
    protected string $consumerKey;
    protected string $consumerSecret;
    protected TwitterOAuth $connection;

    public function __construct()
    {
        $this->consumerKey = Parameter::consumerKey();
        $this->consumerSecret = Parameter::consumerSecret();
    }

    public function initConnection(?string $accessToken = null, ?string $accessSecret = null)
    {
        $this->connection = new TwitterOAuth($this->consumerKey, $this->consumerSecret, $accessToken, $accessSecret);
    }

    public function getAuthenticateUrl():string
    {
        $callBackUrl = url(config('twitter.callback_url'));
        $oauthToken = $this->connection->oauth('oauth/request_token', ['oauth_callback' => $callBackUrl]);
        Session::twitterOauthToken($oauthToken['oauth_token']);
        Session::twitterOauthSecret($oauthToken['oauth_token_secret']);
        return $this->connection->url('oauth/authenticate', [
            'oauth_token' => Session::twitterOauthToken(), 
            'oauth_token_secret' => Session:: twitterOauthSecret()
        ]);
    }

    public function getAccessToken(string $verifier):array
    {
        return $this->connection->oauth('oauth/access_token', ['oauth_verifier' => $verifier]);
    }
}