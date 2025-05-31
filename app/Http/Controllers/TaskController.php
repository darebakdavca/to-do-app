<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $taskLists = $user->taskLists;
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

        return redirect()->route('task-lists.show', ['task_list' => $taskList])->with('status', 'Task created successfully.');
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
            'task_list_id' => ['required', 'exists:task_lists,id'],
            'updated_at' => ['required']
        ]);

        if ($validated['updated_at'] != $task->updated_at) {
            return back()->with(['status' => 'This task was modified by another user. Please entry again your changes.']);
        }

        $changes = [];
        if ($task->name !== $validated['name']) {
            $changes[] = 'name';
        }
        if ($task->description !== $validated['description']) {
            $changes[] = 'description';
        }
        if ($task->due_date !== $validated['due_date']) {
            $changes[] = 'due_date';
        }
        if ($task->task_list_id !== $validated['task_list_id']) {
            $changes[] = 'task_list_id';
        }

        $oldAssignees = $task->users()->pluck('users.id')->sort()->values()->toArray();
        $newAssignees = collect($request->input('assignees', []))->map(fn($id) => (int)$id)->sort()->values()->toArray();
        if ($oldAssignees !== $newAssignees) {
            $changes[] = 'assignees';
        }

        if (empty($changes)) {
            return redirect()->route('task-lists.show', ['task_list' => session('taskList')])->with('status', 'No changes were made to the task.');
        }

        $task->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
            'task_list_id' => $validated['task_list_id']
        ]);

        $assignees = $request->input('assignees', []);
        $task->users()->sync($assignees);
        $task->touch();

        $taskList = $task->taskList;

        return redirect()->route('task-lists.show', ['task_list' => $taskList])->with('status', 'Task updated successfully.');
    }

    public function complete(Task $task) {
        $task->complete = !$task->complete;
        $task->save();

        return back()->with('status', 'Task status updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task) {
        $task->delete();
        return redirect()->route('task-lists.show', ['task_list' => session('taskList')])->with('status', 'Task deleted successfully.');
    }
}
