<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\User;
use App\Notifications\LeaveApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $leaves = Leave::paginate(15);

        // $adminLeave = Leave::where('user_id', auth()->user()->id)->find($id);

        // dd('This should work');

        return view('admin.leave.leaves', [auth()->user()->id], compact(['leaves']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'reason' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $leave = Leave::create([
            'user_id' => auth()->user()->id,
            'reason' => $request->reason,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        User::where('user_id', auth()->user()->id)->update([
            'status' => 'approved'
        ]);

        if(!$leave){
            return redirect()->route('admin.leave.show', [auth()->user()->id])->with('error_message', 'Error! Please try again');
        }

        return redirect()->route('admin.leave.show', [auth()->user()->id])->with('success_message', 'Leave requested successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leave = Leave::where('user_id', auth()->user->id)->find($id);

        return redirect()->route('admin.leave.show', [auth()->user()->id],compact($leave));
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function approveLeave($id){

        User::where(['user_id',$id])->update([
            'status' => 'approved'
        ]);

        $user = User::where('user_id', $id)->get();

        $message = [
            'title' => 'Leave Request Approval Status'
        ];

        Notification::send($user, new LeaveApproved($message));
        
        // return redirect()->route('admin.users.index');
    }

    public function rejectLeave($id){

        User::where(['user_id',$id])->update([
            'status' => 'rejected'
        ]);

        $user = User::where('user_id', $id)->get();

        $message = [
            'title' => 'Leave Request Approval Status',
            'body' => 'Your request has been rejected. Please contact the admin'
        ];

        Notification::send($user, new LeaveApproved($message));
    }

}
