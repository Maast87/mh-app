<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TopicSeeder::class);
        $topics = Topic::all();

        $users = User::factory(10)->create();

        $posts = Post::factory(200)
            ->withFixture()
            ->has(Comment::factory(15)->recycle($users))
            ->recycle([$users, $topics])
            ->create();

        $comments = Comment::factory(100)->recycle($users)->recycle($posts)->create();

        $luke = User::factory()
            ->has(Post::factory(45)->recycle($topics)->withFixture())
            ->has(Comment::factory(120)->recycle($posts))
            ->create([
                'name' => 'Luke Test',
                'email' => 'test@example.com',
        ]);
    }
}
