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
        $contributions = Contribution::paginate(6);
        $users = User::all();


        return view('admin.users.contributions.index', compact(['contributions', 'users']));
    }

    /**
     * Search for contributions in the table
     * @param Request $request
     */
    public function search(Request $request) {

        $users = User::all();
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
        ->paginate(7);

        // dd($search_contributions);

        // return view('admin.users.contributions.index', compact(['search_contributions', 'contributions']))->with('success_message', 'Contribution has been found!!');
        if(!$search_contributions){
            return view('admin.users.contributions.search', compact(['search_contributions', 'users']));
            // return redirect()->route('admin.users.contributions.search')->with('error_message', 'Sorry!!! Record not found');
        }

        else{
            // return redirect()->route('admin.users.contributions.search')->with('success_message', 'Found {{ $search_contributions->count() }} results');

            return view('admin.users.contributions.search', compact(['search_contributions', 'users']));
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
            return redirect()->route('admin.users.contributions')->with('error_message', 'Error! Something Went Wrong. Please try again');
        }
        else{
            return redirect()->route('admin.users.contributions')->with('success_message', 'Contribution Added successfully!!');

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
        $contributions = Contribution::where('user_id', $user_id)->paginate(6);
        $users = User::all();
        // dd($contributions);

            return view('admin.users.contributions.my_contributions', compact('contributions', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contribution = Contribution::findOrFail($id);
        $users = User::all();

        if(!$contribution){
            return redirect()->route('admin.users.contributions')->with('error_message', 'ID does not exist!!');
        }
        else{
            // return redirect()->route('admin.users.contributions.edit', compact(['users', 'contribution']));
            // return view('admin.users.contributions.index', [$contribution->id])->with(['contribution' => $contribution]);
            return view('admin.users.contributions.edit', compact(['users', 'contribution']));

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
        $contribution = Contribution::findOrFail($id);

        if(!($contribution->update($request->all()))){
            return redirect()->route('admin.users.contributions')->with('error_message', 'Something went wrong!! Please try again');
        }

        else{
            return redirect()->route('admin.users.contributions')->with('success_message', 'Contribution has been updated successfully!!');
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
        $contribution = Contribution::findOrFail($id);


        if(!($contribution->delete())){

            return redirect()->route('admin.users.contributions')->with('error_message', 'Error!! Something is wrong');

        }

        else{
            return redirect()->route('admin.users.contributions')->with('success_message', 'Contribution deleted successfully!!!');
        }
    }
}
