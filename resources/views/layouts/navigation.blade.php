<x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-nav-link>

<x-nav-link :href="route('threads.index')" :active="request()->routeIs('threads.*')">
    Форум
</x-nav-link>

<x-nav-link :href="route('threads.index')" :active="request()->routeIs('threads.*')">
    Форум
</x-nav-link>

<x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
    Пользователи
</x-nav-link>
