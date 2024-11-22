<?php

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
});

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
    Route::get('/workers/{worker}', [WorkerController::class, 'edit'])->name('workers.edit');
    Route::patch('/workers/{worker}', [WorkerController::class, 'update'])->name('workers.update');
    //Route::resource('workers', WorkerController::class);
});

require __DIR__.'/auth.php';
