<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'task_id' => ['required', 'exists:tasks,id']
        ]);
        Comment::create([
            'content' => $validated['content'],
            'task_id' => $validated['task_id'],
            'user_id' => Auth::id(),
        ]);
        $taskList = session('taskList');
        return redirect()->route('task-lists.show', ['task_list' => $taskList])->with('status', 'Comment added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment) {
        return view('editComment', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment) {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'updated_at' => ['required']
        ]);

        if ($validated['updated_at'] != $comment->updated_at) {
            return back()->with(['status' => 'This comment was modified by another user. Please try again.']);
        }

        $changes = [];
        if ($comment->content !== $validated['content']) {
            $changes[] = 'content';
        }

        if (empty($changes)) {
            return redirect()->route('task-lists.show', ['task_list' => session('taskList')])->with('status', 'No changes were made to the comment.');
        }

        $comment->update([
            'content' => $validated['content']
        ]);
        return redirect()->route('task-lists.show', ['task_list' => session('taskList')])->with('status', 'Comment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment) {
        $comment->delete();
        return redirect()->route('task-lists.show', ['task_list' => session('taskList')])->with('status', 'Comment deleted successfully.');
    }
}
