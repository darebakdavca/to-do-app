<x-layout>
    <x-slot:title>
        Edit task
    </x-slot:title>
    <x-container>
        <x-slot:title>Edit task</x-slot:title>
        <div class="flex flex-col gap-2">
            <form class="form" action="{{ route('tasks.update', ['task' => $task]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label class="label" for="name">
                        Name
                    </label>
                    <input
                        class="input @error('name') border-red-500 @else border-slate-600 @enderror"
                        id="name" name="name" type="text"
                        value="{{ old('name', $task->name) }}" aria-required="true">
                    @error('name')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="label" for="description">
                        Description
                    </label>
                    <textarea class="input @error('description') border-red-500 @else border-slate-600 @enderror !h-52"
                        id="description" name="description">{{ old('description', $task->description) }}</textarea>
                </div>
                <div>
                    <label class="label" for="due_date">
                        Due date
                    </label>
                    <input
                        class="input @error('due_date') border-red-500 @else border-slate-600 @enderror"
                        id="due_date" name="due_date" type="date"
                        value="{{ old('due_date', $task->due_date) }}">
                </div>
                <div>
                    <label for="taks_list_id">Task List</label>
                    <select
                        class="input @error('task_list_id') border-red-500 @else border-slate-600 @enderror"
                        id="task_list_id" name="task_list_id">
                        @foreach ($taskLists as $taskList)
                            <option value="{{ old('task_list_id', $task->task_list_id) }}"
                                selected="{{ $taskList->id === $task->task_list_id }}">
                                {{ $taskList->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('task_list_id')
                        <div class="error-msg">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex gap-2 text-white">
                    <button class="button" type="submit">Save</button>
                    <a class="cancel-button" id="close-btn" type="button"
                        href="{{ route('task-lists.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </x-container>
</x-layout>
