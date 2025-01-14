<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Models\AchievementType;
use App\Models\AchievementProgress;
use App\Services\AchievementService;
use Illuminate\Support\Facades\Log;

class TrackLoginAchievement
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
    public function handle(UserLoggedIn $event): void
    {
        $user = $event->user;
        \Log::info('TrackLoginAchievement: Processing login for user', [
            'user_id' => $user->id,
            'tag_name' => $user->tag_name
        ]);

        $achievementType = AchievementType::firstOrCreate(
            ['slug' => 'log-in-achievements'],
            [
                'name' => 'Log in achievements',
                'description' => 'Log in to your account'
            ]
        );

        \Log::info('TrackLoginAchievement: Found achievement type', [
            'type_id' => $achievementType->id,
            'type_slug' => $achievementType->slug
        ]);

        $result = $this->achievementService->incrementProgress($user, $achievementType);
        
        \Log::info('TrackLoginAchievement: Progress incremented', [
            'new_points' => $result['points'],
            'achievements_earned' => $result['achievements_earned'] ?? []
        ]);
    }
}
