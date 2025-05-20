<div class="w-max-52 w-52">
    @foreach ($taskLists as $taskList)
    <div class="bg-slate-900 cursor-pointer border-r-2 border-gray-700 {{ $taskList == $activeTaskList ? 'border-white' : '' }}">
        <a class="block px-3 py-1.5 hover:bg-slate-800" href="/tasks/{{ $taskList }}">{{ $taskList }}</a>
    </div>
    @endforeach
</div>
