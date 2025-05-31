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
        $taskList = session('taskList');
        return redirect(route('task-lists.show', ['task_list' => $taskList]));
    }


    /**
     * Show the form for creating a new resource.
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

        $taskList = TaskList::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'user_id' => Auth::user()->id
        ]);

        // Attach the task list to the user
        Auth::user()->taskLists()->attach($taskList->id);
        return redirect()->route('task-lists.show', ['task_list' => $taskList])->with('status', 'Task list created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskList $taskList) {
        $user = Auth::user();
        $hasAccess = $taskList->users()->where('user_id', $user->id)->exists();

        if (!$hasAccess) {
            session()->forget('taskList');
            abort(403, 'You do not have access to this task list.');
        }

        $taskLists = $user->taskLists;
        $tasks = $taskList->tasks;
        session(['taskList' => $taskList]);
        session(['previous_url' => url()->current()]);
        Log::info("Current URL: " . url()->current() . ", Previous URL: " . session('previous_url'));
        Log::info("Task List ID: " . $taskList->id . ", Task List Name: " . $taskList->name);
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
            'type' => ['required', 'in:private,shared'],
            'updated_at' => ['required']
        ]);

        if ($validated['updated_at'] != $taskList->updated_at) {
            return back()->with(['status' => 'This task list was modified by another user. Please try again.']);
        }

        $changes = [];
        if ($taskList->name !== $validated['name']) {
            $changes[] = 'name';
        }
        if ($taskList->description !== $validated['description']) {
            $changes[] = 'description';
        }
        if ($taskList->type !== $validated['type']) {
            $changes[] = 'type';
        }

        if (empty($changes)) {
            return redirect()->route('task-lists.show', ['task_list' => $taskList])
                ->with('status', 'No changes were made to the task list.');
        }

        $taskList->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);
        return redirect()->route('task-lists.show', ['task_list' => $taskList])->with('status', 'Task list updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskList $taskList) {
        Auth::user()->taskLists()->detach($taskList->id);

        $taskList->delete();
        session()->forget('taskList');
        Log::info('previous_url: ' . session('previous_url'));

        return redirect(route('home'))->with('status', 'Task list deleted successfully.');
    }
}
