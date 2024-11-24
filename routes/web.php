<?php

use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkerController;
use App\Models\Position;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        "roomNumber" => Room::all()->count(),
        "userNumber" => User::all()->count()
    ]);
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/workers', [WorkerController::class, 'index'])->name('workers');

    Route::delete('/workers/{worker}', [WorkerController::class, 'destroy'])->name('workers.destroy');

    Route::get('/workers/create', [WorkerController::class, 'create'])->name('workers.create');
    Route::post('/workers', [WorkerController::class, 'store'])->name('workers.store');
    Route::get('/workers/{worker}', [WorkerController::class, 'edit'])->name('workers.edit');
    Route::patch('/workers/{worker}', [WorkerController::class, 'update'])->name('workers.update');
    Route::get('/workers/{worker}/entries', [WorkerController::class, 'entries']) -> name('workers.entries');
});

Route::middleware('auth')->group(function() {
    Route::get('/positions', [PositionController::class, 'index'])->name('positions');
    Route::get('/positions/create', [PositionController::class, 'create'])->name('positions.create');
    Route::get('/positions/{position}/workers', [PositionController::class, 'workers'])->where('position', '[0-9]+')->name('positions.workers');
    Route::delete('/positions/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');
    Route::get('/positions/{position}', [PositionController::class, 'edit'])->name('positions.edit');
    Route::patch('/positions/{position}', [PositionController::class, 'update'])->name('positions.update');
    Route::post('/positions', [PositionController::class, 'store'])->name('positions.store');
});

require __DIR__.'/auth.php';
