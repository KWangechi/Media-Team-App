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

            <a class="btn btn-primary btn-sm float-right" id="createDutyRosterModalButton">
                <i class="bi bi-plus-circle"></i>
                CREATE NEW DUTY ROSTER</a>

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

                                <!-- Week of the year when the duty is assigned -->
                                <div class="mt-4">
                                    <x-label for="week" :value="__('Week')" />

                                    <x-input class="block mt-1 w-full" id="week" name="week" type="week" autofocus placeholder="eg. Week 10" />
                                </div>


                                <!-- Member Name -->
                                <div class="mt-4">
                                    <x-label for="member_name" :value="__('Member Name')" />

                                    <x-input class="block mt-1 w-full" id="member_name" name="duty_personel_details[member_name]" type="text" autofocus placeholder="eg. Nimoh Kamau" />
                                </div>

                                <!-- Supervisor Name -->
                                <div class="mt-4">
                                    <x-label for="supervisor_name" :value="__('Supervisor Name')" />

                                    <x-input class="block mt-1 w-full" id="supervisor_name" name="duty_personel_details[supervisor_name]" type="text" autofocus placeholder="eg. RKay" />
                                </div>

                                <!-- Workstation -->
                                <div class="mt-4">
                                    <x-label for="workstation" :value="__('Workstation')" />

                                    <x-input id="workstation" class="block mt-1 w-full" type="text" name="duty_personel_details[workstation]" required placeholder="eg. Video, VMix" />
                                </div>


                                <!-- Duty Assigned -->
                                <div class="mt-4">
                                    <x-label for="duty_assigned" :value="__('Duty Assigned')" />

                                    <x-input id="duty_assigned" class="block mt-1 w-full" type="text" name="duty_personel_details[duty_assigned]" required placeholder="eg. Check on Sound Quality" />
                                </div>

                                <!-- Type of Service or Event -->
                                <div class="mt-4">
                                    <x-label for="type_of_service" :value="__('Type of Service')" />

                                    <select name="duty_personel_details[type_of_service]">
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
            <a class="btn btn-primary btn-sm text-center float-right" id="createDutyRosterModalButton">
                <i class="bi bi-plus-circle"></i>
                CREATE NEW DUTY ROSTER</a>

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

                                <!-- Week of the year when the duty is assigned -->
                                <div class="mt-4">
                                    <x-label for="week" :value="__('Week')" />

                                    <x-input class="block mt-1 w-full" id="week" name="week" type="week" autofocus placeholder="eg. Week 10" />
                                </div>

                                @for ($i=0; $i<=4; $i++) <!-- Member Name -->
                                    <div class="mt-4">
                                        <x-label for="member_name" :value="__('Member Name')" />

                                        <x-input class="block mt-1 w-full" id="member_name" name="duty_personel_details[{{$i}}][member_name]" type="text" autofocus placeholder="eg. Nimoh Kamau" />
                                    </div>

                                    <!-- Supervisor Name -->
                                    <div class="mt-4">
                                        <x-label for="supervisor_name" :value="__('Supervisor Name')" />

                                        <x-input class="block mt-1 w-full" id="supervisor_name" name="duty_personel_details[{{$i}}][supervisor_name]" type="text" autofocus placeholder="eg. RKay" />
                                    </div>

                                    <!-- Workstation -->
                                    <div class="mt-4">
                                        <x-label for="workstation" :value="__('Workstation')" />

                                        <x-input id="workstation" class="block mt-1 w-full" type="text" name="duty_personel_details[{{$i}}][workstation]" required placeholder="eg. Video, VMix" />
                                    </div>


                                    <!-- Duty Assigned -->
                                    <div class="mt-4">
                                        <x-label for="duty_assigned" :value="__('Duty Assigned')" />

                                        <x-input id="duty_assigned" class="block mt-1 w-full" type="text" name="duty_personel_details[{{$i}}][duty_assigned]" required placeholder="eg. Check on Sound Quality" />
                                    </div>

                                    <!-- Type of Service or Event -->
                                    <div class="mt-4">
                                        <x-label for="type_of_service" :value="__('Type of Service')" />

                                        <select name="duty_personel_details[{{$i}}][type_of_service]">
                                            <option value="">-- Select Type of Service --</option>
                                            <option value="1st Service">1st Service</option>
                                            <option value="2nd Service">2nd Service</option>
                                            <option value="Gwav Service">GWAV Service</option>
                                            <option value="Wedding">Wedding</option>
                                            <option value="Funeral">Funeral</option>
                                            <option value="Graduation">Graduation</option>

                                        </select>
                                    </div>

                                    @endfor


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

            <br>
            <br>

            <!-- card for displaying the duty roster -->
            @foreach ($duties as $duty)
            <div class="card border-primary mb-3 mx-auto" style="width: max-content; height: max-content;">
                <div class="card-body">
                    <h1 class="card-title mb-4"><b>Week {{$duty->week}}</b></h1>
                    <hr>
                    <p class="card-text mb-4">Date assigned: {{$duty->date_assigned}}</p>
                    <hr>
                    <p class="card-text mb-4">Setup Time: {{$duty->setup_time}}</p>
                    <hr>
                    <!-- <p class="card-text mb-4">Supervisor Name: {{$duty->supervisor_name}}</p> -->
                    <br>
                    <!-- Button trigger modal -->
                    <x-button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="bi bi-plus-circle"></i>
                        Add a new member's details
                    </x-button>

                    <!-- Modal for creating new duties for a media team member  -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Duty Personnel Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="createDutyRoster" action="{{ route('admin.duty.updateDutyPersonelDetails', $duty->id )}}">
                                        @csrf

                                        <!-- Member Name -->
                                        <div class="mt-4">
                                            <x-label for="member_name" :value="__('Member Name')" />

                                            <x-input class="block mt-1 w-full" id="member_name" name="duty_personel_details[member_name]" type="text" autofocus placeholder="eg. Nimoh Kamau" />
                                        </div>

                                        <!-- Supervisor Name -->
                                        <div class="mt-4">
                                            <x-label for="supervisor_name" :value="__('Supervisor Name')" />

                                            <x-input class="block mt-1 w-full" id="supervisor_name" name="duty_personel_details[supervisor_name]" type="text" autofocus placeholder="eg. RKay" />
                                        </div>

                                        <!-- Workstation -->
                                        <div class="mt-4">
                                            <x-label for="workstation" :value="__('Workstation')" />

                                            <x-input id="workstation" class="block mt-1 w-full" type="text" name="duty_personel_details[workstation]" required placeholder="eg. Video, VMix" />
                                        </div>


                                        <!-- Duty Assigned -->
                                        <div class="mt-4">
                                            <x-label for="duty_assigned" :value="__('Duty Assigned')" />

                                            <x-input id="duty_assigned" class="block mt-1 w-full" type="text" name="duty_personel_details[duty_assigned]" required placeholder="eg. Check on Sound Quality" />
                                        </div>

                                        <!-- Type of Service or Event -->
                                        <div class="mt-4">
                                            <x-label for="type_of_service" :value="__('Type of Service')" />

                                            <select name="duty_personel_details[type_of_service]">
                                                <option value="">-- Select Type of Service --</option>
                                                <option value="1st Service">1st Service</option>
                                                <option value="2nd Service">2nd Service</option>
                                                <option value="Gwav Service">GWAV Service</option>
                                                <option value="Wedding">Wedding</option>
                                                <option value="Funeral">Funeral</option>
                                                <option value="Graduation">Graduation</option>

                                            </select>
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

                    <br>
                    <!-- put a table view in a card body -->
                    <div class="card mb-3 mt-4" style="width: max-content; height: max-content; align-items: center;">
                        <!-- <table> -->
                        <table class="table table-responsive table-striped text-center table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Member Name</th>
                                    <th scope="col">Supervisor Name</th>
                                    <th scope="col">Workstation</th>
                                    <th scope="col">Duty Assigned</th>
                                    <th scope="col">Type of Service</th>
                                    <th scope="col">EDIT</th>
                                    <th scope="col">DELETE</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($duty->duty_personel_details as $new_duty)

                                <tr>
                                    <td>{{$new_duty['member_name']}}</td>
                                    <td>{{$new_duty['supervisor_name']}}</td>
                                    <td>{{$new_duty['workstation']}}</td>
                                    <td>{{$new_duty['duty_assigned']}}</td>
                                    <td>{{$new_duty['type_of_service']}}</td>
                                    <td>
                                        <div>
                                            <a class="btn btn-secondary btn-sm" id="updateProfileButton" data-id="{{$duty->id}}" href="{{route('admin.duty.edit', $duty->id)}}">EDIT</a>
                                        </div>
                                    </td>

                                    <!-- <td>
                                        <div>
                                            <a class="btn btn-secondary btn-sm" id="getDutyRosterId" data-id="{{$duty->id}}" href="{{route('admin.duty.updateDutyPersonelDetails', $duty->id)}}">GET DUTY ROSTER ID</a>
                                        </div>

                                    </td> -->

                                    <td>
                                        <form action="{{ route('admin.duty.delete', [$duty->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button id="deleteLeaveButton" class="btn btn-danger btn-sm">
                                                DELETE
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($duty->supervisor_signature == 1)
                    <p class="card-text mb-4">Supervisor Signature: Signed</p>
                    @else
                    <p class="card-text mb-4">Supervisor Signature: Pending</p>
                    @endif


                </div>
            </div>
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
