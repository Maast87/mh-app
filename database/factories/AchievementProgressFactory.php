<?php

namespace Database\Factories;

use App\Models\AchievementType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AchievementProgress>
 */
class AchievementProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'achievement_type_id' => AchievementType::factory(),
            'points' => fake()->numberBetween(0, 100),
            'last_action_at' => now(),
        ];
    }
} 