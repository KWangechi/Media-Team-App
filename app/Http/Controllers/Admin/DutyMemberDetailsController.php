<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Duty;
use App\Models\DutyMemberDetails;
use Illuminate\Http\Request;

class DutyMemberDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $member_details = Duty::with('duties');

        dd($member_details);
        // return view('admin.duty.index', compact('member_details'));
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
    public function store(Request $request, $id)
    {
        // query for the id of the duty
        $duty = Duty::findOrFail($id);

        // dd($duty->id);
        $request->validate([
            'duty_id' => 'number',
            'member_name' => 'string',
            'supervisor_name' => 'string',
            'workstation' => 'string',
            'duty_assigned' => 'string',
            'event_type' => 'required'
        ]);

        $member_details = DutyMemberDetails::create([
            'duty_id' => $duty->id,
            'member_name' =>$request->member_name,
            'supervisor_name' => $request->supervisor_name,
            'workstation' => $request->workstation,
            'duty_assigned' => $request->duty_assigned,
            'event_type' => $request->event_type
        ]);

        if (!$member_details) {
            return redirect()->route('admin.duty.index', auth()->user()->id)->with('error_message', 'Error occurred!! Please try again');
        }
        else {
            return redirect()->route('admin.duty.index', auth()->user()->id)->with('success_message', 'Details created successfully!');

        }

        // dd([$request->all(), $id]);
        // dd($member_details);
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
        $member_details = DutyMemberDetails::findOrFail($id);
        if (!$member_details) {
            return redirect()->route('admin.duty.index', auth()->user()->id)->with('error_message', 'ID does not exist!!');
        } else {
            return view('admin.duty.edit', compact('member_details'));
        }

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
        $member_details = DutyMemberDetails::findOrFail($id);

        if (!$member_details) {
            return;
        } else {
            if (!$member_details->update($request->all())) {
                return redirect()->route('admin.duty.index', auth()->user()->id)->with('error_message', 'Error Occurred while updating. Please check your request and try again!');
            } else {
                return redirect()->route('admin.duty.index', auth()->user()->id)->with('success_message', 'Duty Roster Updated successfully!!');
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
        $duty_member_details = Duty::findOrFail($id)->members;

        dd($duty_member_details);
    }
}
