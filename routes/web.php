<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ContributionController;
use App\Http\Controllers\Admin\DutyController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaveController;
use App\Models\Contribution;

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
        Route::get('/users', [Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::post('/users', [Admin\UserController::class, 'store'])->name('admin.users.create');
        Route::delete('/users/{id}', [Admin\UserController::class, 'destroy'])->name('admin.users.destroy');

        Route::get('users/{id}/approve', [Admin\UserController::class, 'approve'])->name('admin.users.approve');
        Route::get('users/{id}', [Admin\UserController::class, 'edit'])->name('admin.users.edit');
        Route::post('/users/{id}', [Admin\UserController::class, 'update'])->name('admin.users.update');

        Route::get('search/', [Admin\UserController::class, 'search'])->name('admin.users.search');

        //leaves
        Route::get('/{id}/leaves', [Admin\LeaveController::class, 'index'])->name('admin.leaves.index');
        Route::get('/{id}/leave', [Admin\LeaveController::class, 'show'])->name('admin.leave.show');
        Route::post('/{id}/leave', [Admin\LeaveController::class, 'store'])->name('admin.leave.create');
        Route::get('/{id}/my_leave', [Admin\LeaveController::class, 'edit'])->name('admin.leave.edit');
        Route::patch('/{id}/leave', [Admin\LeaveController::class, 'update'])->name('admin.leave.update');
        Route::delete('/{id}/delete_leave', [Admin\LeaveController::class, 'destroy'])->name('admin.leave.destroy');


        Route::post('/leave/{user_id}/approve/{id}', [Admin\LeaveController::class, 'approveLeaveRequest'])->name('admin.leaves.approve');
        Route::post('/leave/{user_id}/reject/{id}', [Admin\LeaveController::class, 'rejectLeaveRequest'])->name('admin.leaves.reject');

        //Duty Roster
        Route::get('/duty', [DutyController::class, 'index'])->name('admin.duty.index');
        Route::post('/duty', [DutyController::class, 'store'])->name('admin.duty.create');
        Route::get('/duty/{id}', [DutyController::class, 'edit'])->name('admin.duty.edit');
        Route::patch('/duty/{id}', [DutyController::class, 'update'])->name('admin.duty.update');
        Route::delete('/duty/{id}', [DutyController::class, 'destroy'])->name('admin.duty.delete');

        //Contributions
        Route::get('/contributions', [ContributionController::class, 'index'])->name('admin.users.contributions');
        Route::post('/contributions', [ContributionController::class, 'store'])->name('admin.users.contributions.create');
        // Route::patch('/contributions/{id}', ContributionController::class, 'update')->name('admin.users.contributions.update');
        // Route::delete('/contributions/{id}', ContributionController::class, 'destroy')->name('admin.users.contributions.delete');
        Route::get('/contributions/search', [ContributionController::class, 'search'])->name('admin.users.contributions.search');
        Route::get('/contributions/{id}', [ContributionController::class, 'edit'])->name('admin.users.contributions.edit');
        Route::patch('/contributions/{id}', [ContributionController::class, 'update'])->name('admin.users.contributions.update');
        Route::delete('/contributions/{id}', [ContributionController::class, 'destroy'])->name('admin.users.contributions.delete');


        //announcements
        Route::get('/announcements', [AnnouncementController::class, 'index'])->name('admin.announcements');

    });

    //User Routes
    Route::prefix('user')->group(function () {

        //profile
        Route::get('/{id}/profile', [ProfileController::class, 'index'])->name('user.profile');
        Route::post('/{id}/profile', [ProfileController::class, 'store'])->name('user.profile.create');
        Route::post('/{user_id}/profile/{id}', [ProfileController::class, 'update'])->name('user.profile.update');
        Route::delete('/{user_id}/profile/{id}', [ProfileController::class, 'destroy'])->name('user.profile.delete');

        //Leaves
        Route::get('/{id}/leaves', [LeaveController::class, 'index'])->name('user.leaves.index');
        Route::post('/{id}/leave', [LeaveController::class, 'store'])->name('user.leave.create');
        Route::get('/{user_id}/leave/{id}', [LeaveController::class, 'edit'])->name('user.leave.edit');
        Route::patch('/{user_id}/leave/{id}', [LeaveController::class, 'update'])->name('user.leave.update');
        Route::delete('/{user_id}/leave/{id}', [LeaveController::class, 'destroy'])->name('user.leave.delete');

        //Duty Roster
        Route::get('/{id}/duty', [DutyController::class, 'index'])->name('user.duty.index');
    });
});
require __DIR__ . '/auth.php';
