<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index'])->name('home');

Route::resource('projects', ProjectController::class)->only(['index', 'store']);

Route::controller(TaskController::class)->group(function () {
    Route::post('/tasks', 'store')->name('tasks.store');
    Route::put('/tasks/{task}', 'update')->name('tasks.update');
    Route::delete('/tasks/{task}', 'destroy')->name('tasks.destroy');
    Route::post('/tasks/reorder', 'reorder')->name('tasks.reorder');
});