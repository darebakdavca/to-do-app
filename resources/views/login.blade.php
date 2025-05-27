<x-layout>
    <x-slot:title>Login</x-slot:title>
    <x-container>
        <x-slot:title>Login</x-slot:title>
        <x-slot:description>Login to edit your tasks.</x-slot:description>
        <form class="form" method="POST" action="{{ route('login.authenticate') }}">
            @csrf
            <div>
                <label class="label" for="email">
                    Email
                </label>
                <input class="input @error('email') border-red-500 @else border-slate-600 @enderror"
                    id="email" name="email" type="email" value="{{ old('email') }}">
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="label" for="password">
                    Password
                </label>
                <input class="input @error('email') border-red-500 @else border-slate-600 @enderror"
                    id="password" name="password" type="password">
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            <button class="button" type="submit">Login</button>
            @isset($callback)
                <input name="callback" type="hidden" value="{{ $callback }}">
            @endisset
        </form>
        @if ($errors->any())
            <div class="mt-4">
                <a class="block text-center text-gray-100 hover:underline"
                    href="{{ route('register.index') }}">
                    Don't have an account? Register
                </a>
            </div>
        @endif
    </x-container>
</x-layout>
