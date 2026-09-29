<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ThreadController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index');
Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');

Route::middleware('auth')->group(function () {

    Route::get('/thread/create', [ThreadController::class, 'create'])->name('threads.create');
    Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');

    Route::get('/threads/{thread}/edit', [ThreadController::class, 'edit'])->name('threads.edit');
    Route::patch('/threads/{thread}', [ThreadController::class, 'update'])->name('threads.update');

    Route::delete('/threads/{thread}', [ThreadController::class, 'destroy'])->name('threads.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/threads/{thread}/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::post('/threads/{thread}/like', [ThreadController::class, 'like'])->name('threads.like')->middleware('auth');

Route::post('/posts/{post}/like', [PostController::class, 'like'])
    ->name('posts.like')->middleware('auth');
