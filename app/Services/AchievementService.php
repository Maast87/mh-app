<?php

namespace App\Services;

use App\Events\AchievementUnlocked;
use App\Models\Achievement;
use App\Models\AchievementProgress;
use App\Models\AchievementType;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AchievementService
{
    /**
     * Get all achievement types with their achievements and progress for a user.
     */
    public function getUserAchievements(User $user)
    {
        $types = AchievementType::with(['achievements', 'progress' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->get();

        return $types->map(function ($type) use ($user) {
            return [
                'id' => $type->id,
                'name' => $type->name,
                'description' => $type->description,
                'progress' => [
                    'points' => $type->progress->first()?->points ?? 0,
                    'last_action_at' => $type->progress->first()?->last_action_at,
                ],
                'achievements' => $type->achievements->map(function ($achievement) use ($user) {
                    return [
                        'id' => $achievement->id,
                        'name' => $achievement->name,
                        'description' => $achievement->description,
                        'required_points' => $achievement->required_points,
                        'tier_name' => $achievement->tier_name,
                        'icon_path' => $achievement->icon_path,
                        'is_earned' => $achievement->isEarnedByUser($user),
                        'can_be_earned' => $achievement->canBeEarnedByUser($user),
                        'earned_at' => $user->achievements()
                            ->where('achievement_id', $achievement->id)
                            ->first()?->pivot->earned_at,
                    ];
                })->sortByDesc('required_points')->values(),
            ];
        });
    }

    /**
     * Try to award an achievement to a user.
     * Returns [success: bool, message: string]
     */
    public function tryAwardAchievement(User $user, int $achievementId): array
    {
        $achievement = Achievement::find($achievementId);

        if (!$achievement) {
            return ['success' => false, 'message' => 'Achievement not found.'];
        }

        // Check if already earned
        if ($achievement->isEarnedByUser($user)) {
            return ['success' => false, 'message' => 'Achievement already earned.'];
        }

        // Check if user has enough points
        if (!$achievement->canBeEarnedByUser($user)) {
            return ['success' => false, 'message' => 'Not enough points to earn this achievement.'];
        }

        // Award the achievement
        DB::transaction(function () use ($user, $achievement) {
            $user->achievements()->attach($achievement->id, [
                'earned_at' => now(),
            ]);

            event(new AchievementUnlocked($user, $achievement));
        });

        return ['success' => true, 'message' => 'Achievement unlocked!'];
    }

    /**
     * Increment achievement progress for a user.
     */
    public function incrementProgress(User $user, AchievementType $type, int $amount = 1): void
    {
        DB::transaction(function () use ($user, $type, $amount) {
            $progress = $user->getProgressForType($type);
            
            // Increment points
            $progress->points += $amount;
            $progress->last_action_at = now();
            $progress->save();

            // Check for newly earned achievements
            $newAchievements = Achievement::where('achievement_type_id', $type->id)
                ->where('required_points', '<=', $progress->points)
                ->whereDoesntHave('users', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->get();

            // Award achievements
            foreach ($newAchievements as $achievement) {
                $this->awardAchievement($user, $achievement);
            }
        });
    }

    /**
     * Award an achievement to a user and dispatch the corresponding event.
     */
    public function awardAchievement(User $user, Achievement $achievement): void
    {
        DB::transaction(function () use ($user, $achievement) {
            // Only award if not already earned
            if (!$user->achievements()->where('achievement_id', $achievement->id)->exists()) {
                $user->achievements()->attach($achievement->id, [
                    'earned_at' => now(),
                ]);

                event(new AchievementUnlocked($user, $achievement));
            }
        });
    }

    /**
     * Get the next available achievement for a user in a specific achievement type.
     */
    public function getNextAchievement(User $user, AchievementType $type): ?Achievement
    {
        $progress = $user->getProgressForType($type);
        
        return Achievement::where('achievement_type_id', $type->id)
            ->where('required_points', '>', $progress->points)
            ->orderBy('required_points')
            ->first();
    }

    /**
     * Get comprehensive achievement progress information for a user.
     */
    public function getProgress(User $user, AchievementType $type): array
    {
        $progress = $user->getProgressForType($type);
        $achievements = $type->achievements()->orderBy('required_points')->get();
        $nextAchievement = $this->getNextAchievement($user, $type);
        $highestEarned = $this->getHighestAchievement($user, $type);

        return [
            'current_progress' => [
                'points' => $progress->points,
                'last_action_at' => $progress->last_action_at,
            ],
            'next_achievement' => $nextAchievement ? [
                'name' => $nextAchievement->name,
                'points_needed' => $nextAchievement->required_points - $progress->points,
                'total_required' => $nextAchievement->required_points,
            ] : null,
            'highest_earned' => $highestEarned ? [
                'name' => $highestEarned->name,
                'tier_name' => $highestEarned->tier_name,
                'earned_at' => $user->achievements()
                    ->where('achievement_id', $highestEarned->id)
                    ->first()
                    ->pivot
                    ->earned_at,
            ] : null,
            'achievements' => $achievements->map(function ($achievement) use ($user) {
                return [
                    'id' => $achievement->id,
                    'name' => $achievement->name,
                    'description' => $achievement->description,
                    'required_points' => $achievement->required_points,
                    'tier_name' => $achievement->tier_name,
                    'icon_path' => $achievement->icon_path,
                    'earned' => $achievement->isEarnedByUser($user),
                    'can_be_earned' => $achievement->canBeEarnedByUser($user),
                ];
            }),
        ];
    }

    /**
     * Check if a user has earned any achievements of a specific type.
     */
    public function hasEarnedAnyAchievements(User $user, AchievementType $type): bool
    {
        return $user->achievements()
            ->where('achievement_type_id', $type->id)
            ->exists();
    }

    /**
     * Get the highest tier achievement earned by a user for a specific type.
     */
    public function getHighestAchievement(User $user, AchievementType $type): ?Achievement
    {
        return $user->achievements()
            ->where('achievement_type_id', $type->id)
            ->orderByDesc('required_points')
            ->first();
    }

    /**
     * Calculate how many points are needed for the next achievement.
     */
    public function pointsNeededForNext(User $user, AchievementType $type): ?int
    {
        $progress = $user->getProgressForType($type);
        $nextAchievement = $this->getNextAchievement($user, $type);

        if (!$nextAchievement) {
            return null; // No more achievements available
        }

        return $nextAchievement->required_points - $progress->points;
    }
} 