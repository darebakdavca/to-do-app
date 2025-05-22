<x-layout>
    <x-slot:title>Login</x-slot:title>
    <x-container>
        <x-slot:title>Login</x-slot:title>
        <x-slot:description>Login to edit your tasks.</x-slot:description>
        @if ($errors->any())
            <div class="mb-4 text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form" method="POST" action="/login">
            @csrf
            <div>
                <label class="label" for="email">
                    Email
                </label>
                <input class="input @error('email') border-red-500 @else border-slate-600 @enderror"
                    id="email" name="email" type="email" value="{{ old('email') }}" required>
            </div>
            <div>
                <label class="label" for="password">
                    Password
                </label>
                <input class="input @error('email') border-red-500 @else border-slate-600 @enderror"
                    id="password" name="password" type="password" required>
            </div>
            <button class="button" type="submit">Login</button>
        </form>
    </x-container>
</x-layout>
