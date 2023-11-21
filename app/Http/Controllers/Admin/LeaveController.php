<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\User;
use App\Notifications\LeaveApproved;
use App\Notifications\LeaveCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('Leaves');
        $leaves = Leave::where('user_id', '!=', auth()->id())->paginate(6);

        return view('admin.leave.leaves', compact('leaves'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = auth()->user();
        $request->validate(
            [
                'user_id',
                'reason',
                'start_date',
                'end_date'
            ]
        );


        if ($request->start_date > $request->end_date) {
            return redirect()->route('admin.leave.show', [auth()->user()->id])->with('error_message', 'Start date should not be later than the end date!!');
        } else {
            $leave = Leave::create([
                'user_id' => auth()->user()->id,
                'reason' => $request->reason,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => 'approved'
            ]);

            $message = [
                'subject' => 'Leave Request Creation',
                'greeting' => 'Hello '.auth()->user()->name,
                'body' => 'Your Leave Request has been created successfully. You will be notified once the admin approves your Leave.Please check back later',
                'salutation' => 'Regards, Media Team App Admin'
            ];

            // send a notification for creating a Leave request
            Notification::send($user, new LeaveCreated($message));

            if (!$leave) {
                return redirect()->route('admin.leave.show', [auth()->user()->id])->with('error_message', 'Error! Please try again');
            }

            return redirect()->route('admin.leave.show', [auth()->user()->id])->with('success_message', 'Leave request created successfully!!');


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $leaves = Leave::where('user_id', $user_id)->paginate(7);

        return view('admin.leave.index', compact('leaves'));
        // dd($leave->reason);
    }

    public function edit($id)
    {
        $leave = Leave::where('user_id', auth()->user()->id)->findOrFail($id);

        return view('admin.leave.edit', compact('leave'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $leave_id)
    {
        // dd(['User ID: ' => $user_id, 'Leave ID: ' => $leave_id]);

        $leave = Leave::where('user_id', $user_id)->find($leave_id);

        // dd($request->all());

        if (!$leave) {
            dd('ID does not exist');
        } else {
            if ($request->start_date > $request->end_date) {
                return redirect()->route('admin.leave.edit', $leave_id)->with('error_message', 'Start date should not be after the end date!!');
            } else {
                if (!$leave->update($request->all())) {
                    return redirect()->route('admin.leave.edit', $leave_id)->with('error_message', 'Error! Please try again');
                } else {
                    return redirect()->route('admin.leave.show', auth()->user()->id)->with('success_message', 'Leave request updated successfully');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($user_id, $leave_id)
    {
        $leave = Leave::where('user_id', $user_id)->findOrFail($leave_id);

        if(!$leave->delete()){
            return redirect()->route('admin.leave.show', auth()->user()->id)->with('error_message', 'Error! Please try agaain');
        }

        else{
            return redirect()->route('admin.leave.show', auth()->user()->id)->with('success_message', 'Leave request deleted successfully!!');
        }
    }

    public function approveLeaveRequest($user_id, $leave_id)
    {

        $leave = Leave::where(['user_id' => $user_id, 'id' => $leave_id])->update([
            'status' => 'approved'
        ]);

        // dd($leave);

        $user = User::where('id', $user_id)->first();

        $message = [
            'subject' => 'Leave Request Approval Status',
            'greeting' => 'Dear '.$user->name. ',',
            'body' => 'Your Leave requested has been approved. Please contact the admin incase of any changes
            that may occur during your leave days! We hope to see you soon',
            'salutation' => 'Regards, Media Team App Admin.'
        ];


        Notification::send($user, new LeaveApproved($message));

        if(auth()->user()->role->id == User::ROLE_ADMIN) {

            return redirect()->route('admin.leave.show', auth()->user()->id)->with('success_message', 'Leave request has been approved!!');
        }

        return redirect()->route('admin.leaves.index')->with('success_message', 'Leave request has been approved!!');




        // dd([
        //     'User ID' => $user_id,
        //     'Leave ID' => $leave_id
        // ]);
    }

    public function rejectLeaveRequest($user_id, $leave_id)
    {

        Leave::where(['user_id' => $user_id, 'id' => $leave_id])->update([
            'status' => 'rejected'
        ]);

        $user = User::where('id', $user_id)->get();

        $message = [
            'title' => 'Leave Request Approval Status',
            'body' => 'Your Leave requested has been rejected. Please contact your supervisor for more information'
        ];

        Notification::send($user, new LeaveApproved($message));

        return redirect()->route('admin.leave.show', auth()->user()->id)->with('error_message', 'Leave request has been rejected!');
    }
}
