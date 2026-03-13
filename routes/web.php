<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// This replaces the default welcome view and makes the task list your homepage
Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

// The rest of your CRUD routes
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');