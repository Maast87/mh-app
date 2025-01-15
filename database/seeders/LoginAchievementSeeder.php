<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\AchievementType;
use Illuminate\Database\Seeder;

class LoginAchievementSeeder extends Seeder
{
    public function run()
    {
        $type = AchievementType::firstOrCreate(
            ['slug' => 'log-in-achievements'],
            [
                'name' => 'Log in achievements',
                'description' => 'Log in to your account'
            ]
        );

        Achievement::updateOrCreate(
            [
                'achievement_type_id' => $type->id,
                'tier_name' => 'Level 1'
            ],
            [
                'name' => 'Regular Visitor',
                'description' => 'Log in 3 times',
                'required_points' => 3,
                'icon_path' => 'images/achievements/mental-hygiene-achievement-log-in-achievements-level-1.png',
            ]
        );

        Achievement::updateOrCreate(
            [
                'achievement_type_id' => $type->id,
                'tier_name' => 'Level 2'
            ],
            [
                'name' => 'Active Member',
                'description' => 'Log in 25 times',
                'required_points' => 25,
                'icon_path' => 'images/achievements/mental-hygiene-achievement-log-in-achievements-level-2.png',
            ]
        );

        Achievement::updateOrCreate(
            [
                'achievement_type_id' => $type->id,
                'tier_name' => 'Level 3'
            ],
            [
                'name' => 'Dedicated Member',
                'description' => 'Log in 100 times',
                'required_points' => 100,
                'icon_path' => 'images/achievements/mental-hygiene-achievement-log-in-achievements-level-3.png',
            ]
        );
    }
} 