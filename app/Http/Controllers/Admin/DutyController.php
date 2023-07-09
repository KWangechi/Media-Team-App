<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Duty;
use App\Models\DutyMemberDetails;
use App\Models\User;
use Faker\Core\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DutyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $duties = Duty::all();
        $member_details = DutyMemberDetails::all();

        if (auth()->user()->id == User::ROLE_ADMIN) {

            return view('admin.duty.index', compact('duties', 'member_details'));
        } else {
            return view('user.duty.index', compact('duties', 'member_details'));
        }

        // dd($member_details);
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
        // $request->validate([
        //     'week' => 'string',
        //     'supervisor_signature' => 'string',
        //     'setup_time' => 'required',
        //     'date_assigned' => 'date',
        //     'duty_id' => 'string',
        //     'member_name' => 'string',
        //     'supervisor_name' => 'string',
        //     'workstation' => 'string',
        //     'duty_assigned' => 'string',
        //     'event_type' => 'string'
        // ]);

        $duty = Duty::create([
            'week' => $request->week,
            'supervisor_signature' => $request->supervisor_signature,
            'setup_time' => $request->setup_time,
            'date_assigned' => $request->date_assigned
        ]);


        $member_details = DutyMemberDetails::create([
            'duty_id' => $duty->id,
            'member_name' => $request->member_name,
            'supervisor_name' => $request->supervisor_name,
            'workstation' => $request->workstation,
            'duty_assigned' => $request->duty_assigned,
            'event_type' => $request->event_type
        ]);

        if (!$duty) {
            return redirect()->route('admin.duty.index', auth()->user()->id)->with('error_message', 'Error creating a new duty!!');
        } else {
            if (!$member_details) {
                return redirect()->route('admin.duty.index', auth()->user()->id)->with('error_message', 'Error creating new duty mmber_details!!');
            } else {
                return redirect()->route('admin.duty.index', auth()->user()->id)->with('success_message', 'Duty Roster created successfully!!');
            }
        }

        // // dd('hIZI NI NINI SASA');
        // // dd($request->all());
        // dd($duty, $member_details);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $duty = Duty::findOrFail($id);

        // dd($duty);

        return view('admin.duty.roster.edit', compact('duty'));
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
        $duty = Duty::findOrFail($id);

        // dd(["Old data: " => $duty, "New data: " => $request->all()]);

        try {
            $duty->update($request->all());

            return to_route('admin.duty.index', auth()->user()->id)->with('success_message', 'Duty Roster details updated successfully!!');

        } catch (\Throwable $th) {
            return to_route('admin.duty.index', auth()->user()->id)->with('error_message', $th->getMessage());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($duty_id)
    {
        $duty = Duty::findOrFail($duty_id);

        if (!$duty) {
            return redirect()->route('admin.duty.index', auth()->user()->id)->with('error_message', 'ID doesn\t exist');
        } else {
            if (!$duty->delete()) {
                return redirect()->route('admin.duty.index', auth()->user()->id)->with('error_message', 'An error occurred! Please check the request and try again!');
            } else {
                return redirect()->route('admin.duty.index', auth()->user()->id)->with('success_message', 'Duty Roster Deleted successfully!!');
            }
        }

    }

    /**
     * Creates just the member_name, supervisor_name, worskstation and duty assigned

     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function createDutyPersonelDetails(Request $request, $id)
    {

        $member_details = [
            'unique_id' => uniqid(mt_rand(5, 5)),
            'member_name' => $request->duty_personel_details['member_name'],
            'supervisor_name' => $request->duty_personel_details['supervisor_name'],
            'workstation' => $request->duty_personel_details['workstation'],
            'duty_assigned' => $request->duty_personel_details['duty_assigned'],
            'type_of_service' => $request->duty_personel_details['type_of_service']
        ];


        // //use a query builder to add new data to that column
        $updated_duty = DB::table('duties')->where('id', $id)->update(['duty_personel_details' => DB::raw("JSON_MERGE(duty_personel_details,'" . json_encode($member_details) . "')")]);

        if (!$updated_duty) {
            return redirect()->route('admin.duty.index', auth()->user()->id)->with('error_message', 'Error occurred! Please try again');
        } else {
            return redirect()->route('admin.duty.index', auth()->user()->id)->with('success_message', 'Member Details added successfully');
        }
    }

    /**
     * Updates just the member_name, supervisor_name, worskstation and duty assigned

     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateDutyPersonelDetails(Request $request, $id)
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

        // dd($request->all());
    }
    public function deleteDutyPersonelDetails($id)
    {

    }

    /**
     * return the edit form view with the information of the members details
     * @param Request $request
     */
    public function editDutyPersonelDetails($duty_id)

    {
        // dd($duty_id);

        // $member_details = Duty::findOrFail($duty_id)->members;



        // dd($member_details);
    }
}
