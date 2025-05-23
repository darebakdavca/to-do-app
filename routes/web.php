<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    if (Auth::check()) {
        // TODO: check last active taskList from database
        return redirect('/task-lists');
    } else {
        return view('home');
    }
});

Route::resource('tasks', TaskController::class);
Route::resource('task-lists', TaskListController::class);

use Illuminate\Support\Facades\DB;


// Route::get('/user/{id}', function (string $id) {
//     return 'User ' . $id;
// })->whereNumber('id');

// Route::get('/user/{name?}', function (?string $name = 'John') {
//     return $name;
// });

// Route::get('/user/profile', function () {
//     return 'hello';
// })->name('profile');

Route::fallback(function () {
    return view('404');
});



Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::get('/logout', [LogoutController::class, 'logout']);

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [RegisterController::class, 'register']);
