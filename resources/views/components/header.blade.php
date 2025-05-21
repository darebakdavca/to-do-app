<div class="flex items-center justify-between p-5">
    <h1 class="text-3xl font-semibold"><a href="/">To Do App</a></h1>
    <div class="flex items-center gap-4 text-xl">
        @auth
            <div class="flex gap-2">
                <span class="">
                    {{ Auth::user()->name }}
                </span>
                -
                <a class="header-link border-blue-500" href="/logout">Logout</a>
            </div>
        @else
            <a class="header-link {{ request()->is('login') ? 'border-blue-500' : 'border-transparent' }}"
                href="/login">Login</a>
            <a class="header-link {{ request()->is('register') ? 'border-blue-500' : 'border-transparent' }}"
                href="/register">Register</a>
        @endauth
    </div>
</div>
