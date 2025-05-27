<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskListController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        if (Auth::check()) {

            $taskList = session('taskList');
            return redirect(route('task-lists.show', ['task_list' => $taskList]));
        } else {
            return redirect(route('home'));
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {
        $type = $request->query('type');
        $taskList = $request->query('task-list');
        if ($type == 'shared' | $type == 'private') {
            return view('newTaskList', ['type' => $type, 'taskList' => $taskList]);
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

        $taskList = TaskList::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'user_id' => Auth::user()->id
        ]);

        // Attach the task list to the user
        Auth::user()->taskLists()->attach($taskList->id);
        return redirect()->route('task-lists.show', ['task_list' => $taskList]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskList $taskList) {
        $user = Auth::user();
        $taskLists = $user->ownedTaskLists;
        // Log the task lists
        Log::info('TaskLists:', ['taskLists' => $taskLists->toArray()]);
        $tasks = $taskList->tasks;
        session(['taskList' => $taskList->id]);
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
        return view('editTaskList', ['taskList' => $taskList]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskList $taskList) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'type' => ['required', 'in:private,shared']
        ]);

        $taskList->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);
        return redirect()->route('task-lists.show', ['task_list' => $taskList]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskList $taskList) {
        Auth::user()->taskLists()->detach($taskList->id);

        $taskList->delete();
        session()->forget('taskList');

        return redirect()->route('home')->with('status', 'Task list deleted successfully.');
    }
}
