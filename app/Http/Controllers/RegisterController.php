<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {
    public function register(Request $request): RedirectResponse {
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
            'description' => 'Default personal task list',
            'type' => 'private',
            'user_id' => $user->id,
        ]);

        Auth::login($user);

        return redirect()->intended('/task-list/' . $taskList->id);
    }
}
