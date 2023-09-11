<x-app-layout>
    <x-slot name="slot">
        <div class="container">
            <br>

            <!-- Display error or success message -->
            @if (session('success_message'))
            <div class="alert alert-success alert-dismissible fade show mx-auto text-center" style="max-width: 700px;">
                {{ session('success_message') }}
                <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>

            @elseif (session('error_message'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error_message') }}
                <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>
            @endif

            <!-- check if leave is empty -->
            @if ($duties->isEmpty())
            <div class="alert alert-info alert-dismissible">
                The duty roster is not yet uploaded
            </div>

            <a class="btn btn-primary btn-sm float-left" id="createDutyRosterModalButton" data-bs-toggle="modal" data-bs-target="#createDutyRosterModal">
                <i class="bi bi-plus-circle"></i>
                CREATE NEW DUTY ROSTER</a>

            <!-- Create Duty Roster Modal -->
            <div class="modal fade" id="createDutyRosterModal" tabindex="-1" aria-labelledby="createDutyRosterModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createDutyRosterTitle">Create a New Duty Roster</h5>
                            <a class="btn-close" id="closeModalButton" data-bs-dismiss="modal" aria-label="Close"></a>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="createLeaveForm" action="{{ route('admin.duty.create', auth()->user()->id )}}">
                                @csrf

                                <div class="mt-4">
                                    <x-input class="block mt-1 w-full" id="duty_id" name="duty_id" type="number" hidden />
                                </div>

                                <!-- Week of the year when the duty is assigned -->
                                <div class="mt-4">
                                    <x-label for="week" :value="__('Week')" />

                                    <x-input class="block mt-1 w-full" id="week" name="week" type="week" autofocus placeholder="eg. Week 10" />
                                </div>


                                <!-- Member Name -->
                                <div class="mt-4">
                                    <x-label for="member_name" :value="__('Member Name')" />
                                    <select name="member_name" id="member_name" class="block mt-1 w-full rounded shadow-sm">
                                        @foreach ($users as $user)
                                        <option value="{{$user->name}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <x-input class="block mt-1 w-full" id="member_name" name="member_name" type="text" autofocus placeholder="eg. Nimoh Kamau" /> -->
                                </div>


                                <!-- Workstation -->
                                <div class="mt-4">
                                    <x-label for="workstation" :value="__('Workstation')" />

                                    <x-input id="workstation" class="block mt-1 w-full" type="text" name="workstation" required placeholder="eg. Video, VMix" />
                                </div>


                                <!-- Duty Assigned -->
                                <div class="mt-4">
                                    <x-label for="duty_assigned" :value="__('Duty Assigned')" />

                                    <x-input id="duty_assigned" class="block mt-1 w-full" type="text" name="duty_assigned" required placeholder="eg. Check on Sound Quality" />
                                </div>

                                <!-- Type of Service or Event -->
                                <div class="mt-4">
                                    <x-label for="event_type" :value="__('Type of Event')" />

                                    <select name="event_type">
                                        <option value="" selected disabled>-- Select an event type --</option>
                                        <option value=""><a id="createNewEventType" class="btn btn-info btn-sm">Add a new event</a></option>
                                        <option value="1st Service">1st Service</option>
                                        <option value="2nd Service">2nd Service</option>
                                        <option value="Gwav Service">GWAV Service</option>
                                        <option value="Wedding">Wedding</option>
                                        <option value="Funeral">Funeral</option>
                                        <option value="Graduation">Graduation</option>

                                    </select>
                                </div>

                                <!-- Setup Time -->
                                <div class="mt-4">
                                    <x-label for="setup_time" :value="__('Setup Time')" />

                                    <x-input id="setup_time" class="block mt-1 w-full" type="time" name="setup time" required />
                                </div>

                                <!-- Date Assigned -->
                                <div class="mt-4">
                                    <x-label for="date_assigned" :value="__('Date Assigned')" />

                                    <x-input id="date_assigned" class="block mt-1 w-full" type="date" name="date_assigned" required />
                                </div>


                                <br>
                                <x-button class="ml-4">
                                    {{ __('Save') }}
                                </x-button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
            </div>

            @else
            <a class="btn btn-primary btn-sm text-center float-left" id="createDutyRosterModalButton" data-bs-toggle="modal" data-bs-target="#createDutyRosterModal">
                <i class="bi bi-plus-circle"></i>
                CREATE NEW DUTY ROSTER</a>

            <!-- Will reuse this same modal for the update -->
            <div class="modal fade" id="createDutyRosterModal" tabindex="-1" aria-labelledby="createDutyRosterModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createDutyRosterTitle">Create a New Duty Roster</h5>
                            <a class="btn-close" id="closeModalButton" data-bs-dismiss="modal" aria-label="Close"></a>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="createDutyRosterForm" action="{{ route('admin.duty.create', auth()->user()->id )}}">
                                @csrf

                                <!-- Week of the year when the duty is assigned -->
                                <div class="mt-2">
                                    <x-label for="week" :value="__('Week')" />

                                    <x-input class="block mt-1 w-full" id="week" name="week" type="week" autofocus placeholder="eg. Week 10" />
                                </div>

                                <!-- Date Assigned -->
                                <div class="mt-4">
                                    <x-label for="date_assigned" :value="__('Date Assigned')" />

                                    <x-input id="date_assigned" class="block mt-1 w-full" type="date" name="date_assigned" required />
                                </div>

                                <!-- Setup Time -->
                                <div class="mt-4">
                                    <x-label for="setup_time" :value="__('Setup Time')" />

                                    <x-input id="setup_time" class="block mt-1 w-full" type="time" name="setup time" required />
                                </div>


                                <!-- Member Name -->
                                <div class="mt-4">
                                    <x-label for="member_name" :value="__('Member Name')" />
                                    <select name="member_name" id="member_name" class="block mt-1 w-full rounded shadow-sm">
                                        @foreach ($users as $user)
                                        <option value="{{$user->name}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <x-input class="block mt-1 w-full" id="member_name" name="member_name" type="text" autofocus placeholder="eg. Nimoh Kamau" /> -->
                                </div>

                                <!-- Workstation -->
                                <div class="mt-4">
                                    <x-label for="workstation" :value="__('Workstation')" />

                                    <x-input id="workstation" class="block mt-1 w-full" type="text" name="workstation" required placeholder="eg. Video, VMix" />
                                </div>


                                <!-- Duty Assigned -->
                                <div class="mt-4">
                                    <x-label for="duty_assigned" :value="__('Duty Assigned')" />

                                    <x-input id="duty_assigned" class="block mt-1 w-full" type="text" name="duty_assigned" required placeholder="eg. Check on Sound Quality" />
                                </div>

                                <!-- Type of Service or Event -->

                                <div class="mt-4">
                                    <x-label for="Event Name" :value="__('Event Name')" class="mt-3" />

                                    <x-input id="event_type" class="block mt-1 w-full" type="text" name="event_type" placeholder="eg. Mission in Mosiro" />
                                </div>

                                <br>
                                <x-button class="ml-4">
                                    {{ __('Save') }}
                                </x-button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <br>

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
                    <x-button type="button" class="btn btn-primary float-left pl-20" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$duty->id}}" id="createMemberDetails" data-id="{{$duty->id}}">
                        <i class="bi bi-plus-circle"></i>
                        Add a new member's details
                    </x-button>

                    <!-- Modal for creating new duties for a media team member  -->
                    <!-- Reuse this form -->
                    <br>

                    <!-- Add new member details -->
                    <div class="modal fade" id="staticBackdrop{{$duty->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false" data-id="{{$duty->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Duty Personnel Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="createDutyPersonel" action="{{ route('admin.duty.createDutyPersonelDetails',[$duty->id])}}">
                                        @csrf
                                        <!-- Member Name -->
                                        <div class="mt-1">
                                            <x-label for="member_name" :value="__('Member Name')" />
                                            <select name="member_name" id="member_name" class="block mt-1 w-full rounded shadow-sm">
                                                @foreach ($users as $user)
                                                <option value="{{$user->name}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                            <!-- <x-input class="block mt-1 w-full" id="member_name" name="member_name" type="text" autofocus placeholder="eg. Nimoh Kamau" /> -->
                                        </div>

                                        <!-- Workstation -->
                                        <div class="mt-4">
                                            <x-label for="workstation" :value="__('Workstation')" />

                                            <x-input id="workstation" class="block mt-1 w-full" type="text" name="workstation" required placeholder="eg. Video, VMix" />
                                        </div>


                                        <!-- Duty Assigned -->
                                        <div class="mt-4">
                                            <x-label for="duty_assigned" :value="__('Duty Assigned')" />

                                            <x-input id="duty_assigned" class="block mt-1 w-full" type="text" name="duty_assigned" required placeholder="eg. Check on Sound Quality" />
                                        </div>

                                        <!-- Type of Service or Event -->
                                        <!-- <div class="mt-4">
                                                        <x-label for="event_type" :value="__('Event Type')" />

                                                        <select name="event_type">
                                                            <option value="" selected disabled>-- Select Type of Event --</option>
                                                            <option value="" selected>-- Type instead --</option>
                                                            <option value="1st Service">Sunday 1st Service</option>
                                                            <option value="2nd Service">Sunday 2nd Service</option>
                                                            <option value="Gwav Service">Sunday GWAV Service</option>
                                                            <option value="Wedding">Wedding</option>
                                                            <option value="Funeral">Funeral</option>
                                                            <option value="Graduation">Graduation</option>

                                                        </select>

                                                    </div> -->
                                        <div class="mt-4">
                                            <x-label for="Event Name" :value="__('Event Name / Event Type')" class="mt-3" />

                                            <x-input id="event_type" class="block mt-1 w-full" type="text" name="event_type" placeholder="eg. Mission in Mosiro" />
                                        </div>

                                        <div class="modal-footer">
                                            <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button> -->

                                            <a class="btn btn-danger btn-sm" id="cancelDutyRosterModalButton" data-bs-dismiss="modal">Cancel</a>

                                            <button class="btn btn-primary btn-sm">Save</button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>


                    <!-- put a table view in a card body -->
                    <div class="card mb-3 mt-4" style="width: max-content; height: max-content; align-items: center;">
                        <!-- <table> -->
                        <table class="table table-responsive table-striped text-center table-bordered">
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
    </x-slot>
</x-app-layout>
