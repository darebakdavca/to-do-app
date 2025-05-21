<div class="flex items-center justify-between p-5">
    <h1 class="text-3xl font-semibold"><a href="/">To Do App</a></h1>
    <div class="flex items-center gap-4 text-xl">
        @if (Auth::check())
            <span class="">
                {{ Auth::user()->name }}
            </span>
            -
            <a class="header-link border-blue-500" href="/logout">Logout</a>
        @else
            <a class="header-link {{ request()->is('login') ? 'border-blue-500' : 'border-transparent' }}"
                href="/login">Login</a>
            <a class="header-link {{ request()->is('register') ? 'border-blue-500' : 'border-transparent' }}"
                href="/register">Register</a>
        @endif
    </div>
</div>
