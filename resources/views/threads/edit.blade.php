<div>
    <form action="{{ route('threads.update', $thread->id) }}" method="POST" class="p-6">
        @csrf
        @method('PATCH')

        <input type="text" name="title" value="{{ old('title', $thread->title) }}" class="w-full mb-4">
        <textarea name="body" class="w-full mb-4">{{ old('body', $thread->body) }}</textarea>

        <button type="submit" class="bg-yellow-500 text-white px-4 py-2">Сохранить изменения</button>
    </form>
</div>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Редактирование комментария
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('posts.update', $post->id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PATCH')

                    <textarea name="body" class="w-full mb-4 border rounded p-2">{{ old('body', $post->body) }}</textarea>
                    @error('body') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                    <div class="flex gap-4">
                        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">
                            Сохранить
                        </button>
                        <a href="{{ route('threads.show', $post->thread_id) }}"
                           class="text-gray-500 px-4 py-2">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Редактирование профиля
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('users.update', $user->id) }}"
                      method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Имя</label>
                        <input type="text" name="name"
                               value="{{ old('name', $user->name) }}"
                               class="w-full border rounded p-2">
                        @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Email</label>
                        <input type="email" name="email"
                               value="{{ old('email', $user->email) }}"
                               class="w-full border rounded p-2">
                        @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">
                            Новый пароль (необязательно)
                        </label>
                        <input type="password" name="password"
                               class="w-full border rounded p-2">
                        @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">
                            Подтверждение пароля
                        </label>
                        <input type="password" name="password_confirmation"
                               class="w-full border rounded p-2">
                    </div>

                    <button type="submit"
                            class="bg-yellow-500 text-white px-4 py-2 rounded">
                        Сохранить
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
