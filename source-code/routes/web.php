<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events');
Route::get('/create', [App\Http\Controllers\EventController::class, 'create'])->name('create');
Route::get('/edit/{hash_event_id}', [App\Http\Controllers\EventController::class, 'create'])->name('edit');
