<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function authenticate(Request $request): RedirectResponse {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => 'required']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $taskList = $user->taskLists()->first();
            $request->session()->regenerate();
            return redirect()->route('task-lists.show', ['task_list' => $taskList]);
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }
}
