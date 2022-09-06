<x-app-layout>
    <x-slot name="slot">
        <div class="container">
            <br>
            <!-- Display error or success message -->
            @if (session('success_message'))
            <div class="alert alert-success alert-dismissible fade show">
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

            <a class="btn btn-primary btn-sm text-center" id="createDutyRosterModalButton">CREATE NEW DUTY ROSTER</a>

            <!-- Create Duty Roster Modal -->
            <div class="modal" id="createDutyRosterModal" tabindex="-1" aria-labelledby="createDutyRosterModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createDutyRosterTitle">Create a New Duty Roster</h5>
                            <a class="btn-close" id="closeModalButton" data-bs-dismiss="modal" aria-label="Close"></a>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="createLeaveForm" action="{{ route('admin.duty.create', auth()->user()->id )}}">
                                @csrf

                                <!-- Member Name -->
                                <div class="mt-4">
                                    <x-label for="member_name" :value="__('Member Name')" />

                                    <x-input class="block mt-1 w-full" id="member_name" name="member_name" type="text" autofocus placeholder="eg. Nimoh Kamau" />
                                </div>

                                <!-- Supervisor Name -->
                                <div class="mt-4">
                                    <x-label for="supervisor_name" :value="__('Supervisor Name')" />

                                    <x-input class="block mt-1 w-full" id="supervisor_name" name="supervisor_name" type="text" autofocus placeholder="eg. RKay" />
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
                                    <x-label for="type_of_service" :value="__('Type of Service')" />

                                    <select name="type_of_service">
                                        <option value="">-- Select Type of Service --</option>
                                        <option value="1st Service">1st Service</option>
                                        <option value="2nd Service">2nd Service</option>
                                        <option value="Gwav Service">GWAV Service</option>
                                        <option value="Wedding">Wedding</option>
                                        <option value="Funeral">Funeral</option>
                                        <option value="Graduation">Graduation</option>

                                    </select>
                                </div>

                                <!-- Supervisor signature -->
                                <div class="mt-4">
                                    <x-label for="supervisor_signature" :value="__('Supervisor Signature')" />

                                    <select name="supervisor_signature" class="block mt-2 w-full">
                                        <option value="0">Pending</option>
                                        <option value="1">Signed</option>
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
            <a class="btn btn-primary btn-sm text-center float-right" id="createDutyRosterModalButton">CREATE NEW DUTY ROSTER</a>

            <div class="modal" id="createDutyRosterModal" tabindex="-1" aria-labelledby="createDutyRosterModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createDutyRosterTitle">Create a New Duty Roster</h5>
                            <a class="btn-close" id="closeModalButton" data-bs-dismiss="modal" aria-label="Close"></a>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="createLeaveForm">
                                @csrf

                                <!-- Member Name -->
                                <div class="mt-4">
                                    <x-label for="member_name" :value="__('Member Name')" @keyup="" />

                                    <x-input class="block mt-1 w-full" id="member_name" name="member_name" type="text" autofocus placeholder="eg. Nimoh Kamau" />
                                </div>

                                <!-- Supervisor Name -->
                                <div class="mt-4">
                                    <x-label for="supervisor_name" :value="__('Supervisor Name')" />

                                    <x-input class="block mt-1 w-full" id="supervisor_name" name="supervisor_name" type="text" autofocus placeholder="eg. RKay" />
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
                                    <x-label for="type_of_service" :value="__('Type of Service')" />

                                    <select name="type_of_service">
                                        <option value="1st Service">1st Service</option>
                                        <option value="2nd Service">2nd Service</option>
                                        <option value="Gwav Service">GWAV Service</option>
                                        <option value="Wedding">Wedding</option>
                                        <option value="Funeral">Funeral</option>
                                        <option value="Graduation">Graduation</option>

                                    </select>
                                </div>

                                <!-- Supervisor signature -->
                                <div class="mt-4">
                                    <x-label for="supervisor_signature" :value="__('Supervisor Signature')" />

                                    <select name="supervisor_signature">
                                        <option value="0">Pending</option>
                                        <option value="1">Signed</option>
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


            <!-- Table -->
            <br>
            <br>

            <!-- <table class="table table-responsive table-bordered table-striped text-center"> -->
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Member Name</th>
                    <th scope="col">Supervisor Name</th>
                    <th scope="col">Workstation</th>
                    <th scope="col">Duty Assigned</th>
                    <th scope="col">Type of Service</th>
                    <th scope="col">Supervisor Signature</th>
                    <th scope="col">Setup Time</th>
                    <th scope="col">Date Assigned</th>
                    <th scope="col">EDIT</th>
                    <th scope="col">DELETE</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($duties as $duty)
                <tr>
                    <td>{{$duty->id}}</td>
                    <td>{{$duty->member_name}}</td>
                    <td>{{$duty->supervisor_name}}</td>
                    <td>{{$duty->workstation}}</td>
                    <td>{{$duty->duty_assigned}}</td>
                    <td>
                        {{$duty->type_of_service}}
                    </td>

                    <td>
                        {{$duty->supervisor_signature}}
                    </td>
                    <td>
                        {{$duty->setup_time}}
                    </td>
                    <td>
                        {{$duty->date_assigned}}
                    </td>
                    <td>
                        <div>
                            <a class="btn btn-secondary btn-sm" id="updateProfileButton" data-id="{{$duty->id}}" href="{{route('admin.duty.edit', $duty->id)}}">EDIT</a>
                        </div>

                        <!-- Update Leave Request -->



                    </td>
                    <td>
                        <form action="{{ route('admin.duty.delete', [$duty->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="deleteLeaveButton" class="btn btn-danger btn-sm">
                                DELETE
                            </button>
                        </form>
                    </td>

                    <!-- Update Modal -->

                    <!-- </div> -->

                    <!-- @endforeach -->
                    <!-- </tr>
        </tbody>
        </table> -->
                    <br>
                    <!-- Pagination -->
                    @foreach ($duties as $duty)

                    <div class="card border-primary mb-3" style="width: 50%; height: 280px;">
                        <div class="card-body">
                            <h5 class="card-title">Week 5</h5>
                            <p class="card-text">Date assigned: {{$duty->date_assigned}}</p>
                            <br>
                            <p class="card-text">Setup Time: {{$duty->setup_time}}</p>
                            <br>
                            <p class="card-text">Supervisor Name: {{$duty->supervisor_name}}</p>
                            <br>
                            @if ($duty->supervisor_signature == 1)
                            <p class="card-text">Supervisor Signature: Signed</p>
                            @else
                            <p class="card-text">Supervisor Signature: Pending</p>
                            @endif

                        </div>
                    </div>
                    <br>
                    @endforeach

                    @endif

        </div>
    </x-slot>
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
