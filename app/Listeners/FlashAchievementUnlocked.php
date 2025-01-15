<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Http\Resources\AchievementUnlockedResource;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FlashAchievementUnlocked
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AchievementUnlocked  $event
     * @return void
     */
    public function handle(AchievementUnlocked $event): void
    {
        \Log::info('FlashAchievementUnlocked: Processing achievement unlock', [
            'user_id' => $event->user->id,
            'achievement_id' => $event->achievement->id,
            'achievement_name' => $event->achievement->name
        ]);

        session()->flash('achievement_unlocked', 
            (new AchievementUnlockedResource($event->achievement))->resolve());

        \Log::info('FlashAchievementUnlocked: Achievement data flashed to session');
    }
} 