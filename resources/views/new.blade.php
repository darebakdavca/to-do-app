<x-layout>
    <x-slot:title>Create new task</x-slot:title>
    <x-container>
        <x-slot:title>Create new task in {{ ucfirst($myTaskList->name) }} task list</x-slot:title>
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
                @if ($myTaskList->type === 'shared')
                    <div>
                        <p class="label">
                            Assign to:
                        </p>
                        @foreach ($myTaskList->users as $user)
                            <div class="mb-1 flex items-center gap-2 font-semibold">
                                <input
                                    class="h-4 w-4 rounded border-slate-600 bg-slate-800 accent-blue-600 focus:ring-2 focus:ring-blue-500"
                                    id="user-{{ $user->id }}" name="assignees[]" type="checkbox"
                                    value="{{ $user->id }}"
                                    @if (!empty(old('assignees'))) checked @endif>
                                <label class="cursor-pointer text-slate-200"
                                    for="user-{{ $user->id }}">
                                    {{ $user->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @else
                    <input name="assignees[]" type="hidden" value="{{ Auth::user()->id }}">
                @endif
                <div>
                    <label class="label" for="due_date">
                        Due date
                    </label>
                    <input
                        class="input @error('due_date') border-red-500 @else border-slate-600 @enderror"
                        id="due_date" name="due_date" type="date"
                        value="{{ old('due_date') }}">
                </div>
                <input name="task_list_id" type="hidden" value="{{ $myTaskList->id }}">
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
