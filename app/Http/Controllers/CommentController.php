<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $data = $request->validate(['body' => ['required', 'string', 'max:2500']]);

        Comment::make($data)
            ->user()->associate($request->user())
            ->post()->associate($post)
            ->save();

        return redirect($post->showRoute());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('delete', $comment);

        $data = $request->validate(['body' => ['required', 'string', 'max:2500']]);

        $comment->update($data);

        return redirect($comment->post->showRoute(['page' => $request->query('page')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Comment $comment)
    {
        Gate::authorize('delete', $comment);

        $comment->delete();

        return redirect($comment->post->showRoute(['page' => $request->query('page')]));
    }
}
