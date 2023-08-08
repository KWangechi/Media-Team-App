<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SundayReport;
use App\Models\User;
use App\Notifications\SundayReportSubmissions;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
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

        return view('user.sunday-report.index', [auth()->user()->id], compact('reports'));
    }

    public function getAllReports()
    {
        $reports = SundayReport::paginate(10);

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

            $report = SundayReport::create([
                'user_id' => $id,
                'report_date' => $request->report_date,
                'event_type' => $request->event_type,
                'workstation' => $request->workstation,
                'comments' => $request->report_comments
            ]);

            dd($request);

            // send a notification to admin to notify that a report has been submitted
            Notification::send($user, new SundayReportSubmissions(auth()->user()->name));

            // return redirect()->route('user.sunday-report.index', [auth()->user()->id])->with('success_message', 'Report created successfully!!');


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
        return $pdf->download('pdf_file.pdf');


        // view()->share('reports', $allReports);


        // if ($request->has('download')) {

        //     $pdf = FacadePdf::loadView('admin.sunday-reports.pdf-view');
        //     return $pdf->download('pdfview.pdf');
        // }

        // return view('admin.sunday-reports.pdf-view', compact('id'));
    }
}
