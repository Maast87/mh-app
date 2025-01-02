<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PostController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Posts/Index', [
            'posts' => PostResource::collection(Post::with('user')->latest()->latest('id')->paginate()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post  $post)
    {
        Gate::authorize('create', $post);

        return inertia('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'min:10', 'max:120'],
            'body' => ['required', 'string', 'min:100', 'max:10000'],
        ]);

        $post = new Post($data);
        $post->user()->associate($request->user());
        $post->save();

        return redirect($post->showRoute());
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post, $slug)
    {
        $correctSlug = Str::slug($post->title);
        if ($slug !== $correctSlug) {
            return redirect()->route('posts.show', [
                'post' => $post->id,
                'slug' => $correctSlug,
            ], 301);
        }

        $post->load('user');

        return inertia('Posts/Show', [
            'post' => fn () => PostResource::make($post),
            'comments' => fn () => CommentResource::collection($post->comments()->with('user')->latest()->latest('id')->paginate(10)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
