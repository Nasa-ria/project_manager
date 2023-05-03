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
Route::get('/', [ProjectController::class, 'index'])->name('home');
Route::get('/project/create',[ProjectController::class,'create'])->name('create');
Route::get('/project/edit/{$project}', [ProjectController::class, 'index'])->name('edit');
Route::post('/project/store', [ProjectController::class, 'store'])->name('store-form');
Route::delete('/project/delete/{$project}', [ProjectController::class, 'index'])->name('delete');

// Route::resource('task', TaskController::class);
Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
Route::post('/task/index', [TaskController::class, 'index'])->name('task.index');
Route::get('/task/edit/{$task}', [TaskController::class, 'edit'])->name('task-edit');
Route::delete('/task/delete/{$task}', [TaskController::class, 'delete'])->name('task-delete');


