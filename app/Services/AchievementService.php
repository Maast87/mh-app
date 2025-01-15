<?php

namespace App\Services;

use App\Events\AchievementUnlocked;
use App\Models\Achievement;
use App\Models\AchievementProgress;
use App\Models\AchievementType;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\AchievementTypeResource;
use App\Http\Resources\AchievementUnlockedResource;

class AchievementService
{
    /**
     * Get all achievement types with their achievements and progress for a user.
     */
    public function getUserAchievements(User $user)
    {
        $types = AchievementType::with([
            'achievements' => function ($query) {
                $query->orderBy('required_points', 'asc');
            },
            'progress' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            },
            'achievements.users' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }
        ])->get();

        // Add can_be_earned attribute to achievements
        $types->each(function ($type) {
            $points = $type->progress->first()?->points ?? 0;
            $type->achievements->each(function ($achievement) use ($points) {
                $achievement->can_be_earned = !$achievement->users->isNotEmpty() && 
                    $points >= $achievement->required_points;
            });
        });

        return AchievementTypeResource::collection($types);
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
    public function incrementProgress(User $user, AchievementType $type): array
    {
        \Log::info('AchievementService: Starting progress increment', [
            'user_id' => $user->id,
            'type_id' => $type->id,
            'type_slug' => $type->slug
        ]);

        $progress = AchievementProgress::firstOrCreate(
            [
                'user_id' => $user->id,
                'achievement_type_id' => $type->id,
            ],
            ['points' => 0]
        );

        $progress->increment('points');
        $progress->last_action_at = now();
        $progress->save();

        \Log::info('AchievementService: Progress updated', [
            'new_points' => $progress->points,
            'last_action' => $progress->last_action_at
        ]);

        // Check for newly earned achievements
        $achievements = $this->checkForNewAchievements($user, $type);
        
        \Log::info('AchievementService: Checked for new achievements', [
            'achievements_found' => count($achievements)
        ]);

        return [
            'points' => $progress->points,
            'achievements_earned' => $achievements
        ];
    }

    private function checkForNewAchievements(User $user, AchievementType $type): array
    {
        \Log::info('AchievementService: Checking for new achievements', [
            'user_id' => $user->id,
            'type_id' => $type->id
        ]);

        $progress = $user->achievementProgress()->where('achievement_type_id', $type->id)->first();
        $earnedAchievements = [];
        
        \Log::info('AchievementService: Current progress', [
            'points' => $progress->points ?? 0
        ]);

        if (!$progress) {
            \Log::warning('AchievementService: No progress found for user');
            return [];
        }

        // First, get all achievements for this type
        $allAchievements = Achievement::where('achievement_type_id', $type->id)->get();
        \Log::info('AchievementService: All achievements for type', [
            'achievements' => $allAchievements->map(fn($a) => [
                'id' => $a->id,
                'name' => $a->name,
                'required_points' => $a->required_points,
            ])->toArray()
        ]);

        // Then, get user's earned achievements
        $userAchievements = $user->achievements()
            ->where('achievement_type_id', $type->id)
            ->get();
        \Log::info('AchievementService: Already earned achievements', [
            'earned' => $userAchievements->pluck('id')->toArray()
        ]);

        $achievements = Achievement::where('achievement_type_id', $type->id)
            ->where('required_points', '<=', $progress->points)
            ->whereDoesntHave('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        \Log::info('AchievementService: Found potential achievements', [
            'count' => $achievements->count(),
            'achievements' => $achievements->pluck('name', 'id')->toArray()
        ]);

        foreach ($achievements as $achievement) {
            $this->awardAchievement($user, $achievement);
            $earnedAchievements[] = $achievement;
        }

        return $earnedAchievements;
    }

    /**
     * Award an achievement to a user and dispatch the corresponding event.
     */
    public function awardAchievement(User $user, Achievement $achievement): void
    {
        \Log::info('AchievementService: Awarding achievement', [
            'user_id' => $user->id,
            'achievement_id' => $achievement->id,
            'achievement_name' => $achievement->name
        ]);

        $user->achievements()->attach($achievement->id, [
            'earned_at' => now(),
        ]);

        event(new AchievementUnlocked($user, $achievement));

        \Log::info('AchievementService: Achievement awarded and event dispatched');
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