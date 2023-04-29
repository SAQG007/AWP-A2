<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;

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

Route::get('/', [VideoController::class, 'index'])->middleware('guest')->name('video.index');

Route::get('/watch/{video}', [VideoController::class, 'show'])->name('video.show');

Route::post('/search', [VideoController::class, 'search'])->name('video.search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::get('/upload-video', [VideoController::class, 'create'])->name('video.create');
    Route::post('/upload-video', [VideoController::class, 'store'])->name('video.store');

    Route::get('/edit-video/{video}', [VideoController::class, 'edit'])->name('video.edit');
    Route::post('/update-video/{video}', [VideoController::class, 'update'])->name('video.update');
    
    Route::delete('/delete/{video}', [VideoController::class, 'destroy'])->name('video.destroy');
});

require __DIR__.'/auth.php';
