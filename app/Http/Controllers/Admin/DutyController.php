<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Duty;
use App\Models\User;
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

        if(auth()->user()->id == User::ROLE_ADMIN){

            return view('admin.duty.index', compact('duties'));
        }
        else{
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

        // $duty = Duty::create($request->all());


        dd($duty);


        // if(!$duty){
        //     return redirect()->route('admin.duty.index', auth()->user()->id)->with('error_message', 'Error occurred! Please try again');
        // }

        // return redirect()->route('admin.duty.index', auth()->user()->id)->with('success_message', 'Duty Roster created successfully!!');

        // $duty = Duty::create($request->all());
        // dd($duty);
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
        //
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

        if(!$duty){
            dd("This ID does not exist!!");

        }

        else{
            if(!$duty->delete()){
                dd("Error!! Deletion encountered an error");
            }

            else{
                return redirect()->route('admin.duty.index', auth()->user()->id)->with('success_message', 'Duty Roster Deleted successfully!!');
            }
        }
    }

    /**
     * Updates just the member_name, supervisor_name, worskstation and duty assigned

     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateDutyPersonelDetails(Request $request,$id){

        //get the id of the already created duty roster and just update 'duty_personel_details' column
        $duty = Duty::findOrFail($id);

        // dd($request->duty_personel_details);

        //use a query builder to add new data to that column
        $updated_duty = DB::table('duties')->where('id', $id)->update(['duty_personel_details' => DB::raw("JSON_SET(duty_personel_details, '$[1]', $request->duty_personel_details)")]);

        if($updated_duty) {
            dd('Data added successfully to the table!!');
        }
        else{
            dd("Something went wrong. Please try again");
        }

        // dd($updated_duty);
    }


}
