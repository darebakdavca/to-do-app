<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;
use App\Enums\TaskListType;
use Illuminate\Support\Facades\Auth;

class TaskListController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $taskLists = TaskList::all();
        $taskList = $taskLists->first();
        $tasks = $taskList ? $taskList->tasks : collect();
        return view('home', [
            'taskList' => $taskList,
            'taskLists' => $taskLists,
            'tasks' => $tasks
        ]);
    }


    /**
     * Show the form for creating a new resource.
     * @param 'private'|'shared' $type
     */
    public function create(Request $request) {
        $type = $request->query('type');
        if ($type == 'shared' | $type == 'private') {
            return view('newTaskList', ['type' => $type]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'type' => ['required', 'in:private,shared']
        ]);

        TaskList::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'user_id' => Auth::user()->id
        ]);
        return redirect()->route('task-lists.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskList $taskList) {
        $taskLists = TaskList::all();
        $tasks = $taskList->tasks;
        return view('home', [
            'taskList' => $taskList,
            'taskLists' => $taskLists,
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskList $taskList) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskList $taskList) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskList $taskList) {
        //
    }
}
