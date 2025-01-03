<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ContributionController;
use App\Http\Controllers\Admin\DutyController;
use App\Http\Controllers\Admin\DutyMemberDetailsController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\User\SundayReportController;
use App\Http\Controllers\User\SundaySummaryController;

use App\Models\Announcement;
use App\Models\Contribution;
use App\Models\DutyMemberDetails;
use App\Models\Role;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

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
    return view('dashboard');
})->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware(['isAdmin'])->group(function () {

        //users information
        Route::get('/users', [Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::post('/users', [Admin\UserController::class, 'store'])->name('admin.users.create');
        Route::get('users/{id}', [Admin\UserController::class, 'edit'])->name('admin.users.edit');
        Route::patch('/users/{id}', [Admin\UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{id}', [Admin\UserController::class, 'destroy'])->name('admin.users.delete');


        Route::get('users/{id}/approve', [Admin\UserController::class, 'approve'])->name('admin.users.approve');

        Route::get('search/', [Admin\UserController::class, 'search'])->name('admin.users.search');

        // admin profile
        //profile
        Route::get('/{id}/profile', [ProfileController::class, 'index'])->name('admin.profile');
        Route::post('/{id}/profile', [ProfileController::class, 'store'])->name('admin.profile.create');
        Route::patch('/{user_id}/profile/{id}', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::delete('/{user_id}/profile/{id}', [ProfileController::class, 'destroy'])->name('admin.profile.delete');

        //leaves
        Route::get('/leaves', [Admin\LeaveController::class, 'index'])->name('admin.leaves.index');
        Route::get('/{id}/leave', [Admin\LeaveController::class, 'show'])->name('admin.leave.show');
        Route::post('/{id}/leave', [Admin\LeaveController::class, 'store'])->name('admin.leave.create');
        Route::get('/{id}/edit-leave', [Admin\LeaveController::class, 'edit'])->name('admin.leave.edit');
        Route::patch('/{user_id}/leave/{leave_id}', [Admin\LeaveController::class, 'update'])->name('admin.leave.update');
        Route::delete('/{id}/delete-leave/{leave_id}', [Admin\LeaveController::class, 'delete'])->name('admin.leave.delete');


        Route::get('/leave/{user_id}/approve/{id}', [Admin\LeaveController::class, 'approveLeaveRequest'])->name('admin.leaves.approve');
        Route::get('/leave/{user_id}/reject/{id}', [Admin\LeaveController::class, 'rejectLeaveRequest'])->name('admin.leaves.reject');

        //Duty Roster
        Route::get('/duty', [DutyController::class, 'index'])->name('admin.duty.index');
        Route::post('/duty', [DutyController::class, 'store'])->name('admin.duty.create');
        Route::get('/duty/{id}', [DutyController::class, 'edit'])->name('admin.duty.roster.edit');
        Route::patch('/duty/{id}', [DutyController::class, 'update'])->name('admin.duty.roster.update');
        Route::delete('/duty/{id}', [DutyController::class, 'destroy'])->name('admin.duty.roster.delete');


        //duty roster personel details
        Route::post('createDutyPersonelDetails/{id}', [DutyMemberDetailsController::class, 'store'])
            ->name('admin.duty.createDutyPersonelDetails');

        Route::get('editDutyPersonelDetails/{duty_id}', [DutyMemberDetailsController::class, 'edit'])
            ->name('admin.duty.editDutyPersonelDetails');

        Route::patch('updateDutyPersonelDetails/{id}', [DutyMemberDetailsController::class, 'update'])
            ->name('admin.duty.updateDutyPersonelDetails');

        Route::get('deleteDutyPersonelDetails/{id}', [DutyMemberDetailsController::class, 'delete'])
            ->name('admin.duty.deleteDutyPersonelDetails');

        //Contributions
        Route::get('/contributions', [ContributionController::class, 'index'])->name('admin.users.contributions');
        Route::post('/contributions', [ContributionController::class, 'store'])->name('admin.users.contributions.create');
        Route::get('/{user_id}/contributions', [ContributionController::class, 'show'])->name('admin.contributions.show');

        // Route::patch('/contributions/{id}', ContributionController::class, 'update')->name('admin.users.contributions.update');
        // Route::delete('/contributions/{id}', ContributionController::class, 'destroy')->name('admin.users.contributions.delete');
        Route::get('/contributions/search', [ContributionController::class, 'search'])->name('admin.users.contributions.search');
        Route::get('/contributions/{id}', [ContributionController::class, 'edit'])->name('admin.users.contributions.edit');
        Route::patch('/contributions/{id}', [ContributionController::class, 'update'])->name('admin.users.contributions.update');
        Route::delete('/contributions/{id}', [ContributionController::class, 'destroy'])->name('admin.users.contributions.delete');

        // Sunday Reports
        Route::get('/sunday-reports', [SundayReportController::class, 'getAllReports'])->name('admin.users.sunday-reports.index');
        Route::get('/sunday-reports/{id}', [SundayReportController::class, 'show'])->name('admin.users.sunday-reports.show');
        Route::get('/downloadPDF', [SundayReportController::class, 'downloadReportsAsAPDF'])->name('admin.users.sunday-reports.downloadAsPDF');
        Route::post('/{id}/sunday-report', [SundayReportController::class, 'store'])->name('admin.sunday-report.create');


        //announcements
        Route::get('/announcements', [AnnouncementController::class, 'index'])->name('admin.announcements');
        Route::post('/announcement', [AnnouncementController::class, 'store'])->name('admin.announcement.create');
        Route::get('/readAnnouncement/{id}', [AnnouncementController::class, 'readAnnouncement'])->name('admin.announcement.readAnnouncement');
        Route::get('/unreadAnnouncement/{id}', [AnnouncementController::class, 'markAsUnread'])->name('admin.announcement.unreadAnnouncement');

        Route::patch('/announcement/{id}', [AnnouncementController::class, 'update'])->name('admin.announcement.update');
        Route::delete('/announcement/{id}', [AnnouncementController::class, 'destroy'])->name('admin.announcement.delete');

        //filter functionalities
        Route::get('/filterDate', [FilterController::class, 'filterDate'])->name('admin.announcement.filterDate');
        Route::get('/filterLocation', [FilterController::class, 'filterLocation'])->name('admin.announcements.filterByEventLocation');
        Route::get('/filter', [FilterController::class, 'filter'])->name('admin.announcements.filter');



    });

    //User Routes
    Route::prefix('user')->group(function () {

        //profile
        Route::get('/{id}/profile', [ProfileController::class, 'index'])->name('user.profile');
        Route::post('/{id}/profile', [ProfileController::class, 'store'])->name('user.profile.create');
        Route::patch('/{user_id}/profile/{id}', [ProfileController::class, 'update'])->name('user.profile.update');
        Route::get('/{user_id}/profile/{id}', [ProfileController::class, 'destroy'])->name('user.profile.delete');

        //Leaves
        Route::get('/{id}/leaves', [LeaveController::class, 'index'])->name('user.leaves.index');
        Route::post('/{id}/leave', [LeaveController::class, 'store'])->name('user.leave.create');
        Route::get('/{user_id}/leave/{id}', [LeaveController::class, 'edit'])->name('user.leave.edit');
        Route::patch('/{user_id}/leave/{id}', [LeaveController::class, 'update'])->name('user.leave.update');
        Route::delete('/{user_id}/leave/{id}', [LeaveController::class, 'destroy'])->name('user.leave.delete');

        // Sunday Reports
        Route::get('/{id}/sunday-reports', [SundayReportController::class, 'index'])->name('user.sunday-report.index');
        Route::post('/{id}/sunday-report', [SundayReportController::class, 'store'])->name('user.sunday-report.create');
        Route::get('/{user_id}/sunday-report/{id}', [SundayReportController::class, 'edit'])->name('user.sunday-report.edit');
        Route::patch('/{user_id}/sunday-report/{id}', [SundayReportController::class, 'update'])->name('user.sunday-report.update');
        Route::delete('/{user_id}/sunday-report/{id}', [SundayReportController::class, 'destroy'])->name('user.sunday-report.delete');


        //Duty Roster
        Route::get('/{id}/duty', [DutyController::class, 'index'])->name('user.duty.index');
        Route::get('/downloadSchedule', [DutyController::class, 'downloadSchedule'])->name('user.downloadSchedule');



        Route::get('/announcements', [AnnouncementController::class, 'index'])->name('user.announcements');
        Route::patch('/announcement/{id}', [AnnouncementController::class, 'update'])->name('announcement.update');
        Route::delete('/announcement/{id}', [AnnouncementController::class, 'destroy'])->name('announcement.delete');
        Route::get('/readAnnouncement/{id}', [AnnouncementController::class, 'readAnnouncement'])->name('announcement.readAnnouncement');
        Route::get('/unreadAnnouncement/{id}', [AnnouncementController::class, 'markAsUnread'])->name('announcement.unreadAnnouncement');

        Route::get('/markAllAsRead', [AnnouncementController::class, 'markAllAsRead'])->name('announcement.markAllAsRead');
        Route::get('/markAllAsUnread', [AnnouncementController::class, 'markAllAsUnread'])->name('announcement.markAllAsUnread');

        Route::get('/allAnnouncements', [AnnouncementController::class, 'viewAllNotifications'])->name('user.announcements.all');
    });



});
require __DIR__ . '/auth.php';
