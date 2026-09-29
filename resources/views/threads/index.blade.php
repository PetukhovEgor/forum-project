<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форум — Темы</title>
</head>
<body>
<h1>Темы форума</h1>

<ul>
    @foreach ($threads as $thread)
        <li>
            <strong>{{ $thread->title }}</strong>
            <p>{{ $thread->body }}</p>
            <small>Автор: {{ $thread->user->name }}</small>
        </li>
        @if($thread->image_path)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $thread->image_path) }}"
                     alt="Обложка"
                     class="w-48 h-auto rounded shadow-sm">
            </div>
        @endif
        <div class="mt-2 flex items-center gap-2">
            <span class="text-gray-600 font-bold">Лайков: {{ $thread->likes_count }}</span>

            @auth
                <form action="{{ route('threads.like', $thread->id) }}" method="POST">
                    @csrf
                    @if(auth()->user()->likedThreads->contains($thread->id))
                        <button type="submit" class="text-red-500 font-bold">Не нравится</button>
                    @else
                        <button type="submit" class="text-blue-500">Нравится</button>
                    @endif
                </form>
            @endauth
        </div>
    @endforeach
</ul>
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Форум (Список тем)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href="{{ route('threads.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Создать тему</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @foreach($threads as $thread)
                        <div class="mb-4 border-b pb-4">
                            <a href="{{ route('threads.show', $thread->id) }}" class="text-lg font-bold text-blue-600 hover:underline">
                                {{ $thread->title }}
                            </a>
                            <p class="text-sm text-gray-500 mt-1">Автор: {{ $thread->user->name }} | {{ $thread->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach

                    <div class="mt-4">
                        {{ $threads->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Пользователи
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

                @if(session('status'))
                    <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="mb-4">
                    <a href="{{ route('users.create') }}"
                       class="bg-blue-500 text-white px-4 py-2 rounded">
                        Добавить пользователя
                    </a>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <table class="w-full">
                            <thead>
                            <tr class="border-b text-left text-gray-500">
                                <th class="pb-2">Имя</th>
                                <th class="pb-2">Email</th>
                                <th class="pb-2">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="border-b">
                                    <td class="py-3">{{ $user->name }}</td>
                                    <td class="py-3">{{ $user->email }}</td>
                                    <td class="py-3">
                                        @if($user->id === auth()->id())
                                            <a href="{{ route('users.edit', $user->id) }}"
                                               class="text-yellow-600 mr-3 hover:underline">
                                                Редактировать</a>
                                            <form action="{{ route('users.destroy', $user->id) }}"
                                                  method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:underline">
                                                    Удалить
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
