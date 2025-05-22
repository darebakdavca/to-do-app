<div class="flex flex-col gap-4 rounded-lg bg-slate-700 p-5">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-semibold">{{ ucfirst($taskList->name ?? '') }}</h2>
        <a class="button" type="button" href="{{ route('tasks.create') }}">Add
            Task</a>
    </div>
    @if (isset($tasks) && count($tasks) > 0)
        <div class="flex flex-col gap-2">
            @foreach ($tasks as $task)
                <div class="rounded-md bg-slate-800 hover:bg-slate-900">
                    {{-- <a href="/tasks/{{ $activeTaskList.'/'.$task.'/edit' }}" class="flex gap-4 items-center p-3"> --}}
                    <a class="flex items-center gap-4 p-3"
                        href="{{ route('tasks.edit', ['task' => $task]) }}">
                        <form class="flex items-center" method="POST"
                            action="/tasks/{{ $taskList->id . '/' . $task }}/complete">
                            @csrf
                            <button
                                class="size-6 cursor-pointer rounded-full border-2 border-blue-500 bg-transparent transition hover:bg-blue-500"
                                type="submit"></button>
                        </form>
                        <p>
                            {{ $task->name }}
                        </p>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
