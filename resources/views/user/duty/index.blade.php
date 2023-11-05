<x-app-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="duty-roster"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navigation titlePage="Duty Roster"></x-navbars.navigation>

        <div class="container-fluid py-4">
            <br>

            <!-- check if leave is empty -->
            @if ($duties->isEmpty())
            <div class="alert alert-info alert-dismissible">
                The duty roster is not yet uploaded
            </div>

            @else
            @foreach ($duties as $duty)
            <a class="btn bg-gradient-secondary mt-0 mx-4 mb-3">
                <i class="material-icons px-1">event_note</i>
                VIEW PREVIOUS TIMETABLES
            </a>

            <a class="btn bg-gradient-secondary mt-0 mx-12 mb-3">
                <i class="material-icons px-1 align-middle">cloud_download</i>
                DOWNLOAD THE DUTY ROSTER
            </a>

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
                        <table class="table shadow-xl table-bordered-rounded table-responsive text-center">
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
    </main>

    <!-- Pagination -->


    @endif

    </div>
</x-app-layout>

<script>
    let createDutyRosterModal = document.querySelector("#createDutyRosterModal")
    let createDutyRosterModalButton = document.querySelector("#createDutyRosterModalButton")

    // createDutyRosterModalButton.addEventListener('click', function(){
    //     $("#createDutyRosterModal").fadeToggle();
    // })

    $(document).ready(function() {
        $("#createDutyRosterModalButton").on('click', function() {
            $("#createDutyRosterModal").modal('toggle');

            // console.log('Clicked the create duty roster modal');
        })

        // $("#closeModalButton").on('click', function(){
        //     $("#createDutyRosterModal").remove();
        // })
    })
</script>
