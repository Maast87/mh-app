<?php

use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Comment;
use Inertia\Testing\AssertableInertia;
use function Pest\Laravel\get;

it('can show a post', function () {
    $post = Post::factory()->create();

    get($post->showRoute())
        ->assertComponent('Posts/Show');
});

it('passes a post to the view', function () {
    $post = Post::factory()->create();

    $post->load('user', 'topic');

    get($post->showRoute())
        ->assertHasResource('post', PostResource::make($post)->withLikePermission());
});

it('passes comments to the view', function () {
    $post = Post::factory()->create();
    $comments = Comment::factory(2)->for($post)->create();

    $comments->load('user');

    $expected = CommentResource::collection($comments->reverse());
    $expected->collection->transform(fn (CommentResource $resource) => $resource->withLikePermission());

    get($post->showRoute())
        ->assertHasPaginatedResource('comments', $expected);
});

it('will redirect if the slug is incorrect', function (string $incorrectSlug) {
    $post = Post::factory()->create(['title' => 'Hello World']);

    get(route('posts.show', [$post, $incorrectSlug, 'page' => 2]))
        ->assertRedirect($post->showRoute(['page' => 2]));
})->with([
    'foo-bar',
    'hello'
]);
