<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\AchievementProgress;
use App\Models\AchievementType;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestAchievementProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loginType = AchievementType::where('slug', 'login')->firstOrFail();
        $rookieAchievement = Achievement::where('tier_name', 'rookie')->firstOrFail();
        $eliteAchievement = Achievement::where('tier_name', 'elite')->firstOrFail();

        // Get our test user
        $maarten = User::where('email', 'maarten@example.com')->firstOrFail();

        // Create progress with enough points for elite achievement
        AchievementProgress::create([
            'user_id' => $maarten->id,
            'achievement_type_id' => $loginType->id,
            'points' => 30, // More than rookie (3), more than elite (25), less than legendary (100)
            'last_action_at' => now(),
        ]);

        // Award the achievements they should have earned with this progress
        $maarten->achievements()->attach([
            $rookieAchievement->id => ['earned_at' => now()->subDays(5)],
            $eliteAchievement->id => ['earned_at' => now()->subDay()],
        ]);

        // Create some random progress for other users
        $users = User::where('email', '!=', 'maarten@example.com')
            ->inRandomOrder()
            ->take(5)
            ->get();

        foreach ($users as $user) {
            $points = rand(1, 35); // Random progress between 1 and 35 logins
            
            AchievementProgress::create([
                'user_id' => $user->id,
                'achievement_type_id' => $loginType->id,
                'points' => $points,
                'last_action_at' => now()->subDays(rand(0, 10)),
            ]);

            // Award rookie achievement if they have enough points
            if ($points >= 3) {
                $user->achievements()->attach(
                    $rookieAchievement->id,
                    ['earned_at' => now()->subDays(rand(1, 10))]
                );
            }

            // Award elite achievement if they have enough points
            if ($points >= 25) {
                $user->achievements()->attach(
                    $eliteAchievement->id,
                    ['earned_at' => now()->subDays(rand(0, 5))]
                );
            }
        }
    }
}
