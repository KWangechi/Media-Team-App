        <div class="container">
            <br>

            <!-- convert it into a date that can be read(ISO String) -->
            <h3 style="margin-left: 10px;">{{$reports[0]->report_date}}</h3>

            <p style="margin-left: 10px;">Below are the reports for the workstations and the challenges faced: </p>

            @foreach ($reports as $report)
            <h4 style="margin-left: 10px;">{{$report->event_type}}</h4>

            <li style="margin-left: 50px;">{{$report->workstation}}</li>

            <p style="margin-left: 20px;">{{$report->comments}}</p>
            @endforeach

            <br>
            <div class="row" style="margin-left: 10px;">

                Name: ..............................................
                <p style="margin-top: 15px;">Chairperson's Signature........................................</p>

            </div>
            <br>
            <div class="row" style="margin-left: 10px;">
                Name: ...............................................
                <p style="margin-top: 15px;">Church Admin's Signature........................................</p>
            </div>

        </div>
