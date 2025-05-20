<div class="bg-slate-700 p-5 rounded-lg flex flex-col gap-2">
    <h2 class="text-2xl font-semibold mb-2">{{ ucfirst($activeTaskList ?? '')}} Tasks</h2>
    <div></div>
    @foreach ($tasks as $task)
    <div class="bg-slate-800 rounded-md hover:bg-slate-900">
        <a href="/tasks/{{ $activeTaskList.'/'.$task.'/edit' }}" class="flex gap-4 items-center p-3">
            <form method="POST" action="/tasks/{{ $activeTaskList . '/' . $task }}/complete" class="flex items-center">
                @csrf
                <button type="submit" class="rounded-full size-6 border-2 border-blue-500 cursor-pointer bg-transparent hover:bg-blue-500 transition"></button>
            </form>
            <p>
                {{ $task }}
            </p>
        </a>
    </div>
    @endforeach
</div>
