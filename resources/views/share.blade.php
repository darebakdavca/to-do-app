<x-layout>
    <x-slot:title>
        Share
    </x-slot:title>
    <x-container>
        <x-slot:title>Share task list <a class="a-link"
                href="{{ route('task-lists.show', ['task_list' => $taskList]) }}">{{ $taskList->name }}</a></x-slot:title>
        <div class="mx-auto flex max-w-xl flex-col gap-4 rounded-lg bg-slate-800 p-6 shadow">
            <p class="text-slate-200">
                You can share this task list with others by copying the link below. Each link is
                unique and can be used only once to access the task list. After the link is used, it
                will be invalidated for security reasons.
            </p>
            <div>

                <div class="font-semibold text-gray-300">Copy link:</div>
                <div class="flex items-center gap-2">
                    <input class="input" id="share-link" type="text" value="{{ $link }}"
                        readonly>
                    <button class="button mt-1 h-full" id="copy-link">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                        </svg>
                        Copy
                    </button>
                </div>
            </div>
            <button class="task-button mt-2 w-full bg-slate-700 py-3 text-base hover:bg-slate-600"
                id="generate-new-link">
                Generate new link
            </button>
        </div>
        @vite(['resources/js/share.js'])
    </x-container>
</x-layout>
