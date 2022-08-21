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
            @if ($leaves->isEmpty())
            <div class="alert alert-info alert-dismissible">
                You do not have any leaves
            </div>
            <a class="btn btn-primary btn-sm text-center" id="createLeaveModalButton">

                <i class="bi bi-plus-circle"></i>
                CREATE NEW LEAVE REQUEST
            </a>


            @else
            <a class="btn btn-primary btn-sm text-center float-right" data-bs-toggle="modal" data-bs-target="#createLeaveModal" id="createLeaveModalButton">
                <i class="bi bi-plus-circle"></i>
                CREATE NEW LEAVE REQUEST
            </a>

            <!-- Create Leave Request Modal -->
            <div class="modal fade" id="createLeaveModal" tabindex="-1" aria-labelledby="createLeaveModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="createLeaveModalTitle">Create a New Leave Request</h5>
                            <a class="btn-close" id="closeModalButton" data-bs-dismiss="modal" aria-label="Close"></a>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user.leave.create', auth()->user()->id) }}" method="POST" id="createLeaveForm">
                                @csrf

                                <!-- Reason -->
                                <div class="mt-4">
                                    <x-label for="reason" :value="__('Reason')" />
                                    <select name="reason">
                                        <option value="">Select the reason</option>
                                        <option value="Sickness">Sickness</option>
                                        <option value="Bereavement">Bereavement</option>
                                        <option value="Travelling">Travelling</option>
                                        <option value="Personal Reasons">Personal Reasons(Prefer not to say)</option>
                                    </select>
                                </div>

                                <!-- Start Date -->
                                <div class="mt-4">
                                    <x-label for="start_date" :value="__('Start Date')" />

                                    <x-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" required />
                                </div>

                                <!-- error message for start date and end date -->
                                <!-- @if (session('leave_error_message'))
                                <div class="input">
                                    {{ session('leave_error_message') }}
                                </div>
                                @else
                                @endif -->

                                <!-- error leave message -->
                                <div class="input" id="input">
                                </div>

                                <!-- End Date -->
                                <div class="mt-4">
                                    <x-label for="end_date" :value="__('End Date')" />

                                    <x-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" required />
                                </div>
                                <br>
                                <x-button class="ml-4" id="createLeaveButton">
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
            <table class="table table-responsive table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">EDIT</th>
                        <th scope="col">DELETE</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($leaves as $leave)
                    <tr>
                        <td>{{$leave->id}}</td>
                        <td>{{$leave->user_id}}</td>
                        <td>{{$leave->reason}}</td>
                        <td>{{$leave->start_date}}</td>
                        <td>{{$leave->end_date}}</td>
                        <td>
                            {{$leave->status}}
                        </td>
                        <td>
                            <div>
                                <a class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#updateProfileModal" id="updateProfileButton" data-id="{{$leave->id}}">EDIT</a>
                            </div>

                            <!-- Update Leave Request -->
                            <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true" data-id="{{$leave->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel">Update Leave Request</h5>
                                            <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('user.leave.update', [auth()->user()->id, $leave->id]) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')

                                                <!-- Reason -->
                                                <div class="mt-4">
                                                    <x-label for="reason" :value="__('Reason')" />
                                                    <select name="reason">
                                                        <option value="{{$leave->reason}}">{{$leave->reason}}</option>
                                                        <option value="Sickness">Sickness</option>
                                                        <option value="Bereavement">Bereavement</option>
                                                        <option value="Travelling">Travelling</option>
                                                        <option value="Personal Reasons">Personal Reasons(Prefer not to say)</option>
                                                    </select>
                                                </div>

                                                <!-- Start Date -->
                                                <div class="mt-4">
                                                    <x-label for="start_date" :value="__('Start Date')" />

                                                    <x-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" value="{{ $leave->start_date }}" required />
                                                </div>

                                                <!-- error message for start date and end date -->
                                                <!-- @if (session('leave_error_message'))
                                <div class="input">
                                    {{ session('leave_error_message') }}
                                </div>
                                @else
                                @endif -->

                                                <!-- error leave message -->
                                                <div class="input" id="input">
                                                </div>

                                                <!-- End Date -->
                                                <div class="mt-4">
                                                    <x-label for="end_date" :value="__('End Date')" />

                                                    <x-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" value="{{$leave->end_date}}" required />
                                                </div>
                                                <br>
                                                <x-button class="ml-4" id="createLeaveButton">
                                                    {{ __('Update') }}
                                                </x-button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </td>
                        <td>
                            <form action="{{ route('user.leave.delete', [auth()->user()->id, $leave->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button id="deleteLeaveButton" class="btn btn-danger btn-sm">
                                    DELETE
                                </button>
                            </form>
                        </td>

                        <!-- Update Modal -->

        </div>

        @endforeach
        </tr>
        </tbody>
        </table>

        <!-- Pagination -->
        <div class="row">
            <div class="col offset-md-6">
                {{$leaves->links()}}
            </div>
        </div>
        @endif

        </div>
    </x-slot>
</x-app-layout>

<script>
    let error_input = document.getElementById("#input");
    let start_date = document.getElementById("#start_date")
    let end_date = document.getElementById("#end_date")
    let createLeaveModal = document.querySelector("#createLeaveModalButton")
    let editLeaveModalTitle = document.querySelector("#createLeaveModalTitle")
    let editLeaveModalButton = document.querySelector("#createLeaveButton")


    $(document).ready(function() {
        $("#updateProfileButton").click(function() {
            $("#updateProfileModal").fadeToggle();
        })
    })
</script>
