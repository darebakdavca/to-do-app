<x-layout>
    <x-slot:title>
        @empty($taskList)
            Tasks
        @else
            {{ empty($filterType) ? ucfirst($taskList->name ?? '') : ucfirst($filterType) }}
        @endisset
    </x-slot:title>
    @auth
        <div class="mb-2 md:hidden">
            <button class="task-button w-fit" id="sidebar-button">
                <svg class="size-8" id="sidebar-closed-icon" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg class="hidden size-8" id="sidebar-open-icon" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="grid w-full grid-cols-1 gap-4 md:mx-auto md:grid-cols-[auto_1fr]">
            <x-sidebar :taskLists="$taskLists" :taskList="$taskList" :filterType="$filterType"></x-sidebar>
            <x-tasks :tasks="$tasks" :filterType="$filterType" :taskList="$taskList"></x-tasks>
        </div>
    @else
        <x-landing></x-landing>
    @endauth
</x-layout>
