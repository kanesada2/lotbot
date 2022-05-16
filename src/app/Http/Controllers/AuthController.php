<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Services\Session;
use App\Services\TwitterAPI;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller {

    public function login()
    {
        $twitter = new TwitterAPI();
        $twitter->initConnection();
        $url = $twitter->getAuthenticateUrl();
        
        return redirect($url);
    }

    public function callback(Request $request)
    {
        if(!$request->oauth_verifier)
        {
            abort(Response::HTTP_BAD_REQUEST, '不正なリクエスト');
        }
        $oauthToken = Session::twitterOauthToken();
        $oauthSecret = Session::twitterOauthSecret();

        $twitter = new TwitterAPI();
        $twitter->initConnection($oauthToken, $oauthSecret);
        $result = $twitter->getAccessToken($request->oauth_verifier);
        $exist = Account::findByTwitterId($result['user_id']);
        if($exist){
            abort(Response::HTTP_BAD_REQUEST, '既に連携されたアカウントです');
        }
        $account = Account::create([
            'type' => Account::ACCOUNT_TYPE_BOT,
            'screen_name' => $result['screen_name'],
            'twitter_id' => $result['user_id'],
            'access_token' => $result['oauth_token'],
            'access_secret' => $result['oauth_token_secret'],
        ]);

        return view('auth.complete', [
            'account' => $account,
        ]);
    }
}