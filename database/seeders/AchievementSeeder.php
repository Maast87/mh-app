<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\AchievementType;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loginType = AchievementType::where('slug', 'login')->firstOrFail();

        // Rookie Logger - 3 logins
        Achievement::create([
            'achievement_type_id' => $loginType->id,
            'name' => 'Rookie Logger',
            'description' => 'You have logged in 3 times! Keep going!',
            'required_points' => 3,
            'tier_name' => 'rookie',
            'icon_path' => 'icons/achievements/login-rookie.svg',
        ]);

        // Elite Logger - 25 logins
        Achievement::create([
            'achievement_type_id' => $loginType->id,
            'name' => 'Elite Logger',
            'description' => 'You have logged in 25 times! You\'re becoming a regular!',
            'required_points' => 25,
            'tier_name' => 'elite',
            'icon_path' => 'icons/achievements/login-elite.svg',
        ]);

        // Legendary Logger - 100 logins
        Achievement::create([
            'achievement_type_id' => $loginType->id,
            'name' => 'Legendary Logger',
            'description' => 'You have logged in 100 times! You\'re a true community pillar!',
            'required_points' => 100,
            'tier_name' => 'legendary',
            'icon_path' => 'icons/achievements/login-legendary.svg',
        ]);
    }
}
