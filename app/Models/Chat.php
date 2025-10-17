<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    protected $fillable = ['recruiter_id', 'developer_id', 'is_closed'];

    protected $casts = [
        'is_closed' => 'boolean',
    ];

    public function recruiter(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function developer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    public function unreadCount(int $userId): int
    {
        return $this->messages()
            ->where('receiver_id', $userId)
            ->where('is_seen', false)
            ->count();
    }
}
