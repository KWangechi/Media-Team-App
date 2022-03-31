<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaveController;


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
    Route::prefix('admin')->middleware(['isAdmin'])->group(function () {

        //users
        Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');
        Route::post('/users', [Admin\UserController::class, 'store'])->name('users');
        Route::delete('/users/{id}', [Admin\UserController::class, 'destroy'])->name('users.destroy');

        Route::get('users/{id}/approve', [Admin\UserController::class, 'approve'])->name('users.approve');
        Route::get('users/{id}', [Admin\UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/{id}', [Admin\UserController::class, 'update'])->name('users.update');

        Route::get('search/', [Admin\UserController::class, 'search'])->name('users.search');

        //leaves
        Route::get('/{id}/leave', [Admin\LeaveController::class, 'show'])->name('admin.leave.show');
        Route::get('/{id}/leaves', [Admin\LeaveController::class, 'index'])->name('admin.users.leaves.index');
        Route::post('/{id}/leave', [Admin\LeaveController::class, 'store'])->name('admin.leave.create');

        Route::get('/leaves/{id}/approve', [Admin\UserController::class, 'approveLeave'])->name('admin.users.leaves.approve');
        Route::get('/leaves/{id}/reject', [Admin\UserController::class, 'rejectLeave'])->name('admin.users.leaves.reject');

    });

    //User Profile
    Route::prefix('user')->group(function () {

        //profile
        Route::get('/{id}/profile', [ProfileController::class, 'index'])->name('user.profile');
        Route::post('/{id}/profile', [ProfileController::class, 'store'])->name('user.profile.create');
        Route::post('/{user_id}/profile/{id}', [ProfileController::class, 'update'])->name('user.profile.update');
        Route::delete('/{user_id}/profile/{id}', [ProfileController::class, 'destroy'])->name('user.profile.delete');

        //Leaves
        Route::get('/{id}/leaves', [LeaveController::class, 'index'])->name('user.leaves.index');
        Route::post('/{id}/leave', [LeaveController::class, 'store'])->name('user.leave.create');


        //Duty Log


    });
});
require __DIR__ . '/auth.php';
