<div>
    <form action="{{ route('threads.store') }}" method="POST" class="p-6">
        @csrf
        <input type="text" name="title" value="{{ old('title') }}" placeholder="Заголовок" class="w-full mb-4">
        @error('title') <span class="text-red-500">{{ $message }}</span> @enderror

        <textarea name="body" placeholder="Текст" class="w-full mb-4">{{ old('body') }}</textarea>
        @error('body') <span class="text-red-500">{{ $message }}</span> @enderror

        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Создать</button>
    </form>
</div>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Новый пользователь
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('users.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Имя</label>
                        <input type="text" name="name"
                               value="{{ old('name') }}"
                               class="w-full border rounded p-2">
                        @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Email</label>
                        <input type="email" name="email"
                               value="{{ old('email') }}"
                               class="w-full border rounded p-2">
                        @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Пароль</label>
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
                            class="bg-blue-500 text-white px-4 py-2 rounded">
                        Создать
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Создать тему
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('threads.store') }}" method="POST"
                      enctype="multipart/form-data" class="p-6 space-y-4">
                    @csrf

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Заголовок</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               class="w-full border rounded p-2">
                        @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Текст темы</label>
                        <textarea name="body" class="w-full border rounded p-2">{{ old('body') }}</textarea>
                        @error('body')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">
                            Обложка темы (необязательно)
                        </label>
                        <input type="file" name="image" class="w-full">
                        @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded">
                        Создать
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
