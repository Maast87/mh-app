<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'slug' => 'general',
                'name' => 'General',
                'description' => 'Any and all things about films and movies',
            ],
            [
                'slug' => 'reviews',
                'name' => 'Reviews',
                'description' => 'Reviews about movies',
            ],
            [
                'slug' => 'questions',
                'name' => 'Questions',
                'description' => 'Did not quite understand that one plot point? There are no stupid questions',
            ],
            [
                'slug' => 'conspiracies',
                'name' => 'Conspiracies',
                'description' => 'Got a wild idea about how two films are connected?',
            ],
            [
                'slug' => 'fan-fic',
                'name' => 'Fan Fiction',
                'description' => 'Got a great idea for a sequel? Tell us about it and get the audience excited',
            ],
        ];

        Topic::upsert($data, ['slug']);
    }
}
