<x-layout>
    <x-slot:title>Register</x-slot:title>
    <x-container>
        <x-slot:title>Register</x-slot:title>
        <x-slot:description>Register your account to create your first task.</x-slot:description>
        <form class="grid grid-cols-1 gap-4" method="POST" action="{{ route('register.create') }}">
            @csrf
            <div>
                <label class="label" for="name">
                    Name
                </label>
                <input class="input @error('name') border-red-500 @else border-slate-600 @enderror"
                    id="name" name="name" type="text" value="{{ old('name') }}">
                @error('name')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
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
                <label class="label" for="password1">
                    Password
                </label>
                <div class="relative">
                    <input
                        class="input @error('password1') border-red-500 @else border-slate-600 @enderror pr-12"
                        id="password1" name="password1" type="password"
                        value="{{ old('password1') }}">
                    <x-pswd-toggle target="password1" />
                </div>
                @error('password1')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="label" for="password2">
                    Password again
                </label>
                <div class="relative">
                    <input
                        class="input @error('password2') border-red-500 @else border-slate-600 @enderror pr-12"
                        id="password2" name="password2" type="password"
                        value="{{ old('password2') }}">
                    <x-pswd-toggle target="password2" />
                </div>
                @error('password2')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            <button class="button" type="submit">Register</button>
            @isset($callback)
                <input name="callback" type="hidden" value="{{ $callback }}">
            @endisset
        </form>
    </x-container>
</x-layout>
