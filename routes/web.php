<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {

        //users
        Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');
        Route::post('/users', [Admin\UserController::class, 'store'])->name('users');
        Route::delete('/users/{id}', [Admin\UserController::class, 'destroy'])->name('users.destroy');
        
        Route::get('users/{id}/approve', [Admin\UserController::class, 'approve'])->name('users.approve');
        Route::get('users/{id}', [Admin\UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/{id}', [Admin\UserController::class, 'update'])->name('users.update');

        Route::get('search/', [Admin\UserController::class, 'search'])->name('users.search');
    });

    Route::prefix('user')->group(function (){

        //profile
        Route::get('/{id}/profile', [ProfileController::class, 'index'])->name('user.profile');
        Route::post('/{id}/profile', [ProfileController::class, 'store'])->name('user.profile.create');
        Route::delete('/{id}/profile', [ProfileController::class, 'destroy'])->name('user.profile.delete');
        Route::post('/{id}/profile/update', [ProfileController::class, 'update'])->name('user.profile.update');
     
    });

    
});
require __DIR__ . '/auth.php';
