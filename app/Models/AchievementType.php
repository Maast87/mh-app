<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AchievementType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Get all achievements of this type.
     */
    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }

    /**
     * Get all progress records for this achievement type.
     */
    public function progress(): HasMany
    {
        return $this->hasMany(AchievementProgress::class);
    }

    /**
     * Get the progress for a specific user.
     */
    public function progressForUser(User $user)
    {
        return $this->progress()->where('user_id', $user->id)->first();
    }

    /**
     * Find an achievement type by its name.
     */
    public static function findByName(string $name)
    {
        return static::where('name', $name)->first();
    }
}
