<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Services\TwitterAPI;
use Illuminate\Console\Command;

class LotTweetsCommand extends Command
{
    // TODO: 返ってきた件数が100以上ならもう一回問い合わせる
    const TWITTER_SEARCH_MAX_RESULTS = "100";

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

        $bots = Account::listBots();
        $botScreenNames = implode(", ", $bots->pluck('screen_name')->toArray()); 
        echo "BOTアカウント: $botScreenNames\n";

        $targets = Account::listTargets();
        $targetScreenNAmes = implode(", ", $targets->pluck('screen_name')->toArray());
        echo "対象アカウント: $botScreenNames\n";

        /** @var Account $firstBot */
        $firstBot = $bots->first();
        $twitter->authenticate($firstBot);

        return 0;
    }
}