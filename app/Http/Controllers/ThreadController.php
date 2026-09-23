<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThreadRequest;
use App\Models\Thread;

class ThreadController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $threads = Thread::with('user')->latest()->paginate(10);
        return view('threads.index', compact('threads'));
    }

    public function show(Thread $thread): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $thread->load('posts.user');
        return view('threads.show', compact('thread'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('threads.create');
    }

    public function store(StoreThreadRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:100',
            'body'  => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('threads', 'public');
        }

        $request->user()->threads()->create([
            'title'      => $validated['title'],
            'body'       => $validated['body'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('threads.index')
            ->with('status', 'Тема с картинкой создана!');
    }

    public function edit(Thread $thread): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if ($thread->user_id !== auth()->id()) abort(403, 'Доступ запрещен.');

        return view('threads.edit', compact('thread'));
    }

    public function update(StoreThreadRequest $request, Thread $thread): \Illuminate\Http\RedirectResponse
    {
        if ($thread->user_id !== auth()->id()) abort(403);

        $thread->update($request->validated());
        return redirect()->route('threads.show', $thread->id)->with('status', 'Тема обновлена!');
    }

    public function destroy(Thread $thread): \Illuminate\Http\RedirectResponse
    {
        if ($thread->user_id !== auth()->id()) abort(403);

        $thread->delete();
        return redirect()->route('threads.index')->with('status', 'Тема удалена!');
    }
}
