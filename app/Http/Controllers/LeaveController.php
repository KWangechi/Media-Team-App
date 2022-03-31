<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use App\Notifications\RequestLeave;
use Illuminate\Http\Request;
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
        $leaves = Leave::where('user_id', $id)->paginate(15);

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

        // dd($request->input('reason'));
        // dd($request->validate([
        //     'user_id' => 'required',
        //     'reason' => 'required',
        //     'start_date' => 'required',
        //     'end_date' =>'required',
        // ]));
        
        $leave = Leave::create([
            'user_id' => auth()->user()->id,
            'reason' => $request->reason,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        $admin = User::where('role_id', User::ROLE_ADMIN)->get();

        // $user = User::where('id', auth()->user()->id)->get();

        if(!$leave){
            return redirect()->route('user.leave.index')->with('error_message', 'Error! Please try again');
        }

        // Notification::send($admin, new RequestLeave($leave->user));

        return redirect()->route('user.leaves.index', [auth()->user()->id])->with('success_message', 'Leave requested successfully');

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
        //
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
    public function update(Request $request, $user_id, $leave_id)
    {
        $leave = Leave::where('user_id', $user_id)->find($leave_id);

        if(!$leave->update($request->all())){
            return redirect()->route('user.leave', [auth()->user()->id])->with('error_message', 'Error!!Please try again');
        }
        return redirect()->route('user.leave', [auth()->user()->id])->with('success_message', 'Leave updated successfully');

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
}
