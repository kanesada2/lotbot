<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bot(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'bot_id');
    }

    public function target(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'target_id');
    }
}
