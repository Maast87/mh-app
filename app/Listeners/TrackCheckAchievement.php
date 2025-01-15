<?php

namespace App\Listeners;

use App\Events\CheckCompleted;
use App\Models\AchievementType;
use App\Services\AchievementService;
use Illuminate\Support\Facades\Log;

class TrackCheckAchievement
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private AchievementService $achievementService
    ) {}

    /**
     * Handle the event.
     */
    public function handle(CheckCompleted $event): void
    {
        $user = $event->user;
        \Log::info('TrackCheckAchievement: Processing check completion for user', [
            'user_id' => $user->id,
            'tag_name' => $user->tag_name
        ]);

        $achievementType = AchievementType::firstOrCreate(
            ['slug' => 'zelfcheck-achievements'],
            [
                'name' => 'Zelfcheck achievements',
                'description' => 'Complete mental health check assessments'
            ]
        );

        \Log::info('TrackCheckAchievement: Found achievement type', [
            'type_id' => $achievementType->id,
            'type_slug' => $achievementType->slug
        ]);

        $result = $this->achievementService->incrementProgress($user, $achievementType);
        
        \Log::info('TrackCheckAchievement: Progress incremented', [
            'new_points' => $result['points'],
            'achievements_earned' => $result['achievements_earned'] ?? []
        ]);
    }
} 