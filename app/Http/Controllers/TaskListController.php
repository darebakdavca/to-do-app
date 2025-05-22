<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;

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
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
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
