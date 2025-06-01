<?php

namespace App\Http\Controllers;

use App\Mail\TaskListInvite;
use App\Models\Invitation;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ShareController extends Controller {

    public function show(TaskList $taskList) {
        $token = Str::random(40);
        $link = route('share.accept', ['token' => $token]);
        Invitation::create([
            'task_list_id' => $taskList->id,
            'token' => $token
        ]);

        return view('share', ['taskList' => $taskList, 'link' => $link, 'token' => $token]);
    }

    public function send(Request $request) {
        $validated = $request->validate(
            [
                'link' => ['required', 'active_url'],
                'token' => ['required', 'alpha_num']
            ]
        );
        $user = Auth::user();
        $taskListId = session('taskList');
        $taskList = TaskList::findOrFail($taskListId);
        $link = $validated['link'];
        $token = $validated['token'];

        Mail::to($validated['email'])->send(new TaskListInvite($user, $taskList, $link));
        return redirect(route('task-lists.show', ['task_list' => $taskList]))
            ->with('status', 'Invitation sent to user ' . $validated['email'] . '.');
    }


    public function accept(string $token) {
        $invitation = Invitation::where('token', $token)->first();
        if (!$invitation) {
            $statusMesage = 'Invalid or expired invitation.';
        }
        if ($invitation->accepted_at) {
            $statusMesage = 'Invitation already accepted.';
        }
        $user = Auth::user();
        if (!$user) {
            session('callback', route('share.accept', ['token' => $token]));
            return redirect()
                ->route('login.index', ['callback' => route('share.accept', ['token' => $token])])
                ->with('status', 'Please log in to accept the invitation.');
        }

        $taskList = TaskList::findOrFail($invitation->task_list_id);
        if (!$taskList->users()->where('user_id', $user->id)->exists()) {
            $taskList->users()->attach($user->id);
            $invitation->accepted_at = now();
            $invitation->save();
            $statusMesage = 'You have successfully joined the shared task list!';
        } else {
            $statusMesage = 'You are already a member of this task list.';
        }
        return redirect()->route('task-lists.show', ['task_list' => $taskList])->with('status', $statusMesage);
    }
}
