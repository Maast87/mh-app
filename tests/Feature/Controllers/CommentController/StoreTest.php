<?php

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

it('requires an authenticated user', function () {
    post(route('posts.comments.store', Post::factory()->create()))
        ->assertRedirect(route('login'));
});

it('can store a comment', function () {
   $user = User::factory()->create();
   $post = Post::factory()->create();

   actingAs($user)->post(route('posts.comments.store', $post), [
        'body' => 'test comment',
   ]);

   $this->assertDatabaseHas(Comment::class, [
      'body' => 'test comment',
      'post_id' => $post->id,
      'user_id' => $user->id,
   ]);
});

it('redirects to the post show page', function () {
    $post = Post::factory()->create();

    actingAs(User::factory()->create())
        ->post(route('posts.comments.store', $post), [
        'body' => 'test comment',
        ])
        ->assertRedirect(route('posts.show', $post));
});

it('it requires a valid body', function ($value) {
    $post = Post::factory()->create();

    actingAs(User::factory()->create())
        ->post(route('posts.comments.store', $post), [
        'body' => $value,
        ])
        ->assertInvalid('body');
})->with([
    null,
    1,
    1.5,
    true,
    str_repeat('a', 2501),
]);


