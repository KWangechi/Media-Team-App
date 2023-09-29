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
        // dd($id);
        $leaves = Leave::paginate(10);

        return view('admin.leave.leaves', compact(['leaves']));
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
            return redirect()->route('admin.leaves.index', [auth()->user()->id])->with('error_message', 'Start date should not be later than the end date!!');
        } else {
            $leave = Leave::create([
                'user_id' => auth()->user()->id,
                'reason' => $request->reason,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);

            $message = [
                'title' => 'Hello'.$user->name,
                'body' => 'Your Leave Request has been created successfully. Once the admin approves your request,
                you will receive a notification on the same. The leave will run from '.$leave->start_date.' to '.$leave->end_date,
                'salutation' => 'Regards, '.(env('APP_NAME'))
            ];

            // send a notification for creating a Leave request
            Notification::send($user, new LeaveCreated($message));

            if (!$leave) {
                return redirect()->route('admin.leaves.index', [auth()->user()->id])->with('error_message', 'Error! Please try again');
            }

            return redirect()->route('admin.leaves.index', [auth()->user()->id])->with('success_message', 'Leave request created successfully!!');

            // dd($leave);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($leave_id)
    {
        $leave = Leave::where('user_id', auth()->user()->id)->find($leave_id);

        return redirect()->route('admin.leave.show', [auth()->user()->id])->with('leave', $leave);
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
    public function update(Request $request, $leave_id)
    {
        $leave = Leave::where('user_id', auth()->user()->id)->find($leave_id);

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
                    return redirect()->route('admin.leaves.index', auth()->user()->id)->with('success_message', 'Leave request updated successfully');
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
    public function destroy($id)
    {
        $leave = Leave::where('user_id', auth()->user()->id)->findOrFail($id);

        if(!$leave->delete()){
            return redirect()->route('admin.leaves.index', auth()->user()->id)->with('error_message', 'Error! Please try agaain');
        }

        else{
            return redirect()->route('admin.leaves.index', auth()->user()->id)->with('success_message', 'Leave request deleted successfully!!');
        }
    }

    public function approveLeaveRequest($user_id, $leave_id)
    {

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

        return redirect()->route('admin.leaves.index', auth()->user()->id)->with('error_message', 'Leave request has been rejected!');
    }
}
