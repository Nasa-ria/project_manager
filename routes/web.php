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
Route::get('/project/SingleProject/{id}',[ProjectController::class,'SingleProject'])->name('SingleProject');
Route::get('/project/edit/{id}', [ProjectController::class, 'edit'])->name('edit');
Route::post('/project/update/{id}', [ProjectController::class, 'update'])->name('update');
Route::post('/project/store', [ProjectController::class, 'store'])->name('store-form');
Route::delete('/project/delete/{id}', [ProjectController::class, 'destroy'])->name('delete');
Route::get('/search/{term}', [ProjectController::class, 'search'])->name('search');

// Route::resource('task', TaskController::class);
Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
Route::post('/task/index', [TaskController::class, 'index'])->name('task.index');
Route::get('/task/edit/{id}', [TaskController::class, 'edit'])->name('task-edit');
Route::post('/task/update/{id}', [TaskController::class, 'Update'])->name('task-update');
Route::delete('/task/delete/{id}', [TaskController::class, 'destroy'])->name('task-delete');


