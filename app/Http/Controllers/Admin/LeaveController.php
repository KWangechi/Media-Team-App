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
            'user_id',
            'reason',
            'start_date',
            'end_date'
        ]
    );

    // dd($request->reason);

        // $leave = Leave::create([
        //     'user_id' => auth()->user()->id,
        //     'reason' => $request->reason,
        //     'start_date' => $request->start_date,
        //     'end_date' => $request->end_date
        // ]);

        // // User::where('id', auth()->user()->id)->update([
        // //     'status' => 'approved'
        // // ]);

        // if($request->start_date > $request->end_date){
        //     return redirect()->route('admin.leaves.index', [auth()->user()->id])->with('error_message', 'Start date should not be later than the end date!!');
        // }
        // else{
        //     if(!$leave){
        //         return redirect()->route('admin.leave.show', [auth()->user()->id])->with('error_message', 'Error! Please try again');
        //     }

        //     return redirect()->route('admin.leave.show', [auth()->user()->id])->with('success_message', 'Leave requested successfully');

        // }

        if($request->start_date > $request->end_date){
            dd('Start date should not be later than the end date');

        }
        else{
            dd('This is correct!!');

        }

        // dd($leave);


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

    public function approveLeaveRequest($user_id, $leave_id){

        Leave::where(['user_id' => $user_id, 'id' => $leave_id])->update([
            'status' => 'approved'
        ]);

        $user = User::where('id', $user_id)->get();

        $message = [
            'title' => 'Leave Request Approval Status',
            'body' => 'Your Leave requested has been approved. Please contact the admin incase of any changes
            that may occur during your leave days! We hope to see you soon'
        ];

        Notification::send($user, new LeaveApproved($message));

        return redirect()->route('admin.leaves.index', auth()->user()->id)->with('success_message', 'Leave request has been approved!!');

    }

    public function rejectLeaveRequest($user_id, $leave_id){

        Leave::where(['user_id' => $user_id, 'id' => $leave_id])->update([
            'status' => 'rejected'
        ]);

        $user = User::where('id', $user_id)->get();

        $message = [
            'title' => 'Leave Request Approval Status',
            'body' => 'Your Leave requested has been rejected. Please contact your supervisor for more information'
        ];

        Notification::send($user, new LeaveApproved($message));

        return redirect()->route('admin.leaves.index', auth()->user()->id)->with('error_message', 'Leave request has been rejected!');

    }

}
