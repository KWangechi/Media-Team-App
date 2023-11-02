<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Profile;
use App\Models\User;
use App\Notifications\NewAnnouncement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert\SweetAlertServiceProvider;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = auth()->user()->notifications;


        if(auth()->user()->id === User::ROLE_ADMIN) {
            return view('admin.announcements.index', compact('announcements'));

        }

        // dd($announcements);
        return view('user.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $users = User::all();

        // get the profile picture of the user


        $request->validate([
            'title',
            'content',
            'event_date',
            'event_time',
            'event_location'
        ]);

        $announcement = Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'event_location' => $request->event_location
        ]);


        if (!$announcement) {
            return redirect()->route('admin.announcements.index')->with('error_message', 'Error!! Please try again');
        } else {

            //send a notification to all users once the announcement has been created
            $notification = Notification::send($users, new newAnnouncement($announcement->title, $announcement->content));

            // dd($notification);
            return redirect()->route('admin.announcements')->with('success_message', 'Announcement created successfully!!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $annnoncement = Announcement::find($id);

        return redirect()->route('admin.announcement.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        // if (!$announcement->update($request->all())) {
        //     return redirect()->route('admin.announcements')->with('error_message', 'Error! Try updating again!!');
        // } else {
        //     return redirect()->route('admin.announcements')->with('success_message', 'Announcement updated successfully!!');
        // }

        Alert::success('Success Title', 'Success Message');
        // Alert::success('Title','Hello', 'success');

        // dd($announcement);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $announcement = DB::table('notifications')->where('id', $id);

        try {
            $announcement->delete();

            return to_route('user.announcements')->with('success_message', 'Notification deleted successfully!!!');

        } catch (\Throwable $th) {
            return to_route('user.announcements')->with('error_message', $th->getMessage());

        }
    }

    /**
     * Mark a notification in the database as read
     * @param id the id of the notification
     */

    public function readAnnouncement($id)
    {

        try {
            $announcement = DB::table('notifications')->where('id', $id)->update(['read_at' => Carbon::now()]);

            return to_route('user.announcements')->with('success_message', 'Notification marked as read!!');
        } catch (\Throwable $th) {
            return to_route('user.announcements')->with('error_message', $th->getMessage());
        }
    }

    /**
     * Mark a notification in the database as unread
     * @param id the id of the notification
     */

    public function markAsUnread($id)
    {
        try {
            $announcement = DB::table('notifications')->where('id', $id)->update(['read_at' => null]);

            return to_route('user.announcements')->with('success_message', 'Notification marked as read successfully!!');
        } catch (\Throwable $th) {
            return to_route('user.announcements')->with('error_message', $th->getMessage());
        }
    }

    /**
     * mark all unread notifications as read
     */
    public function markAllAsRead() {
        // $announcements = DB::table('notifications')->where('read_at', '=', null)->get();
        $user = auth()->user();

        try {
            $user->unreadNotifications->markAsRead();

            return to_route('user.announcements')->with('success_message', 'Notification marked as read successfully!!');

        } catch (\Throwable $th) {
            return to_route('user.announcements')->with('error_message', $th->getMessage());

        }
    }

    /**
     * mark all read notifications as unread
     */
    public function markAllAsUnread() {
        $user = auth()->user();

        try {
            $user->readNotifications->markAsUnRead();

            return to_route('user.announcements')->with('success_message', 'Notification marked as read successfully!!');

        } catch (\Throwable $th) {
            return to_route('user.announcements')->with('error_message', $th->getMessage());

        }
    }
}

