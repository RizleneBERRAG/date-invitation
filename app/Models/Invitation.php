<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invitation extends Model
{
    protected $fillable = [
        'token',
        'recipient_name',
        'sender_name',
        'title',
        'intro_message',
        'available_dates',
        'available_times',
        'suggested_places',
        'is_active',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'available_dates' => 'array',
            'available_times' => 'array',
            'suggested_places' => 'array',
            'is_active' => 'boolean',
            'expires_at' => 'datetime',
        ];
    }

    public function response(): HasOne
    {
        return $this->hasOne(DateResponse::class);
    }
}
