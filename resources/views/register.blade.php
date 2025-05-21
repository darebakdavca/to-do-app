<x-layout>
    <x-slot:title>Register</x-slot:title>
    <x-authContainer>
        <x-slot:title>Register</x-slot:title>
        <x-slot:description>Register your account to save your first task</x-slot:description>
        <form class="grid grid-cols-1 gap-4" method="POST" action="/register">
            @csrf
            <div>
                <label class="label" for="name">
                    Name
                </label>
                <input class="input @error('name') border-red-500 @else border-slate-600 @enderror"
                    id="name" name="name" type="text" required>
                @error('name')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="label" for="email">
                    Email
                </label>
                <input class="input @error('email') border-red-500 @else border-slate-600 @enderror"
                    id="email" name="email" type="email" required>
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="label" for="password1">
                    Password
                </label>
                <input
                    class="input @error('password1') border-red-500 @else border-slate-600 @enderror"
                    id="password1" name="password1" type="password" required>
            </div>
            <div>
                <label class="label" for="password2">
                    Password again
                </label>
                <input
                    class="input @error('password2') border-red-500 @else border-slate-600 @enderror"
                    id="password2" name="password2" type="password" required>
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            <button class="button" type="submit">Register</button>
        </form>
    </x-authContainer>
</x-layout>
