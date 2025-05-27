<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller {
    public function authenticate(Request $request): RedirectResponse {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => 'required']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $taskList = $user->taskLists()->first();
            $request->session()->regenerate();
            $callback = $request->query('callback');
            Log::info('User logged in', ['user_id' => $user->id, 'email' => $user->email, 'task_list_id' => $taskList ? $taskList->id : null]);
            Log::info('Callback URL', ['callback' => $callback]);
            if ($callback) {
                return redirect($callback);
            }
            return redirect()->route('task-lists.show', ['task_list' => $taskList])->with('status', 'Welcome, ' . $user->name . '!');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    public function show() {
        return view('login');
    }
}
