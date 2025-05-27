<x-layout>
    <x-slot:title>Create new task</x-slot:title>
    <x-container>
        <x-slot:title>Create new task</x-slot:title>
        <div class="flex flex-col gap-2">
            <form class="form" action="{{ route('tasks.store') }}" method="post">
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
                <div>
                    <label class="label" for="due_date">
                        Due date
                    </label>
                    <input
                        class="input @error('due_date') border-red-500 @else border-slate-600 @enderror"
                        id="due_date" name="due_date" type="date" value="{{ old('due_date') }}">
                </div>
                <div>
                    <label for="taks_list_id">Task List</label>
                    <select
                        class="input @error('task_list_id') border-red-500 @else border-slate-600 @enderror"
                        id="task_list_id" name="task_list_id">
                        <optgroup label="Private">
                            @foreach ($taskLists->where('type', 'private') as $taskList)
                                <option value="{{ old('task_list_id', $taskList->id) }}"
                                    @if ($taskList->id == $myTaskList) selected @endif>
                                    {{ ucfirst($taskList->name) }}
                                </option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Shared">
                            @foreach ($taskLists->where('type', 'shared') as $taskList)
                                <option value="{{ old('task_list_id', $taskList->id) }}"
                                    @if ($taskList->id == $myTaskList) selected @endif>
                                    {{ ucfirst($taskList->name) }} </option>
                            @endforeach
                        </optgroup>
                    </select>
                    @error('task_list_id')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex gap-2 text-white">
                    <button class="button" type="submit">Create</button>
                    <a class="cancel-button" id="close-btn" type="button"
                        href="{{ route('task-lists.show', ['task_list' => $myTaskList]) }}">Cancel</a>
                </div>
            </form>
        </div>
    </x-container>
    <script>
        // Set min date to user's local today
        document.addEventListener('DOMContentLoaded', () => {
            const dueDateInput = document.getElementById('due_date');
            if (dueDateInput) {
                const today = new Date();
                const yyyy = today.getFullYear();
                const mm = String(today.getMonth() + 1).padStart(2, '0');
                const dd = String(today.getDate()).padStart(2, '0');
                dueDateInput.min = `${yyyy}-${mm}-${dd}`;
            }
        });
    </script>
</x-layout>
