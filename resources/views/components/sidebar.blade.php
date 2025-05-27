<div class="w-max-52 flex w-60 flex-col gap-4">
    <div class="rounded-lg bg-slate-950 p-3">
        <div class="mb-2 flex items-center justify-between">

            <h3 class="flex items-center gap-2 text-lg font-semibold">
                Private
                <div class="relative">
                    <button class="task-button info-btn hover:bg-slate-800"
                        data-info="Private task lists are only visible to you.">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                    </button>
                </div>
            </h3>

            <a class="task-button"
                href="{{ route('task-lists.create', ['type' => 'private', 'task-list' => $taskList]) }}">
                <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </a>
        </div>
        @foreach ($taskLists->where('type', 'private') as $myTaskList)
            <div
                class="{{ $myTaskList->id == $taskList->id ? 'border-white font-bold' : '' }} cursor-pointer border-r-2 border-gray-700 bg-slate-900">
                <a class="block px-3 py-1.5 hover:bg-slate-800"
                    href="{{ route('task-lists.show', ['task_list' => $myTaskList]) }}">{{ ucfirst($myTaskList->name) }}</a>
            </div>
        @endforeach
    </div>
    <div class="h-[1px] bg-slate-400"></div>
    <div class="rounded-lg bg-slate-950 p-3">
        <div class="mb-2 flex items-center justify-between">
            <h3 class="flex items-center gap-2 text-lg font-semibold">Shared
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <div class="relative">
                    <button class="task-button info-btn hover:bg-slate-800"
                        data-info="The task list can be shared with other users.">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                    </button>
                </div>
            </h3>
            <a class="task-button"
                href="{{ route('task-lists.create', ['type' => 'shared', 'task-list' => $taskList]) }}">
                <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

            </a>
        </div>
        @foreach ($taskLists->where('type', 'shared') as $myTaskList)
            <div
                class="{{ $myTaskList->id == $taskList->id ? 'border-white font-bold' : '' }} cursor-pointer border-r-2 border-gray-700 bg-slate-900">
                <a class="flex items-center justify-between gap-2 px-3 py-1.5 hover:bg-slate-800"
                    href="{{ route('task-lists.show', ['task_list' => $myTaskList]) }}">
                    {{ ucfirst($myTaskList->name) }}
                </a>
            </div>
        @endforeach
    </div>
</div>
