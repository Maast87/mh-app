<?php

namespace Database\Seeders;

use App\Models\AchievementType;
use Illuminate\Database\Seeder;

class AchievementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AchievementType::create([
            'name' => 'Login Achievement',
            'slug' => 'login',
            'description' => 'Achievements earned by logging into the application',
        ]);
    }
}
