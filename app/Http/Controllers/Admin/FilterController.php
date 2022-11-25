<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filterLocation(Request $request)
    {
        if ($request->input('filter') == 'event_location') {
            $eventLocationFilter = Announcement::pluck('event_location')->toArray();

            return to_route('admin.announcements', compact($eventLocationFilter));
        } else if ($request->input('filter') == 'event_date') {
            $announcements = Announcement::pluck('event_date')->toArray();

            // dd($announcements);

            return redirect()->route('admin.announcements')->with('announcements');
        } else {
            return to_route('admin.announcements')->with('error_message', 'No results were found!!');
        }
    }

    public function fetchEventLocation(){
        $eventLocations = Announcement::pluck('event_location')->toArray();

        dd($eventLocations);


    }

    public function filterDate(){
        dd('Method for filtering with a date');
    }

    public function filterEventTime(){
        dd('This method will filter the event time!!');
    }

    public function filter(Request $request){

        if($request->input('filter') == 'event_date'){
            $eventDates = Announcement::pluck('event_date')->toArray();

            return to_route('admin.announcements', compact('eventDates'));
            // dd($eventDates);
            // // dd('Filter should apply to the event date only!!!');
        }

        else if($request->input('filter') == 'event_location'){
            $eventLocations = Announcement::pluck('event_location')->toArray();
            return to_route('admin.announcements', compact('eventLocations'));

            // dd($eventLocations);

            // dd('Filter should apply to the event location only!!!');

        }
        else{

            dd('Do whatever the fuck you want!');
        }
    }
}
