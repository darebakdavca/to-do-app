<x-layout>
    <x-slot:title>Edit task list</x-slot:title>
    <x-container>
        <x-slot:title>Edit task list</x-slot:title>
        <div class="flex flex-col gap-2">
            <form class="form" action="{{ route('task-lists.update', ['task_list' => $taskList]) }}"
                method="post">
                @csrf
                @method('PUT')
                <div>
                    <label class="label" for="name">
                        Name
                    </label>
                    <input
                        class="input @error('name') border-red-500 @else border-slate-600 @enderror"
                        id="name" name="name" type="text"
                        value="{{ old('name', $taskList->name) }}" aria-required="true">
                    @error('name')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="label" for="description">
                        Description
                    </label>
                    <textarea class="input @error('description') border-red-500 @else border-slate-600 @enderror !h-52"
                        id="description" name="description">{{ old('description', $taskList->description) }}</textarea>
                </div>
                <input name="type" type="hidden" value="{{ $taskList->type }}">
                <div class="flex gap-2 text-white">
                    <button class="button" type="submit">Save</button>
                    <a class="cancel-button" id="close-btn" type="button"
                        href="{{ route('task-lists.show', ['task_list' => $taskList]) }}">Cancel</a>
                </div>
            </form>
        </div>
    </x-container>
</x-layout>
