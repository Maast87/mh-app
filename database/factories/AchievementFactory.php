<?php

namespace Database\Factories;

use App\Models\AchievementType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achievement>
 */
class AchievementFactory extends Factory
{
    private static $tierCounter = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $typeId = AchievementType::factory()->create()->id;
        
        // Initialize counter for this type if not exists
        if (!isset(self::$tierCounter[$typeId])) {
            self::$tierCounter[$typeId] = 0;
        }

        // Cycle through tiers
        $tiers = ['Bronze', 'Silver', 'Gold'];
        $tier = $tiers[self::$tierCounter[$typeId] % count($tiers)];
        self::$tierCounter[$typeId]++;

        return [
            'achievement_type_id' => $typeId,
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'required_points' => fake()->numberBetween(1, 100),
            'tier_name' => $tier,
            'icon_path' => null,
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure()
    {
        return $this->afterCreating(function () {
            // Reset tier counter after each creation to prevent memory leaks
            self::$tierCounter = [];
        });
    }
} 