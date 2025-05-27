<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {
    public function create(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password1' => ['required', 'min:8'],
            'password2' => ['required', 'same:password1']
        ], [
            'password1.required' => 'Please enter a password.',
            'password1.min' => 'Password must be at least 8 characters.',
            'password2.required' => 'Please confirm your password.',
            'password2.same' => 'Passwords do not match.',
        ]);

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password1'])
        ]);


        $taskList = TaskList::create([
            'name' => 'My tasks',
            'description' => 'Your default personal task list.',
            'type' => 'private',
            'user_id' => $user->id,
        ]);

        $user->taskLists()->attach($taskList->id);


        session(['taskList' => $taskList]);

        Auth::login($user);

        $callback = session('callback');

        if ($callback) {
            return redirect($callback);
        } else {
            return redirect()->route('task-lists.show', ['task_list' => $taskList])->with('status', 'Welcome, ' . $user->name . '!');
        }
    }

    public function show(Request $request) {
        $callback = $request->input('callback');
        if ($callback) {
            session(['callback' => $callback]);
        }
        return view('register', ['callback' => $callback]);
    }
}
