<x-app-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="admin-leaves"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <x-navbars.navigation titlePage="My Leaves"></x-navbars.navigation>

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
        <div class="text-center mt-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-airplane" viewBox="0 0 16 16">
                <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849Zm.894.448C7.111 2.02 7 2.569 7 3v4a.5.5 0 0 1-.276.447l-5.448 2.724a.5.5 0 0 0-.276.447v.792l5.418-.903a.5.5 0 0 1 .575.41l.5 3a.5.5 0 0 1-.14.437L6.708 15h2.586l-.647-.646a.5.5 0 0 1-.14-.436l.5-3a.5.5 0 0 1 .576-.411L15 11.41v-.792a.5.5 0 0 0-.276-.447L9.276 7.447A.5.5 0 0 1 9 7V3c0-.432-.11-.979-.322-1.401C8.458 1.159 8.213 1 8 1c-.213 0-.458.158-.678.599Z" />
            </svg>
            <h3 class="mt-5">NO LEAVES YET</h3>
            <p class="mt-4 mx-auto">You have no leaves. Click the link below to create</p>

            <a class="btn bg-gradient-primary mt-3" data-bs-toggle="modal" data-bs-target="#createLeaveModal" id="createLeaveModalButton">
                <i class="material-icons">flight</i>
                Create a New Leave Request
            </a>

            <a class="btn bg-gradient-primary mt-3" href="{{route('admin.leaves.index')}}">
                <i class="material-icons">flight</i>
                View All Leaves
            </a>
        </div>


        @else
        <a class="btn bg-gradient-secondary mx-4 mb-0" data-bs-toggle="modal" data-bs-target="#createLeaveModal" id="createLeaveModalButton">
            <i class="material-icons">add</i>
            CREATE NEW LEAVE REQUEST
        </a>

        <a class="btn bg-gradient-primary mt-3" href="{{route('admin.leaves.index')}}">
                <i class="material-icons">flight</i>
                View All Leaves
            </a>
        @endif

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
                                <form action="{{ route('admin.leave.create', auth()->user()->id) }}" method="POST" id="createLeaveForm">
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
                                        <button type="submit" class=" btn btn-round btn-md bg-gradient-info w-30 mt-4 mb-0">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
                                                Requested By</th>
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
                                                <div class="d-flex px-2 py-1 mx-4">
                                                    <div>
                                                        <img src="{{ asset('/storage/'.$leave->user->profile->photo) }}" class="avatar avatar-sm me-3">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-xs">{{$leave->user->name}}</h6>
                                                    </div>
                                                </div>
                                            </td>

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
                                                <a href="{{route('admin.leaves.approve', [$leave->user_id, $leave->id])}}" class="my-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve Leave Request" data-container="body" data-animation="true">
                                                    <i style="font-size: 1.3rem;" class="fa fa-check-circle-o ps-2 pe-2" aria-hidden="true"></i>
                                                </a>
                                                @else
                                                <span class="text-xs text-lowercase badge bg-gradient-success">{{$leave->status}}</span>
                                                @endif
                                            </td>

                                            <td class="align-middle">
                                                <div class="row text-center mx-auto p-0">
                                                    <div class="col-6 mx-auto">
                                                        <a href="{{ route('admin.leave.edit', $leave->id) }}" rel="noopener noreferrer">
                                                            <button class="btn btn-link text-secondary mb-0">
                                                                <i class="fa fa-pen text-xs px-1"></i>
                                                                Edit
                                                            </button>
                                                        </a>
                                                    </div>

                                                    <div class="col-6">
                                                        <form action="{{ route('admin.leave.delete', [auth()->id(), $leave->id]) }}" method="post">
                                                            @csrf()
                                                            @method('DELETE')
                                                            <button class="btn btn-link text-secondary mb-0 ">
                                                                <i class="fa fa-trash px-1" aria-hidden="true"></i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
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
    </main>
</x-app-layout>
