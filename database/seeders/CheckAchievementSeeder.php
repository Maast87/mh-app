<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\AchievementType;
use Illuminate\Database\Seeder;

class CheckAchievementSeeder extends Seeder
{
    public function run()
    {
        $type = AchievementType::firstOrCreate(
            ['slug' => 'zelfcheck-achievements'],
            [
                'name' => 'Zelfcheck achievements',
                'description' => 'Complete mental health check assessments'
            ]
        );

        Achievement::create([
            'achievement_type_id' => $type->id,
            'name' => 'Beginner Checker',
            'description' => 'Complete your first check',
            'required_points' => 1,
            'tier_name' => 'Level 1',
            'icon_path' => 'images/achievements/mental-hygiene-achievement-zelfcheck-achievements-level-1.png',
        ]);

        Achievement::create([
            'achievement_type_id' => $type->id,
            'name' => 'Regular Checker',
            'description' => 'Complete 5 checks',
            'required_points' => 5,
            'tier_name' => 'Level 2',
            'icon_path' => 'images/achievements/mental-hygiene-achievement-zelfcheck-achievements-level-2.png',
        ]);

        Achievement::create([
            'achievement_type_id' => $type->id,
            'name' => 'Dedicated Checker',
            'description' => 'Complete 15 checks',
            'required_points' => 15,
            'tier_name' => 'Level 3',
            'icon_path' => 'images/achievements/mental-hygiene-achievement-zelfcheck-achievements-level-3.png',
        ]);

        Achievement::create([
            'achievement_type_id' => $type->id,
            'name' => 'Expert Checker',
            'description' => 'Complete 50 checks',
            'required_points' => 50,
            'tier_name' => 'Level 4',
            'icon_path' => 'images/achievements/mental-hygiene-achievement-zelfcheck-achievements-level-4.png',
        ]);

        Achievement::create([
            'achievement_type_id' => $type->id,
            'name' => 'Master Checker',
            'description' => 'Complete 100 checks',
            'required_points' => 100,
            'tier_name' => 'Level 5',
            'icon_path' => 'images/achievements/mental-hygiene-achievement-zelfcheck-achievements-level-5.png',
        ]);
    }
} 