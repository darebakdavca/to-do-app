<x-layout>
    <x-slot:title>
        Tasks
    </x-slot:title>
    <div class="p-5 w-full grid grid-cols-[auto_1fr] sm:mx-auto gap-4">
        <x-sidebar :taskLists="$taskLists" :activeTaskList="$activeTaskList"></x-sidebar>
        <x-tasks :tasks="$tasks" :activeTaskList="$activeTaskList"></x-tasks>
    </div>
</x-layout>
