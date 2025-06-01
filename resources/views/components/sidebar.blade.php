<aside
    class="absolute inset-0 top-28 z-50 hidden h-[calc(100svh-112px)] w-full shrink grow bg-slate-900 p-5 pt-0 md:static md:flex md:h-full md:w-52 md:max-w-[250px] md:bg-transparent md:p-0"
    id="sidebar">
    <div class="flex w-full flex-col gap-4">
        <div class="rounded-lg bg-slate-950 p-3">
            <div class="mb-2 flex items-center justify-between">
                <h3 class="flex items-center gap-2 text-lg font-semibold">
                    Private
                    <div class="relative">
                        <button class="task-button info-btn hover:bg-slate-800"
                            data-info="Private task lists are only visible to you.">
                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </h3>
                <div class="relative">
                    <a class="task-button info-btn" data-info="Create new private task list"
                        href="{{ route('task-lists.create', ['type' => 'private', 'task-list' => $taskList]) }}">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </a>
                </div>
            </div>
            @foreach ($taskLists->where('type', 'private') as $myTaskList)
                <div
                    class="{{ empty($filterType) && $myTaskList->id == $taskList->id ? 'border-white font-bold' : '' }} cursor-pointer border-r-2 border-gray-700 bg-slate-900">
                    <a class="block overflow-hidden text-ellipsis whitespace-nowrap px-3 py-1.5 hover:bg-slate-800"
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
                            data-info="Shared task lists can be shared with other users.">
                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                    clip-rule="evenodd" />
                            </svg>


                        </button>
                    </div>
                </h3>
                <div class="relative">
                    <a class="task-button info-btn" data-info="Create new shared task list"
                        href="{{ route('task-lists.create', ['type' => 'shared']) }}">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </a>
                </div>
            </div>
            @foreach ($taskLists->where('type', 'shared') as $myTaskList)
                <div
                    class="{{ empty($filterType) && $myTaskList->id == $taskList->id ? 'border-white font-bold' : '' }} cursor-pointer border-r-2 border-gray-700 bg-slate-900">
                    <a class="flex items-center justify-between gap-2 px-3 py-1.5 hover:bg-slate-800"
                        href="{{ route('task-lists.show', ['task_list' => $myTaskList]) }}">
                        {{ ucfirst($myTaskList->name) }}
                    </a>
                </div>
            @endforeach
        </div>
        <div class="rounded-lg bg-slate-950 p-3">
            <div class="mb-2 flex items-center justify-between">
                <h3 class="flex items-center gap-2 text-lg font-semibold">Filter views
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>

                    <div class="relative">
                        <button class="task-button info-btn hover:bg-slate-800"
                            data-info="Filter views allow you to quickly switch between different filters.">
                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                    clip-rule="evenodd" />
                            </svg>


                        </button>
                    </div>
                </h3>
            </div>
            @foreach ([['name' => 'Assigned to me', 'type' => 'assigned'], ['name' => 'Planned', 'type' => 'planned']] as $filter)
                <div
                    class="{{ isset($filterType) && $filterType === $filter['type'] ? 'border-white font-bold' : '' }} cursor-pointer border-r-2 border-gray-700 bg-slate-900">
                    <a class="flex items-center justify-between gap-2 px-3 py-1.5 hover:bg-slate-800"
                        href="{{ route('tasks.filter', ['filterType' => $filter['type']]) }}">
                        {{ $filter['name'] }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</aside>
