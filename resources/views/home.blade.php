<x-layout>
    <x-slot:title>
        Tasks
    </x-slot:title>
    @auth
        <div class="grid w-full grid-cols-[auto_1fr] gap-4 p-5 sm:mx-auto">
            <x-sidebar :taskLists="$taskLists" :taskList="$taskList"></x-sidebar>
            <x-tasks :tasks="$tasks" :taskList="$taskList"></x-tasks>
        </div>
    @else
        <x-landing></x-landing>
    @endauth
</x-layout>
