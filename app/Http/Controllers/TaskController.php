<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {
        $taskList = $request->query('task-list');
        $user = Auth::user();
        $taskLists = TaskList::all()->where('user_id', $user->id);
        return view('new', ['taskLists' => $taskLists, 'myTaskList' => $taskList]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'due_date' => ['nullable', 'date'],
            'task_list_id' => ['required', 'exists:task_lists,id']
        ]);
        $task = Task::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
            'task_list_id' => $validated['task_list_id'],
        ]);
        $taskList = $task->taskList;

        return redirect()->route('task-lists.show', ['task_list' => $taskList]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task) {
        $taskLists = TaskList::all();
        return view('edit', ['task' => $task, 'taskLists' => $taskLists]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'due_date' => ['nullable', 'date'],
            'task_list_id' => ['required', 'exists:task_lists,id']
        ]);
        $task->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
            'task_list_id' => $validated['task_list_id']
        ]);

        $taskList = $task->taskList;

        return redirect()->route('task-lists.show', ['task_list' => $taskList]);
    }

    public function complete(Task $task) {
        $task->complete = !$task->complete; // Toggle complete status
        $task->save();

        return back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task) {
        $taskList = $task->taskList;
        $task->delete();
        return redirect()->route('task-lists.show', ['task_list' => $taskList]);
    }
}
