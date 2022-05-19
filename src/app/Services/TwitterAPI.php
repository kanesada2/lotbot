<?php

namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\Account;
use App\Models\Log;
use App\Models\Parameter;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class TwitterAPI {
    const TWITTER_SEARCH_MAX_RESULTS = 100;
    const TWITTER_SEARCH_EXCLUDE_TARGET_RETWEETS = 'retweets';

    protected string $consumerKey;
    protected string $consumerSecret;
    protected ?Account $bot = null;
    protected ?Account $target = null;
    protected $result;
    protected TwitterOAuth $connection;

    public function __construct()
    {
        $this->consumerKey = Parameter::consumerKey();
        $this->consumerSecret = Parameter::consumerSecret();
    }

    public function authenticate(Account $account)
    {
        $this->bot = $account;
        $this->initConnection($account->access_token, $account->access_secret);
    }

    public function aimTo(Account $target)
    {
        $this->target = $target;
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

    public function screenName2Id(string $screenName): string
    {
        $this->connection->setApiVersion(2);
        $this->result = $this->connection->get("users/by/username/$screenName");
        if(!property_exists($this->result, 'data')){
            return [];
        }
        return $this->result->data->id;
    }

    public function listUserTweet(string $startTime): array
    {
        $this->connection->setApiVersion(2);
        $twitterId = $this->target->twitter_id;
        $this->result = $this->connection->get("users/$twitterId/tweets", [
            "start_time" => $startTime, 
            "max_results" => static::TWITTER_SEARCH_MAX_RESULTS,
            "exclude" => static::TWITTER_SEARCH_EXCLUDE_TARGET_RETWEETS,
        ]);
        $this->handleAPIError("ユーザーのツイート取得に失敗しました:\n");
        if(!property_exists($this->result, 'data')){
            return [];
        }
        return $this->result->data;
    }

    public function retweet(string $tweetId)
    {
        $this->result = $this->connection->post("statuses/retweet/$tweetId");
        $this->handleAPIError("ツイートID:${tweetId}のRTに失敗しました:\n");
    }

    public function like(string $tweetId)
    {
        $this->result = $this->connection->post("favorites/create", ['id' => $tweetId]);
        $this->handleAPIError("ツイートID:${tweetId}のいいねに失敗しました:\n");
    }
    
    protected function handleAPIError($message = "")
    {
        if($this->connection->getLastHttpCode() != Response::HTTP_OK){
            if(!$this->result) return;
            if(!$this->result->errors) return;
            Log::create([
                'bot_id' => $this->bot->id,
                'target_id' => $this->target->id,
                'code' => $this->result->errors[0]->code,
                'message' => $message . implode("\n", Arr::pluck($this->result->errors, 'message')),
            ]);
        }
    }

}