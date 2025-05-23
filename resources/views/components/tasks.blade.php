<div class="flex flex-col gap-4 self-start rounded-lg bg-slate-700 p-5">
    <div>

        <div class="flex items-center justify-between">
            <div class="flex gap-4">
                <h2 class="text-2xl font-semibold">{{ ucfirst($taskList->name ?? '') }}</h2>
                <div class="flex items-center justify-center gap-2">
                    <a class="task-button hover:bg-slate-800"
                        href="{{ route('task-lists.edit', ['task_list' => $taskList]) }}">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </a>
                    @if ($taskList->type == 'shared')
                        <a class="task-button hover:bg-slate-800" href="">
                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
            <a class="button" type="button"
                href="{{ route('tasks.create', ['task-list' => $taskList]) }}">
                <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

                Add Task
            </a>
        </div>
        <div>{{ $taskList->description }}</div>
    </div>
    @if (isset($tasks) && count($tasks) > 0)
        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <h4 class="font-semibold">Open:</h4>
                <div class="h-[1px] bg-slate-400"></div>
                @if ($tasks->where('complete', false)->count() === 0)
                    <i class="text-gray-400">No closed tasks</i>
                @else
                    @foreach ($tasks->where('complete', false) as $task)
                        <div class="mt-1 overflow-hidden rounded-md">
                            <div class="task-detail-button flex cursor-pointer items-center justify-between gap-4 bg-slate-800 hover:bg-slate-900"
                                data-task-id="{{ $task->id }}">
                                <div class="flex items-center gap-4 p-3">
                                    <form class="flex items-center" method="POST"
                                        action="{{ route('tasks.complete', $task) }}">
                                        @csrf
                                        @if ($task->complete == false)
                                            <button
                                                class="size-6 cursor-pointer rounded-full border-2 border-blue-500 bg-transparent outline-blue-300 transition hover:outline-2"
                                                type="submit"></button>
                                        @else
                                            <button
                                                class="flex size-6 cursor-pointer items-center justify-center rounded-full border-2 border-blue-500 bg-blue-500 outline-blue-300 transition hover:outline-2"
                                                type="submit">
                                                <svg class="stroke-3 size-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>

                                            </button>
                                        @endif
                                    </form>
                                    <p>
                                        {{ $task->name }}
                                    </p>
                                </div>
                                <div class="task-actions hidden px-1.5"
                                    data-task-id="{{ $task->id }}">
                                    <div class="flex items-center justify-end gap-2">
                                        <a class="task-button"
                                            href="{{ route('tasks.edit', $task) }}">
                                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="task-button" type="submit">
                                                <svg class="size-5"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="task-detail hidden bg-slate-800 p-3"
                                data-task-id="{{ $task->id }}">
                                <div class="ml-4 flex flex-col gap-2">
                                    <div class="flex items-start gap-4">
                                        <div class="mt-0.5">
                                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                                            </svg>
                                        </div>
                                        @if ($task->description)
                                            {!! nl2br(e($task->description)) !!}
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
                @endif
            </div>
            <div class="flex flex-col gap-2">
                <h4 class="font-semibold">Closed:</h4>
                <div class="h-[1px] bg-slate-400"></div>
                @if ($tasks->where('complete', true)->count() === 0)
                    <i class="text-gray-400">No closed tasks</i>
                @else
                    @foreach ($tasks->where('complete', true) as $task)
                        <div class="mt-1 overflow-hidden rounded-md">
                            <div class="task-detail-button flex cursor-pointer items-center justify-between gap-4 bg-slate-800 hover:bg-slate-900"
                                data-task-id="{{ $task->id }}">
                                <div class="flex items-center gap-4 p-3">
                                    <form class="flex items-center" method="POST"
                                        action="{{ route('tasks.complete', $task) }}">
                                        @csrf
                                        @if ($task->complete == false)
                                            <button
                                                class="size-6 cursor-pointer rounded-full border-2 border-blue-500 bg-transparent outline-blue-300 transition hover:outline-2"
                                                type="submit"></button>
                                        @else
                                            <button
                                                class="flex size-6 cursor-pointer items-center justify-center rounded-full border-2 border-blue-500 bg-blue-500 outline-blue-300 transition hover:outline-2"
                                                type="submit">
                                                <svg class="stroke-3 size-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>

                                            </button>
                                        @endif
                                    </form>
                                    <p>
                                        {{ $task->name }}
                                    </p>
                                </div>
                                <div class="task-actions hidden px-1.5"
                                    data-task-id="{{ $task->id }}">
                                    <div class="flex items-center justify-end gap-2">
                                        <a class="task-button"
                                            href="{{ route('tasks.edit', $task) }}">
                                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="task-button" type="submit">
                                                <svg class="size-5"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="task-detail hidden bg-slate-800 p-3"
                                data-task-id="{{ $task->id }}">
                                <div class="ml-4 flex flex-col gap-2">
                                    <div class="flex items-start gap-4">
                                        <div class="mt-0.5">
                                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                                            </svg>
                                        </div>
                                        @if ($task->description)
                                            {!! nl2br(e($task->description)) !!}
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
                @endif
            </div>
        </div>
    @endif
</div>
@vite('resources/js/taskDetail.js')
