<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Models\AchievementType;
use App\Services\AchievementService;

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
        // Get the login achievement type
        $loginType = AchievementType::where('slug', 'login')->first();
        
        if (!$loginType) {
            return; // Skip if login achievement type doesn't exist
        }

        // Increment progress using the service
        $this->achievementService->incrementProgress($event->user, $loginType);
    }
}
