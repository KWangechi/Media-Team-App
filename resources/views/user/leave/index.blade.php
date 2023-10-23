<x-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="leaves"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <x-navbars.navigation titlePage="Leaves"></x-navbars.navigation>

        <!-- End Navbar -->
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

        @if ($leaves->isEmpty())
        <div class="alert alert-info alert-dismissible">
            You do not have any leaves
        </div>
        <a class="btn btn-primary btn-sm text-center" data-bs-toggle="modal" data-bs-target="#createLeaveModal" id="createLeaveModalButton">
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
                                <select name="reason" class="block w-full rounded">
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
        

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Reason</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Start Date</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                End Date</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                                Status</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leaves as $leave)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div class="my-auto text-center">
                                                        <h6 class="mb-0 text-sm">{{$leave->reason}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{$leave->start_date}}</p>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold">{{$leave->end_date}}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if ($leave->status == 'pending')
                                                <span class="text-xs text-lowercase badge bg-gradient-danger">{{$leave->status}}</span>
                                                @else
                                                <span class="text-xs text-lowercase badge bg-gradient-success">{{$leave->status}}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <button class="btn btn-link text-secondary mb-0">
                                                    <i class="fa fa-pen text-xs px-2"></i>
                                                    Edit
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex pagination justify-content-end pr-3">
                            {{$leaves->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>