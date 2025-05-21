<x-layout>
    <x-slot:title>
        Tasks
    </x-slot:title>
    <div class="grid w-full grid-cols-[auto_1fr] gap-4 p-5 sm:mx-auto">
        @auth
            <x-sidebar :taskLists="$taskLists" :activeTaskList="$activeTaskList"></x-sidebar>
            <x-tasks :tasks="$tasks" :activeTaskList="$activeTaskList"></x-tasks>
        @endauth
    </div>
</x-layout>
