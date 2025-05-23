<div class="flex flex-col gap-4 rounded-lg bg-slate-700 p-5">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-semibold">{{ ucfirst($taskList->name ?? '') }}</h2>
        <a class="button" type="button" href="{{ route('tasks.create') }}">Add
            Task</a>
    </div>
    @if (isset($tasks) && count($tasks) > 0)
        <div class="flex flex-col gap-2">
            @foreach ($tasks as $task)
                <div class="overflow-hidden rounded-md">
                    {{-- <a href="/tasks/{{ $activeTaskList.'/'.$task.'/edit' }}" class="flex gap-4 items-center p-3"> --}}
                    {{-- <a class="flex items-center gap-4 p-3" --}}
                    {{-- href="{{ route('tasks.edit', ['task' => $task]) }}"> --}}
                    <div class="task-detail-button flex cursor-pointer items-center gap-4 bg-slate-800 p-3 hover:bg-slate-900"
                        data-task-id="{{ $task->id }}">
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
                    </div>
                    <div class="task-detail hidden bg-slate-800 p-3"
                        data-task-id="{{ $task->id }}">
                        <div class="ml-4 flex flex-col gap-2">
                            <div class="flex items-center gap-4">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                                </svg>
                                @if ($task->description)
                                    {{ $task->description }}
                                @else
                                    <i class="text-gray-400">No description</i>
                                @endif
                            </div>
                            <div class="flex items-center gap-4">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                                @if ($task->due_date)
                                    {{ $task->due_date }}
                                @else
                                    <i class="text-gray-400">No due date</i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@vite('resources/js/taskDetail.js')
