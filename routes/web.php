<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

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
Route::get('/', [ProjectController::class, 'index'])->name('home');

Route::get('/project/edit/{$project}', [ProjectController::class, 'index'])->name('edit');
Route::post('/project/create', [ProjectController::class, 'index'])->name('create');
Route::delete('/project/delete/{$project}', [ProjectController::class, 'index'])->name('delete');

Route::resource('task', TaskController::class);
Route::get('/project/create', [ProjectController::class, 'create'])->name('create');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
