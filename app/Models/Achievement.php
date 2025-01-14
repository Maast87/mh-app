<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'achievement_type_id',
        'name',
        'description',
        'required_points',
        'tier_name',
        'icon_path',
    ];

    /**
     * Get the achievement type this achievement belongs to.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(AchievementType::class, 'achievement_type_id');
    }

    /**
     * Get the users who have earned this achievement.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_achievements')
            ->withPivot('earned_at')
            ->withTimestamps();
    }

    /**
     * Check if a user has earned this achievement.
     */
    public function isEarnedByUser(User $user): bool
    {
        return $this->users()->where('user_id', $user->id)->exists();
    }

    /**
     * Check if a user has enough points to earn this achievement.
     */
    public function canBeEarnedByUser(User $user): bool
    {
        $progress = $this->type->progressForUser($user);
        return $progress && $progress->points >= $this->required_points;
    }
}
