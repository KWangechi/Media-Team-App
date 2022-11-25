<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;
use App\Notifications\NewAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::paginate(6);
        // dd($announcements);
        return view('admin.announcements.index', compact('announcements'));
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

        // $message = [
        //     'title' => $announcement->title,
        //     'content' => $announcement->content
        // ];

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
        $annnoncement = Announcement::find($id);

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

        if (!$announcement->update($request->all())) {
            return redirect()->route('admin.announcements.edit', $request->id)->with('error_message', 'Error! Try updating again!!');
        } else {
            return redirect()->route('admin.announcements')->with('success_message', 'Announcement updated successfully!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);

        if (!($announcement->destroy())) {
            return redirect()->route('admin.announcements')->with('success_message', 'Announcement deleted successfully!');
        }
    }

    public function readAnnouncement()
    {
    }

}
