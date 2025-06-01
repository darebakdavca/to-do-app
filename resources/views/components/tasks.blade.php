<div class="flex flex-col gap-4 self-start rounded-lg bg-slate-700 p-3 md:p-5">
    <div>
        <div class="flex items-center justify-between">
            <div class="flex grow justify-between gap-2 md:justify-start">
                <h2 class="text-2xl font-semibold">
                    {{ empty($filterType) ? ucfirst($taskList->name ?? '') : ucfirst($filterType) }}
                </h2>
                @if (empty($filterType))
                    <div class="flex grow items-center justify-end md:justify-between">
                        <div class="">
                            @if ($taskList->user_id === Auth::user()->id)
                                <div class="flex items-center justify-center gap-2">
                                    <div class="relative">
                                        <a class="task-button info-btn hover:bg-slate-800"
                                            data-info="Edit task list"
                                            href="{{ route('task-lists.edit', ['task_list' => $taskList]) }}">
                                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>
                                    </div>
                                    <form class=""
                                        action="{{ route('task-lists.destroy', ['task_list' => $taskList]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="relative">
                                            <button class="task-button info-btn hover:bg-slate-800"
                                                data-info="Delete task list" type="submit">
                                                <svg class="size-6"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                    @if ($taskList->type == 'shared')
                                        <div class="relative">
                                            <a class="task-button info-btn hover:bg-slate-800"
                                                data-info="Invite users"
                                                href="{{ route('share.index', ['task_list' => $taskList]) }}">
                                                <svg class="size-6"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                                </svg>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="relative">
                                    <button class="task-button info-btn hover:bg-slate-800"
                                        data-info="The task list can only be edited by the owner.">
                                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                        @if ($taskList->type === 'shared')
                            <div class="hidden items-center gap-1 pr-5 md:flex">
                                @foreach ($taskList->users as $user)
                                    <div class="relative">
                                        <button class="task-button info-btn hover:bg-slate-800"
                                            data-info="{{ $user->name }}">
                                            <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/64/external-user-web-flaticons-flat-flat-icons-2.png"
                                                alt="external-user-web-flaticons-flat-flat-icons-2"
                                                width="24" height="24" />
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            </div>
            @if (empty($filterType))
                <a class="button hidden md:flex" type="button"
                    href="{{ route('tasks.create', ['task-list' => $taskList]) }}">
                    <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>

                    Add Task
                </a>
            @endif
        </div>
        <div>
            @if (!empty($taskList->description) && empty($filterType))
                {{ $taskList->description }}
            @elseif (!empty($filterType))
                @if ($filterType === 'assigned')
                    This filter view shows <strong>shared</strong> tasks that are <strong>assigned
                        to you</strong> and also <strong>private</strong> tasks that you created.
                @else
                    This filter view shows all tasks that <strong>have a due date</strong> set.
                @endif
            @else
                <i class="text-gray-400">No task list description</i>
            @endif
        </div>

        @if (empty($filterType))
            @if ($taskList->type === 'shared')
                <div class="mt-3 flex items-center gap-1 pr-5 md:hidden">
                    @foreach ($taskList->users as $user)
                        <div class="relative">
                            <button class="task-button info-btn hover:bg-slate-800"
                                data-info="{{ $user->name }}">
                                <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/64/external-user-web-flaticons-flat-flat-icons-2.png"
                                    alt="external-user-web-flaticons-flat-flat-icons-2"
                                    width="24" height="24" />
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
            <a class="button mt-3 md:hidden" type="button"
                href="{{ route('tasks.create', ['task-list' => $taskList]) }}">
                <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

                Add Task
            </a>
        @endif
    </div>
    @if (isset($tasks) && count($tasks) > 0)
        <div class="flex flex-col gap-2">
            <div class="flex flex-col gap-2">
                <h4 class="font-semibold">Open:</h4>
                <div class="h-[1px] bg-slate-400"></div>
                @if ($tasks->where('complete', false)->count() === 0)
                    <i class="text-gray-400">No closed tasks</i>
                @else
                    @foreach ($tasks->where('complete', false) as $task)
                        <x-tasksDetail :task="$task"></x-tasksDetail>
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
                        <x-tasksDetail :task="$task"></x-tasksDetail>
                    @endforeach
                @endif
            </div>
        </div>
    @else
        <i class="mt-4 text-sm text-gray-400">No tasks yet. Click "Add Task" to create your first
            one!</i>
    @endif
</div>
