<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use App\Notifications\LeaveCreated;
use App\Notifications\RequestLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

// use Illuminate\Notifications\Notification;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $leaves = Leave::where('user_id', $id)->paginate(7);

        // $userLeave  = User::with('leaves')->get();

        // dd($userLeave->user_id);

        return view('user.leave.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.leave.create');
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

        // dd($request->input('reason'));
        $request->validate([
            'user_id',
            'reason',
            'start_date',
            'end_date',
        ]);


        //error when start date is more than the end date and vice versa
        if ($request->start_date > $request->end_date) {
            return redirect()->route('user.leaves.index', auth()->user()->id)->with('error_message', 'Start Date should not be later than the End Date');
        } else {
            $leave = Leave::create([
                'user_id' => auth()->user()->id,
                'reason' => $request->reason,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            // dd($leave);

            $message = [
                'title' => 'Dear '.$user->name,
                'body' => 'Your Leave Request has been created successfully. Once the admin approves your request,
                you will receive a notification on the same. The leave will run from '.$leave->start_date.' to '.$leave->end_date,
                'salutation' => 'Regards, '.(env('APP_NAME'))
            ];

            // send a notification for creating a Leave request
            Notification::send($user, new LeaveCreated($message));

            if (!$leave) {
                return redirect()->route('user.leaves.index', auth()->user()->id)->with('error_message', 'Error! Please try again');
            }

            return redirect()->route('user.leaves.index', auth()->user()->id)->with('success_message', 'Leave request created successfully!!');


            // dd($leave);

            // return redirect()->route('user.leaves.index', auth()->user()->id)->with('success_message', 'Leave request created successfully!!!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id, $leave_id)

    {
        // dd([$leave_id, $user_id]);
        $leave = Leave::where('user_id', $user_id)->findOrFail($leave_id);

        return view('user.leave.edit', [auth()->user()->id], compact('leave'));
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
        $leave = Leave::where('user_id', $user_id)->find($leave_id);

        if (!$leave->update($request->all())) {
            return redirect()->route('user.leaves.index', [auth()->user()->id])->with('error_message', 'Error!!Please try again');
        }

        return redirect()->route('user.leaves.index', [auth()->user()->id])->with('success_message', 'Leave request updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $leave_id)
    {
        $leave = Leave::where('user_id', $user_id)->findOrFail($leave_id);

        if(!$leave){
            dd('Error! ID not found');
        }

        else{
            $leave->delete();

            return redirect()->route('user.leaves.index', [auth()->user()->id])->with('success_message', 'Leave request deleted successfully!!');
        }

    }
}
