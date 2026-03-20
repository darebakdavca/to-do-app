<div class="flex items-center justify-between p-5 pb-2">
    <h1 class="text-3xl font-semibold"><a href="/">To Do App</a></h1>
    <div class="flex items-center gap-4 text-xl">
        @auth
            <div class="hidden gap-2 md:flex">
                <span class="">
                    {{ Auth::user()->name }}
                </span>
                -
                <a class="header-link border-blue-500" href="/logout">Logout</a>
            </div>
            <div class="relative flex items-center text-base md:hidden">
                <button class="cursor-pointer" id="profile-menu-button">
                    <x-user-avatar :name="Auth::user()->name" size="size-8 text-xs" />
                </button>
                <div class="absolute right-0 top-10 z-50 flex hidden w-auto flex-col rounded bg-slate-600 shadow *:p-2"
                    id="profile-menu">
                    <div class="text-nowrap border-b-2 border-slate-500 text-center font-semibold">
                        {{ Auth::user()->name }}
                    </div>
                    <a class="flex h-full w-full items-center justify-center gap-2 text-center"
                        href="/logout">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                        </svg>
                        Logout</a>
                </div>
            </div>
        @else
            <a class="header-link {{ request()->is('login') ? 'border-blue-500' : 'border-transparent' }}"
                href="{{ route('login.index') }}">Login</a>
            <a class="header-link {{ request()->is('register') ? 'border-blue-500' : 'border-transparent' }}"
                href="{{ route('register.index') }}">Register</a>
        @endauth
    </div>
    @if (session('status'))
        <div class="hidden" data-status-toast data-status="{{ session('status') }}"></div>
    @endif
</div>
