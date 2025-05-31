<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        $taskList = session('taskList');
        if (!$taskList) {
            $taskList = Auth::user()->taskLists()->where('type', 'private')->first();
            if (!$taskList) {
                $taskList = Auth::user()->taskLists()->where('type', 'shared')->first();
            }
            session(['taskList' => $taskList]);
        }
        return redirect(route('task-lists.show', ['task_list' => $taskList]));
    } else {
        return view('home');
    }
})->name('home');

Route::get('/share/{task_list}', [ShareController::class, 'show'])->name('share.index');
Route::get('/share/accept/{token}', [ShareController::class, 'accept'])->name('share.accept');
Route::post('/share/send', [ShareController::class, 'send'])->name('share.send');

Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
Route::get('/tasks/{filterType}', [TaskController::class, 'filter'])->where('filterType', 'assigned|planned')->name('tasks.filter');
Route::resource('tasks', TaskController::class);

Route::resource('task-lists', TaskListController::class);

Route::resource('comments', CommentController::class);

Route::get('/login', [LoginController::class, 'show'])->name('login.index');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::get('/logout', [LogoutController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'show'])->name('register.index');
Route::post('/register', [RegisterController::class, 'create'])->name('register.create');

Route::fallback(function () {
    return view('errors.404');
});
