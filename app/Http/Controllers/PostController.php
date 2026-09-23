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
        $thread->posts()->create([
            'user_id' => $request->user()->id,
            'body'    => $request->validated()['body'],
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

        $post->update($request->validated());

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
}
