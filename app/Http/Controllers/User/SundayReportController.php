<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SundayReport;
use Illuminate\Http\Request;

class SundayReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $reports = SundayReport::paginate(6);

        return view('user.sunday-report.index', [auth()->user()->id], compact('reports'));
    }

    public function getAllReports() {
        $reports = SundayReport::paginate(20);

        return view('admin.sunday-reports.index', compact('reports'));
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
        $request->validate([
            'user_id' => 'integer',
            'report_date' => 'date',
            'event_type' => 'string',
            'comments' => 'string'

        ]);

        try {

            SundayReport::create([
                'user_id' => $id,
                'report_date' => $request->report_date,
                'event_type' => $request->event_type,
                'comments' => $request->comments
            ]);

            return redirect()->route('user.sunday-report.index', [auth()->user()->id])->with('success_message', 'Report created successfully!!');

            // return view('user.sunday-report.index', auth()->id)->with('success_message', 'Report created successfully!!');

        } catch (\Throwable $th) {
            return view('user.sunday-report.index')->with('error_message', $th->getMessage());

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
        $report = SundayReport::findOrFail($id);

        return view('admin.users.sunday-reports.index', compact('report'));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id, $report_id)
    {
        dd(['Report ID:' => $report_id, 'User ID:' => $user_id]);
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
    public function destroy($user_id, $report_id)
    {
        // dd(['Report ID:' => $report_id, 'User ID:' => $user_id]);
        $report = SundayReport::where('user_id', $user_id)->findOrFail($report_id);

        if(!$report->delete()){
            return redirect()->route('user.sunday-report.index', $user_id)->with('error_message', 'Error! Please try agaain');
        }

        else{
            return redirect()->route('user.sunday-report.index', $user_id)->with('success_message', 'Report deleted successfully!!');
        }
    }

    public function downloadReportsAsAPDF(SundayReport $report) {

        dd($report->id);
    }
}
