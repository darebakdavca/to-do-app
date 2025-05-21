<x-layout>
    <x-slot:title>
        Edit task
    </x-slot:title>
    <div>Editing task {{ $task }} in task list {{ $taskList }}</div>
    {{ $errors }}
    @foreach ($users as $user)
        <p>{{ $user->name }}</p>
    @endforeach
</x-layout>
