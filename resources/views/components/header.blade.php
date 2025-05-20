<div class="flex items-center justify-between p-5">
    <h1 class="text-3xl font-semibold"><a href="/">To Do App</a></h1>
    <div class="flex gap-4 text-xl">
        <a href="/login" class="header-link {{ request()->is('login') ? 'border-blue-500' : 'border-transparent' }}">Login</a>
        <a href="/register" class="header-link {{ request()->is('register') ? 'border-blue-500' : 'border-transparent' }}">Register</a>
    </div>
</div>
