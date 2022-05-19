<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Parameter;
use App\Services\TwitterAPI;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Continue_;

class LotTweetsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lot-tweets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '設定から対象となるツイート群を取得し、各ツイートを抽選していいね/RTを行います';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $twitter = new TwitterAPI();
        $durationMinutes = Parameter::durationMinutes();
        $executeTime = Carbon::now()->
            subMinutes($durationMinutes)
            ->toIso8601String();

        $bots = Account::listBots();
        $botScreenNames = implode(", ", $bots->pluck('screen_name')->toArray()); 
        echo "BOTアカウント: $botScreenNames\n";

        $targets = Account::listTargets();
        $targetScreenNames = implode(", ", $targets->pluck('screen_name')->toArray());
        echo "対象アカウント: $targetScreenNames\n";

        /** @var Account $firstBot */
        $firstBot = $bots->first();
        $twitter->authenticate($firstBot);

        $tweetIds = [];
        $targetDic = [];
        echo "抽選対象期間開始日時: $executeTime\n";
        foreach($targets as $target){
            /** @var Account $target */
            $twitter->aimTo($target);
            $tweets = $twitter->listUserTweet($executeTime);
            if(!$tweets) continue;
            $tweetIds = array_merge($tweetIds, Arr::pluck($tweets, 'id'));
            foreach($tweetIds as $tweetId){
                $targetDic[$tweetId] = $target;
            }
        }
        echo "対象のツイート: " . count($tweetIds) . "件\n";
        $retweetRate = 50.01;//Parameter::retweetRate();
        $likeRate = 50.05;//Parameter::likeRate();
        echo "リツイート確率: $retweetRate%\n";
        echo "いいね確率: $likeRate%\n";

        $rtCount = 0;
        $likeCount = 0;

        foreach($bots as $bot){
            /** @var Account $bot */
            $twitter->authenticate($bot);
            foreach($tweetIds as $tweetId){
                $random = mt_rand() / mt_getrandmax() * 100;
                if($random <= $retweetRate){
                    $twitter->aimTo($targetDic[$tweetId]);
                    $twitter->retweet($tweetId);
                    $rtCount++;
                }
                $random = mt_rand() / mt_getrandmax() * 100;
                if($random <= $likeRate){
                    $twitter->aimTo($targetDic[$tweetId]);
                    $twitter->like($tweetId);
                    $likeCount++;
                }
            }
        }

        echo "実行結果: ${rtCount}件のツイートをRT、${likeCount}件のツイートをいいねしました\n";

        return 0;
    }
}