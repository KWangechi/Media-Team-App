<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Duty;
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

        if (auth()->user()->id == User::ROLE_ADMIN) {

            return view('admin.duty.index', compact('duties'));
        } else {
            return view('user.duty.index', compact('duties'));
        }

        // dd($duties);
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
        $request->validate([
            'week' => 'string',
            'duty_personel_details' => 'array',
            'supervisor_signature' => 'string',
            'setup_time' => 'required',
            'date_assigned' => 'date'
        ]);

        $duty = Duty::create([
            'week' => $request->week,
            'duty_personel_details' => [
                [
                    'unique_id' => uniqid(mt_rand()),
                    'member_name' => $request->duty_personel_details["member_name"],
                    'supervisor_name' => $request->duty_personel_details["supervisor_name"],
                    'workstation' => $request->duty_personel_details["workstation"],
                    'duty_assigned' => $request->duty_personel_details["duty_assigned"],
                    'type_of_service' => $request->duty_personel_details["type_of_service"]
                ]
            ],
            'supervisor_signature' => $request->supervisor_signature,
            'setup_time' => $request->setup_time,
            'date_assigned' => $request->date_assigned
        ]);

        // dd($duty);


        if (!$duty) {
            return redirect()->route('admin.duty.index', auth()->user()->id)->with('error_message', 'Error occurred! Please try again');
        }

        return redirect()->route('admin.duty.index', auth()->user()->id)->with('success_message', 'Duty Roster created successfully!!');
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
        $duty = Duty::findOrFail($id);

        return view('admin.duty.edit', compact('duty'));
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

        if (!$duty) {
            return;
        } else {
            if (!$duty->update($request->all())) {
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

        // dd($duty);
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
            'unique_id' => uniqid(mt_rand(5,5)),
            'member_name' => $request->duty_personel_details['member_name'],
            'supervisor_name' => $request->duty_personel_details['supervisor_name'],
            'workstation' => $request->duty_personel_details['workstation'],
            'duty_assigned' => $request->duty_personel_details['duty_assigned'],
            'type_of_service' => $request->duty_personel_details['type_of_service']
        ];

        //use a query builder to add new data to that column
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
        $member_details = [
            'member_name' => $request->duty_personel_details['member_name'],
            'supervisor_name' => $request->duty_personel_details['supervisor_name'],
            'workstation' => $request->duty_personel_details['workstation'],
            'duty_assigned' => $request->duty_personel_details['duty_assigned'],
            'type_of_service' => $request->duty_personel_details['type_of_service']
        ];

        //use a query builder to add new data to that column
        $updated_duty = DB::table('duties')->where('id', $id)->update(['duty_personel_details' => DB::raw("JSON_INSERT(duty_personel_details,'" . json_encode($member_details) . "')")]);

        if (!$updated_duty) {
            return redirect()->route('admin.duty.index', auth()->user()->id)->with('error_message', 'Error occurred! Please try again');
        } else {
            return redirect()->route('admin.duty.index', auth()->user()->id)->with('success_message', 'Member Details added successfully');
        }
    }
    public function deleteDutyPersonelDetails(Request $request, $id) {
        $updated_duty = DB::table('duties')->where('id', $id)->delete();

    }

    /**
     * return the edit form view with the information of the members details
     * @param Request $request
     */
    public function editDutyPersonelDetails($id, $unique_id) {

        // dd($unique_id);

        // $duties = DB::table('duties')->whereJsonContains('duty_personel_details', [['member_name' => 'Carl Cote']])->select('duty_personel_details')->get();

        // for ($i=0; $i < count($duties); $i++) {
        //     # code...
        //     dd([$i]);
        // }
        // dd(count($duties));

        // $duties = Duty::findOrFail($id);
        // $duty_personel_details = $duties->duty_personel_details;

        // for ($i=0; $i < count($duty_personel_details); $i++) {
        //     # code...
        //     dd($i);
        // }
        // dd($duty_personel_details[count($duty_personel_details)-1]);
        // dd(count($duty_personel_details));


        // foreach($duty_personel_details as $new_duty) {
        //     dd($new_duty['unique_id']);
        // }
        // dd($query->where());
    }
}
