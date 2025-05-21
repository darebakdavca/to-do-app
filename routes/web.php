<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
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

Route::view('/', 'home', [
    'tasks' => ['clean', 'brush', 'replace'],
    'taskLists' => ['personal', 'work', 'family'],
    'activeTaskList' => 'work'
]);

Route::get('/tasks/{taskList}', function (string $taskList) {
    return view('home', [
        'tasks' => ['clean', 'brush', 'replace'],
        'taskLists' => ['personal', 'work', 'family'],
        'activeTaskList' => $taskList
    ]);
})->name('tasks.show');

use Illuminate\Support\Facades\DB;

Route::get('/tasks/{taskList}/{task}/edit}', function (string $taskList, string $task) {
    $users = DB::select('select * from users;');
    return view('edit', ['task' => $task, 'taskList' => $taskList, 'users' => $users]);
})->name('task.edit');


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

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/logout', [LogoutController::class, 'logout']);

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [RegisterController::class, 'register']);
