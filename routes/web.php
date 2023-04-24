<?php

use App\Http\Controllers\TaskController;
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
Route::get('task/index','TaskController@index')->name('index');
Route::post('task/store','TaskController@store')->name('store');
Route::patch('task/update','TaskController@update')->name('upate');
Route::delete('task/delete','TaskController@delete')->name('delete');
Route::get('task/edit','TaskController@edit')->name('edit');