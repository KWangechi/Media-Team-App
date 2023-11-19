<x-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="admin-schedule-management"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navigation titlePage="Schedule Management"></x-navbars.navigation>
        <br>

        <!-- Display error or success message -->
        @if (session('success_message'))
        <div class="toast-container" style="position: absolute; top: 10px; right: 40px;" data-bs-animation="true" data-bs-delay="2000">
            <div class="toast fade show">
                <div class="toast-header">
                    <span class="badge bg-gradient-success mx-2">.</span>
                    <strong class="me-auto"><i class="bi-globe"></i>Success Message</strong>
                    <small>just now</small>
                    <button type="button" class="btn-close btn-sm bg-dark" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('success_message') }}
                </div>
            </div>
        </div>

        @elseif (session('error_message'))
        <div class="toast-container" style="position: absolute; top: 20px; right: 40px;" data-bs-animation="true" data-bs-delay="3000">
            <div class="toast fade show">
                <div class="toast-header">
                    <span class="badge bg-gradient-danger mx-2">.</span>
                    <strong class="me-auto"><i class="bi-globe"></i>Error Message</strong>
                    <small>just now</small>
                    <button type="button" class="btn-close btn-sm bg-dark" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{session('error_message')}}
                </div>
            </div>
        </div>
        @endif

        <!-- check if leave is empty -->
        @if ($duties->isEmpty())
        <div class="text-center mt-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
            </svg>
            <h3 class="mt-5">NO ROSTER CREATED YET</h3>
            <p class="mt-4 mx-auto">Schedule has not yet been uploaded. Click the link below to create</p>

            <a class="btn bg-gradient-primary mt-3 px-3 mx-auto" data-bs-toggle="modal" data-bs-target="#createDutyRosterModal" id="createLeaveModalButton">
                <i class="material-icons">calendar_month</i>
                Create a New Duty Roster
            </a>
        </div>

        <!-- Create Duty Roster Modal -->
        <div class="modal fade" id="createDutyRosterModal" tabindex="-1" aria-labelledby="createDutyRosterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Create a New Duty Roster</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.duty.create', auth()->user()->id )}}" method="POST" id="createLeaveForm">
                                    @csrf

                                    <input type="number" name="duty_id" id="duty_id" hidden>

                                    <label class="form-label font-weight-bold">Week</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="week" class="form-control" name="week" id="week" autofocus placeholder="e.g Week 13">
                                    </div>

                                    <label class="form-label font-weight-bold">Member Name</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <select class="form-select-md form-control" name="meber_name" id="member_name">
                                            <option value="" disabled selected>--Select an Option--</option>
                                            @foreach ($users as $user)
                                            <option value="{{$user->name}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label class="form-label font-weight-bold">Workstation</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <select class="form-select-md form-control" name="workstation" id="workstation" placeholder="--Select department--">
                                            <option value="" disabled selected>
                                                < --Select a workstation-->
                                            </option>
                                            <option value="Video">Video</option>
                                            <option value="Sound">Sound</option>
                                            <option value="Computer">Computer</option>
                                            <option value="Vmix">VMix</option>
                                        </select>
                                    </div>

                                    <label class="form-label font-weight-bold">Duty Assigned</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="text" class="form-control" name="duty_assigned" id="duty_assigned">
                                    </div>

                                    <label class="form-label font-weight-bold">Event Type</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="text" class="form-control" name="event_type" id="event_type">
                                    </div>

                                    <label class="form-label font-weight-bold">Setup Time</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="time" class="form-control" name="setup_time" id="setup_time">
                                    </div>


                                    <label class="form-label font-weight-bold">Date Assigned</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="date" class="form-control" name="date_assigned" id="date_assigned">
                                    </div>

                                    <div class="text-center ">
                                        <button type="submit" class=" btn btn-round btn-md bg-gradient-info w-30 mt-4 mb-0">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @else
        <a class="btn bg-gradient-secondary mx-4 py-2 px-3 mb-4" id="createDutyRosterModalButton" data-bs-toggle="modal" data-bs-target="#createDutyRosterModal">
            <i class="material-icons">add</i>
            CREATE NEW DUTY ROSTER
        </a>


        <!-- card for displaying the duty roster -->
        @foreach ($duties as $duty)
        <div class="card border-primary mb-3 mx-auto" style="width: max-content; height: max-content;">
            <div class="card-body">
                <h1 class="card-title mb-4"><b>Week: {{$duty->week}}</b></h1>
                <hr>
                <p class="card-text mb-3 mt-2">Date assigned: {{$duty->date_assigned}}</p>
                <hr>
                <p class="card-text mb-3 mt-2">Setup Time: {{$duty->setup_time}}</p>
                <hr>

                <br>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-left pl-20" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$duty->id}}" id="createMemberDetails" data-id="{{$duty->id}}">
                    <i class="material-icons">add</i>
                    Add a new member's details
                </button>

                <!-- Modal for creating new duties for a media team member  -->

                <!-- Add new member details -->
                <div class="modal fade" id="staticBackdrop{{$duty->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false" data-id="{{$duty->id}}">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h5 class="">Create a New Duty Roster</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" id="createDutyPersonel" action="{{ route('admin.duty.createDutyPersonelDetails',[$duty->id])}}">
                                            @csrf

                                            <label class="form-label font-weight-bold">Member Name</label>
                                            <div class="input-group input-group-outline mt-1 mb-3">
                                                <select class="form-select-md form-control" name="member_name" id="member_name">
                                                    <option value="" disabled selected>--Select an Option--</option>
                                                    @foreach ($users as $user)
                                                    <option value="{{$user->name}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <label class="form-label font-weight-bold">Workstation</label>
                                            <div class="input-group input-group-outline mt-1 mb-3">
                                                <select class="form-select-md form-control" name="workstation" id="workstation" placeholder="--Select department--">
                                                    <option value="" disabled selected>
                                                        < --Select a workstation-->
                                                    </option>
                                                    <option value="Video">Video</option>
                                                    <option value="Sound">Sound</option>
                                                    <option value="Computer">Computer</option>
                                                    <option value="Vmix">VMix</option>
                                                </select>
                                            </div>

                                            <label class="form-label font-weight-bold">Duty Assigned</label>
                                            <div class="input-group input-group-outline mt-1 mb-3">
                                                <input type="text" class="form-control" name="duty_assigned" id="duty_assigned">
                                            </div>

                                            <label class="form-label font-weight-bold">Event Type</label>
                                            <div class="input-group input-group-outline mt-1 mb-3">
                                                <input type="text" class="form-control" name="event_type" id="event_type">
                                            </div>


                                            <div class="modal-footer">
                                                <a class="btn btn-danger btn-sm" id="cancelDutyRosterModalButton" data-bs-dismiss="modal">Cancel</a>

                                                <button class="btn btn-primary btn-sm">Save</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- put a table view in a card body -->
                <div class="card mb-3 mt-4" style="width: max-content; height: max-content; align-items: center;">
                    <!-- <table> -->
                    <table class="table table-responsive align-items-center justify-content-center mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Member Name</th>
                                <th scope="col">Workstation</th>
                                <th scope="col">Duty Assigned</th>
                                <th scope="col">Type of Event</th>
                                <th scope="col">EDIT</th>
                                <th scope="col">DELETE</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($duty->members as $new_duty)

                            <tr>
                                <td>{{$new_duty->member_name }}</td>
                                <td>{{$new_duty->workstation}}</td>
                                <td>{{$new_duty->duty_assigned}}</td>
                                <td>{{$new_duty->event_type}}</td>

                                <td>
                                    <a href="{{route('admin.duty.editDutyPersonelDetails', $new_duty->id)}}">
                                        <button class="btn btn-secondary btn-sm" id="editMemberDetails">EDIT</button>
                                    </a>
                                </td>

                                <td>
                                    <form action="{{route('admin.duty.deleteDutyPersonelDetails', [$new_duty->id])}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"> DELETE</button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer text-center flex justify-content-between">
                <div class="col-4 align-items-start">

                    <a href="{{ route('admin.duty.roster.edit', $duty->id) }}" class="btn btn-secondary">EDIT DUTY ROSTER</a>
                </div>

                <div class="col-6">
                    <form action="{{ route('admin.duty.roster.delete', $duty->id) }}" method="POST" class="float-right col">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger ml-12">DELETE DUTY ROSTER</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        @endif

        </div>
    </main>
</x-layout>
