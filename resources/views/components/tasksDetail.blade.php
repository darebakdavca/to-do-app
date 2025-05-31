<div class="mt-1 overflow-x-hidden overflow-y-clip rounded-md">
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
                        <svg class="stroke-3 size-4" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m4.5 12.75 6 6 9-13.5" />
                        </svg>

                    </button>
                @endif
            </form>
            <p>
                {{ $task->name }}
            </p>
        </div>
        <div class="task-actions hidden px-1.5" data-task-id="{{ $task->id }}">
            <div class="flex items-center justify-end gap-2">
                <a class="task-button edit-task-button" href="{{ route('tasks.edit', $task) }}">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Edit
                </a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="task-button" type="submit">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="task-detail hidden bg-slate-800 p-3" data-task-id="{{ $task->id }}">
        <div class="ml-4 flex flex-col gap-2">
            <div class="flex items-start gap-4">
                <div class="mt-0.5">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
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

                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>

                @if ($task->due_date)
                    {{ $task->due_date }}
                @else
                    <i class="text-gray-400">No due date</i>
                @endif
            </div>
            <div class="relative flex items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    Assigned to:
                    <div class="flex gap-2">
                        @forelse ($task->users as $assignee)
                            <div class="relative">
                                <button class="task-button info-btn" data-position="top"
                                    data-info="{{ $assignee->name }}">
                                    <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/64/external-user-web-flaticons-flat-flat-icons-2.png"
                                        alt="external-user-web-flaticons-flat-flat-icons-2"
                                        width="24" height="24" />
                                </button>
                            </div>
                        @empty
                            <i class="text-gray-400">No users assigned</i>
                        @endforelse
                    </div>
                </div>
                <div class="flex flex-col">
                    <button
                        class="comment-detail-button flex w-52 cursor-pointer items-center justify-center gap-2 rounded bg-slate-600 px-3 py-1.5 hover:bg-slate-500"
                        data-task-id="{{ $task->id }}">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>
                        <span data-task-id="{{ $task->id }}">
                            Show comments
                        </span>
                    </button>

                </div>
            </div>
            <div class="comment-detail hidden w-full" data-task-id="{{ $task->id }}">
                <div class="mb-3 h-[1px] bg-slate-400"></div>
                @if ($task->comments->count() > 0)

                    @foreach ($task->comments->sortByDesc('created_at') as $comment)
                        <div class="mb-3 ml-4 flex grow-0 flex-col justify-end">

                            <div
                                class="group relative flex grow-0 items-center justify-between gap-2 rounded bg-slate-900 p-2">
                                <span class="p-1 text-white">{{ $comment->content }}</span>
                                @if ($comment->user->id == Auth::user()->id)
                                    <div class="hidden items-center gap-2 group-hover:flex">
                                        <a class="task-button"
                                            href="{{ route('comments.edit', $comment) }}">
                                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('comments.destroy', $comment) }}"
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
                                @endif
                                <div
                                    class="absolute -left-1.5 bottom-0 h-0 w-0 border-b-[8px] border-l-[10px] border-r-0 border-t-0 border-b-slate-900 border-l-transparent">
                                </div>
                            </div>
                            <div class="mt-1 flex items-center justify-between gap-2">
                                <div class="flex items-center text-xs">
                                    <span class="text-slate-400">
                                        {{ $comment->created_at->setTimezone(config('app.timezone'))->locale(app()->getLocale())->isoFormat('DD. MMMM YYYY HH:mm') }}
                                    </span>
                                    @if ($comment->created_at != $comment->updated_at)
                                        <span class="text-slate-400">
                                            ,
                                        </span>
                                        <div class="relative pl-2">
                                            <button
                                                class="info-btn cursor-pointer hover:text-blue-500"
                                                data-info="Edited at {{ $comment->updated_at->setTimezone(config('app.timezone'))->locale(app()->getLocale())->isoFormat('DD. MMMM YYYY HH:mm') }}">
                                                Edited </button>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="text-end text-xs">{{ $comment->user->name }}</span>
                                    <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/64/external-user-web-flaticons-flat-flat-icons-2.png"
                                        alt="external-user-web-flaticons-flat-flat-icons-2"
                                        width="16" height="16" />
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex items-center gap-4">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>

                        <span class="text-gray-400">No comments</span>
                    </div>
                @endif
                <form class="mt-4 flex gap-2" action="{{ route('comments.store') }}"
                    method="post">
                    @csrf
                    <input
                        class="@error('content') ring-red-500 @else ring-transparent @enderror block grow rounded bg-slate-600 px-3 py-1 outline-none ring-2 focus:ring-blue-500"
                        name="content" type="text" placeholder="Type something">
                    <button class="button py-1.5">
                        Send
                    </button>
                    <input name="task_id" type="text" value="{{ $task->id }}" hidden>
                </form>
                @if ($errors->has('content'))
                    <div class="mt-1 text-sm text-red-500">
                        {{ $errors->first('content') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
