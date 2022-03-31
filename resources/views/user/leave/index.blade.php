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
            <a class="btn btn-primary btn-sm text-center" id="createLeaveModalButton">CREATE NEW LEAVE REQUEST</a>


            @else
            <a class="btn btn-primary btn-sm text-center float-right" id="createLeaveModalButton">CREATE NEW LEAVE REQUEST</a>

            <!-- Leave Request Modal -->
            <div class="modal" id="createLeaveModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="createLeaveModal">Create a New Leave Request</h5>
                            <a class="btn-close" id="closeModalButton"></a>
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
                        </form>
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
    $(document).ready(function() {
        $("#createLeaveModalButton").click(function() {
            $("#createLeaveModal").fadeToggle();
            // console.log('Display the modal')
        })
        $("#closeModalButton").click(function(){
            $(".modal").toggle()
        })
    })
</script>