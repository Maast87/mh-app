<?php

namespace App\Events;

use App\Models\Achievement;
use App\Models\User;
use App\Http\Resources\AchievementUnlockedResource;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AchievementUnlocked
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public User $user,
        public Achievement $achievement
    ) {}

    /**
     * Get the achievement data.
     *
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return [
            'achievement' => (new AchievementUnlockedResource($this->achievement))->resolve(),
        ];
    }
}
