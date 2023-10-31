<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="leaves"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <x-navbars.navigation titlePage="Leaves"></x-navbars.navigation>

        <!-- Toast notifications -->
        @if (session('success_message'))
        <div class="toast-container" style="position: absolute; top: 30px; right: 40px;" data-bs-animation="true" data-bs-delay="3000">
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
        <div class="toast-container" style="position: absolute; top: 30px; right: 40px;" data-bs-animation="true" data-bs-delay="3000">
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

        @if ($leaves->isEmpty())
        <div class="alert alert-info alert-dismissible">
            You do not have any leaves
        </div>
        <a class="btn bg-gradient-secondary mx-4 mb-0" data-bs-toggle="modal" data-bs-target="#createLeaveModal" id="createLeaveModalButton">
            <i class="material-icons">add</i>
            CREATE NEW LEAVE REQUEST
        </a>

        <!-- Create Leave Request Modal -->
        <div class="modal fade" id="createLeaveModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Create a New Leave Request</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.leave.create', auth()->user()->id) }}" method="POST" id="createLeaveForm">
                                    @csrf

                                    <label class="form-label font-weight-bold">Reason</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <select class="form-select-md form-control" name="reason" id="reason" placeholder="--Select reason--">
                                            <option value="" disabled selected>--Select an Option--</option>
                                            <option value="Bereavement">Bereavement</option>
                                            <option value="Sickness">Sickness</option>
                                            <option value="Personal Reasons">Personal Reasons</option>
                                            <option value="Temporary Absence">Temporary Absence</option>
                                            <option value="Travelling">Travelling</option>
                                        </select>
                                    </div>

                                    <label class="form-label font-weight-bold">Start Date</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="date" class="form-control" name="start_date" id="start_date">
                                    </div>

                                    <label class="form-label font-weight-bold">End Date</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="date" class="form-control" name="end_date" id="end_date">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="text-white btn btn-round btn-md bg-gray-900 w-30 mt-4 mb-0">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @else
        <a class="btn bg-gradient-secondary mx-4 mb-0" data-bs-toggle="modal" data-bs-target="#createLeaveModal" id="createLeaveModalButton">
            <i class="material-icons">add</i>
            CREATE NEW LEAVE REQUEST
        </a>

        <!-- Create Leave Request Modal -->
        <div class="modal fade" id="createLeaveModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Create a New Leave Request</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.leave.create', auth()->user()->id) }}" method="POST" id="createLeaveForm">
                                    @csrf

                                    <label class="form-label font-weight-bold">Reason</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <select class="form-select-md form-control" name="reason" id="reason">
                                            <option value="" disabled selected>--Select an Option--</option>
                                            <option value="Bereavement">Bereavement</option>
                                            <option value="Sickness">Sickness</option>
                                            <option value="Personal Reasons">Personal Reasons</option>
                                            <option value="Temporary Absence">Temporary Absence</option>
                                            <option value="Travelling">Travelling</option>
                                        </select>
                                    </div>

                                    <label class="form-label font-weight-bold">Start Date</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="date" class="form-control" name="start_date" id="start_date">
                                    </div>

                                    <label class="form-label font-weight-bold">End Date</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="date" class="form-control" name="end_date" id="end_date">
                                    </div>
                                    <div class="text-center ">
                                        <button type="submit" class="text-white btn btn-round btn-md bg-gray-900 w-30 mt-4 mb-0">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Reason</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                Start Date</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                End Date</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Status</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leaves as $leave)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div class="mx-auto">
                                                        <h6 class="mb-0 text-sm">{{$leave->reason}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{$leave->start_date}}</p>
                                            </td>
                                            <td>
                                                <span class="text-sm font-weight-bold mb-0">{{$leave->end_date}}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if ($leave->status == 'pending')
                                                <span class="text-xs text-lowercase badge bg-gradient-warning">{{$leave->status}}</span>
                                                @else
                                                <span class="text-xs text-lowercase badge bg-gradient-success">{{$leave->status}}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <div class="row text-center mx-auto p-0">
                                                    <div class="col-6 mx-auto">
                                                        <a href="{{ route('user.leave.edit', [auth()->id(), $leave->id]) }}" rel="noopener noreferrer">
                                                            <button class="btn btn-link text-secondary mb-0">
                                                                <i class="fa fa-pen text-xs px-1"></i>
                                                                Edit
                                                            </button>
                                                        </a>
                                                    </div>
                                                    @if ($leave->status == "pending")
                                                    <div class="col-6">
                                                        <form action="{{ route('user.leave.delete', [auth()->id(), $leave->id]) }}" method="post">
                                                            @csrf()
                                                            @method('DELETE')
                                                            <button class="btn btn-link text-secondary mb-0 ">
                                                                <i class="fa fa-trash px-1" aria-hidden="true"></i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                    @endif
                                            </td>
                            </div>
                            </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="mb-2 mt-1">
                    <div class="d-flex pagination justify-content-end pr-3 mb-3">
                        <div class="px-5 text-center">
                            Showing {{count($leaves)}} of {{$leaves->total()}} results
                        </div>
                        {{$leaves->links()}}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
</x-layout>
