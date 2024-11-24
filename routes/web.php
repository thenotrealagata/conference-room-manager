<?php

use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
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
    Route::get('/profile/permissions', [ProfileController::class, 'permissions'])->name('profile.permissions');
    Route::get('/profile/entries', [ProfileController::class, 'entries'])->name('profile.entries');
});

Route::middleware('auth')->group(function () {
    Route::resource('workers', WorkerController::class);
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

Route::middleware('auth')->group(function() {
    Route::resource('rooms', RoomController::class);
    Route::get('/rooms/{room}/entries', [RoomController::class, 'entries'])->where('room', '[0-9]+')->name('rooms.entries');
});

require __DIR__.'/auth.php';
