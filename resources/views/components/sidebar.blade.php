<div class="w-max-52 flex w-60 flex-col gap-4">
    <div class="rounded-lg bg-slate-950 p-3">
        <div class="mb-2 flex items-center justify-between">
            <h3 class="text-lg font-semibold">Private</h3>
            <a class="task-button" href="{{ route('task-lists.create', ['type' => 'private']) }}">
                <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

            </a>
        </div>
        @foreach ($taskLists as $myTaskList)
            @if ($myTaskList->type == 'private')
                <div
                    class="{{ $myTaskList->id == $taskList->id ? 'border-white' : '' }} cursor-pointer border-r-2 border-gray-700 bg-slate-900">
                    <a class="block px-3 py-1.5 hover:bg-slate-800"
                        href="{{ route('task-lists.show', ['task_list' => $myTaskList]) }}">{{ $myTaskList->name }}</a>
                </div>
            @endif
        @endforeach
    </div>
    <div class="h-[1px] bg-slate-400"></div>
    <div class="rounded-lg bg-slate-950 p-3">
        <div class="mb-2 flex items-center justify-between">
            <h3 class="text-lg font-semibold">Shared</h3>
            <a class="task-button" href="{{ route('task-lists.create', ['type' => 'shared']) }}">
                <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

            </a>
        </div>
        @foreach ($taskLists as $myTaskList)
            @if ($myTaskList->type == 'shared')
                <div
                    class="{{ $myTaskList->id == $taskList->id ? 'border-white' : '' }} cursor-pointer border-r-2 border-gray-700 bg-slate-900">
                    <a class="block px-3 py-1.5 hover:bg-slate-800"
                        href="{{ route('task-lists.show', ['task_list' => $myTaskList]) }}">{{ $myTaskList->name }}</a>
                </div>
            @endif
        @endforeach
    </div>
</div>
