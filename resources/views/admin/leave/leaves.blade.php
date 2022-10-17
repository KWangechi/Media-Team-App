<x-app-layout>
    <x-slot name="slot">
        <div class="container">
            <br>
            <a class="btn btn-primary float-right" href="{{ route('admin.leave.show', auth()->user()->id) }}">
                VIEW MY LEAVES
            </a>
            <br>
            <br>
            <br>
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
                No leave requests
            </div>
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
                            <form action="{{ route('admin.leave.create', auth()->user()->id) }}" method="POST" id="createLeaveForm">
                                @csrf

                                <!-- @if (session('error_message'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    {{ session('error_message') }}
                                    <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                                </div>
                                @else
                                continue
                                @endif -->

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

                                    <!-- End Date -->
                                    <div class="mt-4">
                                        <x-label for="end_date" :value="__('End Date')" />

                                        <x-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" required />
                                    </div>


                                    <div class="input" id="input">
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
                            <form action="{{ route('admin.leave.create', auth()->user()->id) }}" method="POST" id="createLeaveForm">
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
                        <th scope="col">Username</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Status</th>
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

                        @if ($leave->status == 'pending')
                        <td style="color: green">
                            <!-- <form action="{{ route('admin.leaves.approve', [$leave->user_id, $leave->id]) }}" method="POST">
                                @csrf

                                <button id="approveLeaveButton" class="btn btn-primary btn-sm">Approve Leave Request</button>


                            </form> -->

                            approve
                            <i class="bi bi-check-circle"></i>
                        </td>
                            <td style="color: red;">

                                reject
                                <i class="bi bi-check-circle"></i>
                            </td>

                            <!-- <form action="{{ route('admin.leaves.reject', [$leave->user_id, $leave->id]) }}" method="POST">
                                @csrf

                                <button class="btn btn-danger btn-sm">Reject Leave Request</button>
                            </form> -->

                        @elseif($leave->status == 'approved')
                        <td style="color: green;">
                            {{$leave->status}}
                            <i class="bi bi-check-circle"></i>
                        </td>
                        @else
                        <td style="color: red;">
                            {{$leave->status}}
                            <i class="bi bi-x-circle"></i>
                        </td>
                        @endif
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
