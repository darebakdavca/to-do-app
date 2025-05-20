<x-layout>
    <x-slot:title>Register</x-slot:title>
    <x-authContainer>
        <x-slot:title>Register</x-slot:title>
        <x-slot:description>Register your account to save your first task</x-slot:description>
        <form method="POST" action="/register" class="grid grid-cols-1 gap-4">
            @csrf
            <div>
                <label for="email" class="label">
                    Email
                </label>
                <input type="email" required id="email" name="email" class="input">
            </div>
            <div>
                <label for="pswd1" class="label">
                    Password
                </label>
                <input type="password" required id="pswd1" name="pswd1" class="input">
            </div>
            <div>
                <label for="pswd1" class="label">
                    Password again
                </label>
                <input type="password" required id="pswd2" name="pswd2" class="input">
            </div>
            <button class="button" type="submit">Register</button>
        </form>
    </x-authContainer>
</x-layout>
