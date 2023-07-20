        <div class="container">
            <br>

            <div class="card">
                <table class="table table-responsive table-bordered table-striped align-middle mt-5 p-5">
                    <thead class="align-middle h-1">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Member Name</th>
                            <th scope="col">Last Login Time</th>
                            <th scope="col">Event Title</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Report Date</th>
                            <th scope="col">Workstation</th>
                            <th scope="col">Comments</th>
                            <th scope="colgroup">Actions</th>
                        </tr>
                    </thead>
                    <tbody style="word-wrap: break-word;">
                        @foreach ($reports as $key=>$report)
                        <tr>
                            <td>{{$report->id}}</td>
                            <td>{{$report->user->name}}</td>
                            <td>{{$report->user->login_time}}</td>
                            <td>{{$report->event_type}}</td>
                            <td>{{$report->user->phone_number}}</td>
                            <td>{{$report->report_date}}</td>
                            <td>{{$report->user->workstation}}</td>
                            <!-- <td>Sound Stage Management</td> -->
                            <td style="word-wrap: break-word;min-width: 160px;max-width: 190px;">{{$report->comments}}</td>

                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>


        </div>


        <style>

        </style>
