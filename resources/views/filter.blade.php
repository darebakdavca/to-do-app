<x-layout>
    <x-slot:title>
        @empty($taskList)
            Tasks
        @else
            {{ empty($filterType) ? ucfirst($taskList->name ?? '') : ucfirst($filterType) }}
        @endisset
    </x-slot:title>
    @auth
        <div class="grid w-full grid-cols-[auto_1fr] gap-4 p-5 sm:mx-auto">
            <x-sidebar :taskLists="$taskLists" :taskList="$taskList" :filterType="$filterType"></x-sidebar>
            <x-tasks :tasks="$tasks" :filterType="$filterType" :taskList="$taskList"></x-tasks>
        </div>
    @else
        <x-landing></x-landing>
    @endauth
</x-layout>
