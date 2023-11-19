<x-app-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="duty-schedule"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navigation titlePage="Duty Schedule"></x-navbars.navigation>

        <div class="container-fluid py-4">
            <br>

            <!-- check if leave is empty -->
            @if ($duties->isEmpty())
            <div class="text-center mt-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
            </svg>
            <h3 class="mt-5">NO ROSTER CREATED YET</h3>
            <p class="mt-4 mx-auto">Schedule has not yet been uploaded. Check later for updates...</p>

        </div>

            @else
            @foreach ($duties as $duty)
            <a class="btn bg-gradient-secondary mt-0 mx-4 mb-3">
                <i class="material-icons px-1">event_note</i>
                VIEW PREVIOUS TIMETABLES
            </a>

            <a class="btn bg-gradient-secondary mt-0 mx-12 mb-3" href="{{ route('user.downloadSchedule') }}">
                <i class="material-icons px-1 align-middle">cloud_download</i>
                DOWNLOAD THE DUTY ROSTER
            </a>

            <div class="card border-primary pt-0 mb-3">
                <!-- <span class="badge badge-primary pt-3 font-medium justify-end">Posted on: {{$duty->updated_at}}</span> -->
                <span class="badge bg-gradient-info my-auto mt-3 mx-auto text-right">Posted on: {{$duty->updated_at}}</span>
                <div class="card-body">
                    <h2 class="card-title mb-3"><b>Week: {{$duty->week}}</b></h2>
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
