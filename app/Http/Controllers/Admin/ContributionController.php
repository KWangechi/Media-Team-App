<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\User;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class ContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contributions = Contribution::paginate(10);
        $users = User::all();


        return view('admin.users.contributions.index', compact(['contributions', 'users']));
    }

    /**
     * Search for contributions in the table
     * @param Request $request
     */
    public function search(Request $request){

        $contributions = Contribution::all();
        $member_name = '';

        $search = $request->search;

        foreach ($contributions as $contribution) {
            # code...
            $member_name = $contribution->user->name;
            // dd($contribution->user->name);
        }

        $search_contributions = Contribution::query()
        ->where('user_id', 'LIKE', '%'. $search. '%')
        ->orWhere('amount_contributed', 'LIKE', '%' . $search. '%')
        ->orWhere('date_contributed', 'LIKE', '%' . $search. '%')
        ->get();

        dd($search_contributions);


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
            'user_id',
            'amount_contributed',
            'date_contributed',
            'comment'
        ]);

        // dd($request->all());
        $contribution = Contribution::create([
            'user_id' => $request->user_id,
            'amount_contributed' => $request->amount_contributed,
            'date_contributed' => $request->date_contributed,
            'comment' => $request->comment
        ]);

        if(!$contribution){
            return redirect()->route('admin.users.contributions')->with('error_message', 'Error! Something went wrong. Please try again');
        }
        else{
            return redirect()->route('admin.users.contributions')->with('success_message', 'Contribution recorded successfully!!');

        }
        // dd($contribution);
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
    public function destroy($id)
    {
        //
    }
}
