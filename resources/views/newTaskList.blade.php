<x-layout>
    <x-slot:title>Create new task list</x-slot:title>
    <x-container>
        <x-slot:title>Create new {{ $type }} task list</x-slot:title>
        <div class="flex flex-col gap-2">
            <form class="form" action="{{ route('task-lists.store') }}" method="post">
                @csrf
                <div>
                    <label class="label" for="name">
                        Name
                    </label>
                    <input
                        class="input @error('name') border-red-500 @else border-slate-600 @enderror"
                        id="name" name="name" type="text" value="{{ old('name') }}"
                        aria-required="true">
                    @error('name')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="label" for="description">
                        Description
                    </label>
                    <textarea class="input @error('description') border-red-500 @else border-slate-600 @enderror !h-52"
                        id="description" name="description">{{ old('description') }}</textarea>
                </div>
                <input name="type" type="hidden" value="{{ $type }}">
                <div class="flex gap-2 text-white">
                    <button class="button" type="submit">Create</button>
                    <a class="cancel-button" id="close-btn" type="button"
                        href="{{ session('previous_url', route('home')) }}">Cancel</a>
                </div>
            </form>
        </div>
    </x-container>
</x-layout>
