<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Duty;
use App\Models\User;
use Illuminate\Http\Request;

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
            'member_name' => 'string',
            'supervisor_name' => 'string',
            'workstation' => 'string',
            'duty_assigned' => 'string',
            'type_of_service' => 'string',
            'supervisor_signature' => 'string',
            'setup_time' => 'required',
            'date_assigned' => 'date'
        ]);

        // $duty = Duty::create([
        //     'member_name' => $request->member_name,
        //     'supervisor_name' => $request->supervisor_name,
        //     'workstation' => $request->workstation,
        //     'duty_assigned' => $request->duty_assigned,
        //     'type_of_service' => $request->type_of_service,
        //     'supervisor_signature' => $request->supervisor_signature,
        //     'setup_time' => $request->setup_time,
        //     'date_assigned' => $request->date_assigned
        // ]);


        // dd($duty);

        dd($request);

        // if(!$duty){
        //     return redirect()->route('admin.duty.create', auth()->user()->id)->with('error_message', 'Error occurred! Please try again');
        // }

        // return redirect()->route('admin.duty.index', auth()->user()->id)->with('success_message', 'Duty Roster created successfully!!');

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


}
