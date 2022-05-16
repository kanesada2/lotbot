<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    const ACCOUNT_TYPE_BOT = 'bot';
    const ACCOUNT_TYPE_TARGET = 'target';
    use HasFactory;

    protected $guarded = ['id'];

    public static function findByTwitterId(string $twitterId): ?static
    {
        return static::where('twitter_id', $twitterId)->first();
    }
}
