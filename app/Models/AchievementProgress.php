<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AchievementProgress extends Model
{
    use HasFactory;

    protected $table = 'achievement_progress';

    protected $fillable = [
        'user_id',
        'achievement_type_id',
        'points',
        'last_action_at',
    ];

    protected $casts = [
        'last_action_at' => 'datetime',
    ];

    /**
     * Get the user this progress belongs to.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the achievement type this progress is for.
     */
    public function achievementType(): BelongsTo
    {
        return $this->belongsTo(AchievementType::class);
    }
}
