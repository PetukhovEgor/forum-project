<div>
    <div class="p-6">
        <h1 class="text-2xl font-bold">{{ $thread->title }}</h1>
        <p class="mt-4">{{ $thread->body }}</p>

        @if(auth()->id() === $thread->user_id)
            <div class="flex gap-4 mt-4">
                <a href="{{ route('threads.edit', $thread->id) }}" class="text-yellow-600">Редактировать</a>

                <form action="{{ route('threads.destroy', $thread->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600">Удалить</button>
                </form>
            </div>
        @endif
    </div>
</div>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $thread->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold">{{ $thread->title }}</h1>
                    <p class="mt-2 text-gray-500 text-sm">
                        Автор: {{ $thread->user->name }} |
                        {{ $thread->created_at->diffForHumans() }}
                    </p>
                    <p class="mt-4 whitespace-pre-line">{{ $thread->body }}</p>

                    @if(auth()->id() === $thread->user_id)
                        <div class="flex gap-4 mt-4">
                            <a href="{{ route('threads.edit', $thread->id) }}"
                               class="text-yellow-600 hover:underline">Редактировать</a>
                            <form action="{{ route('threads.destroy', $thread->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">
                                    Удалить
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            @foreach($thread->posts as $post)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 mb-2">
                            {{ $post->user->name }} — {{ $post->created_at->diffForHumans() }}
                        </p>
                        <p class="whitespace-pre-line">{{ $post->body }}</p>

                        @if(auth()->id() === $post->user_id)
                            <div class="flex gap-4 mt-3">
                                <a href="{{ route('posts.edit', $post->id) }}"
                                   class="text-yellow-600 text-sm hover:underline">
                                    Редактировать
                                </a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 text-sm hover:underline">
                                        Удалить
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                @if($thread->image_path)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $thread->image_path) }}"
                             alt="Обложка"
                             class="w-full max-w-md h-auto rounded shadow">
                    </div>
                @endif
            @endforeach

            @auth
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form action="{{ route('posts.store', $thread->id) }}" method="POST" class="p-6">
                        @csrf
                        <textarea name="body" placeholder="Ваш комментарий..."
                                  class="w-full border rounded p-2 mb-2">{{ old('body') }}</textarea>
                        @error('body')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded">
                            Отправить
                        </button>
                    </form>
                </div>
            @endauth

            @auth
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form action="{{ route('posts.store', $thread->id) }}"
                          method="POST" enctype="multipart/form-data" class="p-6">
                        @csrf

                        <textarea name="body" placeholder="Ваш комментарий..."
                                  class="w-full border rounded p-2 mb-2">{{ old('body') }}</textarea>
                        @error('body')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <div class="mb-2">
                            <label class="block text-gray-600 text-sm mb-1">
                                Картинка (необязательно)
                            </label>
                            <input type="file" name="image" class="w-full">
                            @error('image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded">
                            Отправить
                        </button>
                    </form>
                </div>
            @endauth

            @foreach($thread->posts as $post)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 mb-2">
                            {{ $post->user->name }} — {{ $post->created_at->diffForHumans() }}
                        </p>
                        <p class="whitespace-pre-line">{{ $post->body }}</p>

                        @if($post->image_path)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $post->image_path) }}"
                                     alt="Картинка к комментарию"
                                     class="max-w-xs h-auto rounded shadow-sm">
                            </div>
                        @endif

                        @if(auth()->id() === $post->user_id)
                            <div class="flex gap-4 mt-3">
                                <a href="{{ route('posts.edit', $post->id) }}"
                                   class="text-yellow-600 text-sm hover:underline">
                                    Редактировать
                                </a>
                                <form action="{{ route('posts.destroy', $post->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 text-sm hover:underline">
                                        Удалить
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
