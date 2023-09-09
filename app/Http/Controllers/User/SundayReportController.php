<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SundayReport;
use App\Models\User;
use App\Notifications\SundayReportSubmissions;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use PDF;


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


        return view('user.sunday-report.index', compact('reports'));
    }

    public function getAllReports()
    {
        $all_reports = SundayReport::paginate(10);

        return view('admin.sunday-reports.index', compact('all_reports'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        // retrieve the admin
        $user = User::where('id', User::ROLE_ADMIN)->get();

        $request->validate([
            'user_id' => 'integer',
            'report_date' => 'date',
            'event_type' => 'string',
            'workstation' => 'string',
            'comments' => 'string'

        ]);

        try {

            SundayReport::create([
                'user_id' => $id,
                'report_date' => $request->report_date,
                'event_type' => $request->event_type,
                'workstation' => $request->workstation,
                'comments' => $request->report_comments
            ]);

            // dd($request);
            $data = [
                'subject' => 'Sunday Report Submission',
                'message' => 'This is to notify you that ' . auth()->user()->name . ' has submitted their report!!',
                'salutation' => 'Kind regards, ' . auth()->user()->name
            ];

            // send a notification to admin to notify that a report has been submitted
            Notification::send($user, new SundayReportSubmissions(auth()->user()->name, $data));

            return redirect()->route('user.sunday-report.index', [auth()->user()->id])->with('success_message', 'Report created successfully!!');
        } catch (\Throwable $th) {
            return redirect()->route('user.sunday-report.index', [auth()->user()->id])->with('error_message', $th->getMessage());
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

        if (!$report->delete()) {
            return redirect()->route('user.sunday-report.index', $user_id)->with('error_message', 'Error! Please try agaain');
        } else {
            return redirect()->route('user.sunday-report.index', $user_id)->with('success_message', 'Report deleted successfully!!');
        }
    }

    public function downloadReportsAsAPDF()
    {

        $allReports = SundayReport::all();
        // dd($request);

        // load the PDF file
        view()->share('reports', $allReports);
        $pdf = FacadePdf::loadView('admin.sunday-reports.pdf-view');

        // dd($pdf);
        // store these PDF'S in a table, with the name, doc_type, path, text, etc
        return $pdf->download(Carbon::now() . '-sunday-report.pdf');
    }

    /**
     * Get all the previous reports for other Sundays
     */
    public function getAllPreviousReportDocuments()
    {
        dd('Get all the previous report docs');
    }
}
