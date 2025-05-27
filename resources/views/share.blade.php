<x-layout>
    <x-slot:title>
        Share
    </x-slot:title>
    <x-container>
        <x-slot:title>Share task list</x-slot:title>
        <div class="flex flex-col gap-2">
            <div class="mb-5">Enter the new member's email or share him the link</div>
            <form class="form" action="{{ route('share.send') }}" method="post">
                @csrf
                <div>
                    <label class="label" for="email">
                        Email
                    </label>
                    <input
                        class="input @error('email') border-red-500 @else border-slate-600 @enderror"
                        id="email" name="email" type="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex gap-2 text-white">
                    <button class="button" type="submit">Invite members</button>
                    <a class="cancel-button" id="close-btn" type="button"
                        href="{{ route('task-lists.show', ['task_list' => $taskList]) }}">Cancel</a>
                </div>
                <input name="link" type="text" value="{{ $link }}" hidden>
                <input name="token" type="text" value="{{ $token }}" hidden>
            </form>
            <div>Copy link:</div>
            <p>{{ $link }}</p>
        </div>
    </x-container>
</x-layout>
