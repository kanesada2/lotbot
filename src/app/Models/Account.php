<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    const ACCOUNT_TYPE_BOT = 'bot';
    const ACCOUNT_TYPE_TARGET = 'target';
    use HasFactory;

    protected $guarded = ['id'];

    public static function findBotByTwitterId(string $twitterId): ?static
    {
        return static::where('twitter_id', $twitterId)->where('type', static::ACCOUNT_TYPE_BOT)->first();
    }

    public static function listBots(): Collection
    {
        return static::where('type', static::ACCOUNT_TYPE_BOT)->get();
    }

    public static function listTargets(): Collection
    {
        return static::where('type', static::ACCOUNT_TYPE_TARGET)->get();
    }
}
