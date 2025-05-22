<div class="w-max-52 w-52">
    @foreach ($taskLists as $myTaskList)
        <div
            class="{{ $myTaskList->id == $taskList->id ? 'border-white' : '' }} cursor-pointer border-r-2 border-gray-700 bg-slate-900">
            <a class="block px-3 py-1.5 hover:bg-slate-800"
                href="/tasks/{{ $myTaskList->id }}">{{ $myTaskList->name }}</a>
        </div>
    @endforeach
</div>
