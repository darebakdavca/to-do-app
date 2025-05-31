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
                href="{{ route('login.index') }}">Login</a>
            <a class="header-link {{ request()->is('register') ? 'border-blue-500' : 'border-transparent' }}"
                href="{{ route('register.index') }}">Register</a>
        @endauth
    </div>
    @if (session('status'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Toastify({
                    text: @json(session('status')),
                    duration: 4000,
                    gravity: "top",
                    position: "center",
                    offset: {
                        y: 20,
                    },
                    style: {
                        borderRadius: '0.7rem',
                        fontWeight: 'bold',
                        padding: '0.7rem 2rem',
                        fontSize: '1.2rem'
                    }
                }).showToast();
            });
        </script>
    @endif
</div>
