<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Thread;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(StorePostRequest $request, Thread $thread)
    {
        $validated = $request->validated();

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $thread->posts()->create([
            'user_id'    => $request->user()->id,
            'body'       => $validated['body'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('threads.show', $thread->id)
            ->with('status', 'Комментарий добавлен!');
    }

    public function edit(Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403, 'Доступ запрещён.');

        return view('posts.edit', compact('post'));
    }

    public function update(StorePostRequest $request, Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $post->image_path = $request->file('image')->store('posts', 'public');
        }

        $post->body = $validated['body'];
        $post->save();

        return redirect()->route('threads.show', $post->thread_id)
            ->with('status', 'Комментарий обновлён!');
    }

    public function destroy(Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403);

        $threadId = $post->thread_id;
        $post->delete();

        return redirect()->route('threads.show', $threadId)
            ->with('status', 'Комментарий удалён!');
    }
    public function like(Post $post): \Illuminate\Http\RedirectResponse
    {
        auth()->user()->likedPosts()->toggle($post->id);

        return back();
    }
}
