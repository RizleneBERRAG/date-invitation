<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DateResponse extends Model
{
    protected $fillable = [
        'invitation_id',
        'activity',
        'selected_date',
        'selected_time',
        'food_preference',
        'outfit_style',
        'music_choice',
        'romance_level',
        'personal_message',
        'confirmed_at',
    ];

    protected function casts(): array
    {
        return [
            'selected_date' => 'date',
            'confirmed_at' => 'datetime',
        ];
    }

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }
}
