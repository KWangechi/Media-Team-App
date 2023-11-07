            <div class="container-fluid py-4">

                @foreach ($duties as $duty)

                <div class="card border-primary pt-0 mb-3 mx-3 w-max h-max">

                    <!-- <span class="badge badge-primary pt-3 font-medium justify-end">Posted on: {{$duty->updated_at}}</span> -->
                    <span class="badge bg-gradient-info my-auto mt-3 mx-auto text-right">Posted on: {{$duty->updated_at}}</span>
                    <div class="card-body">
                        <h2 class="card-title mb-3"><b>Week: {{$duty->week}} {{$duty->id}}</b></h2>
                        <hr>
                        <div class="card-item">
                            <p class="card-text mb-3 mt-2">Date assigned: {{$duty->date_assigned}}</p>
                        </div>
                        <hr>
                        <div class="card-item">
                            <p class="card-text mb-3 mt-2">Setup Time: {{$duty->setup_time}}</p>
                        </div>
                        <hr>
                        <div class="card-item">
                            <p class="card-text mb-3 mt-2 font-weight-bolder">Members on Duty: </p>
                        </div>

                        <!-- Table View for the other members -->
                        <!-- put a table view in a card body -->

                        <div class="card mb-3 mt-4 w-max h-max align-middle">

                            <!-- <table> -->
                            <table class="table table-responsive table-bordered table-striped align-middle mt-3 p-5">

                                <thead>
                                    <tr>
                                        <th scope="col">Member Name</th>
                                        <th scope="col">Workstation</th>
                                        <th scope="col">Duty Assigned</th>
                                        <th scope="col">Type of Event</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($duty->members as $new_duty)
                                    <tr>
                                        <td>{{$new_duty->member_name }}</td>
                                        <td>{{$new_duty->workstation}}</td>
                                        <td>{{$new_duty->duty_assigned}}</td>
                                        <td>{{$new_duty->event_type}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
