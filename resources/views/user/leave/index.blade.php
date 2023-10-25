<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="leaves"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <x-navbars.navigation titlePage="Leaves"></x-navbars.navigation>

        <!-- Toast notifications -->
        @if (session('success_message'))
        <div class="toast show float-end mr-3" role="alert" aria-live="assertive" aria-atomic="true">
            <!-- <div class="toast-container position-absolute p-3" id="toastPlacement">

                <div class="d-flex">
                    <div class="toast-header">
                        <span class="badge rounded-pill rounded-sm bg-success pr-3">.</span>
                        <strong class="me-auto">Success</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        {{session('success_message')}}
                    </div>
                    <button type="button" class="btn-close bg-dark me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div> -->
            <div class="aria-live=" polite" aria-atomic="true" class="bg-dark position-relative bd-example-toasts">
                <div class="toast-container position-absolute" id="toastPlacement">
                    <div class="toast show">
                        <div class="toast-header">
                            <button class="btn btn-sm btn-success w-2 h-2 my-auto"></button>
                            <!-- <span class="badge rounded-pill rounded-sm bg-success pr-3"></span> -->
                            <strong class="me-auto">Success</strong>
                            <button type="button" class="btn-close bg-dark" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">
                            {{session('success_message')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @elseif (session('error_message'))
        <div class="toast show float-end mr-3" role="alert" aria-live="assertive" aria-atomic="true">
            <!-- <div class="toast-container position-absolute p-3" id="toastPlacement">

                <div class="d-flex">
                    <div class="toast-header">
                        <span class="badge rounded-pill rounded-sm bg-success pr-3">.</span>
                        <strong class="me-auto">Success</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        {{session('success_message')}}
                    </div>
                    <button type="button" class="btn-close bg-dark me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div> -->
            <div aria-live="polite" aria-atomic="true" class="bg-dark h-4">
                <div class="position-absolute" id="toastPlacement">
                    <div class="toast show">
                        <div class="toast-header">
                            <button class="btn btn-sm btn-danger w-2 h-2 my-auto"></button>
                            <strong class="me-auto">Error</strong>
                            <button type="button" class="btn-close bg-dark" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">
                            {{session('error_message')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endif

        @if ($leaves->isEmpty())
        <div class="alert alert-info alert-dismissible">
            You do not have any leaves
        </div>
        <a class="btn btn-primary btn-sm text-center" data-bs-toggle="modal" data-bs-target="#createLeaveModal" id="createLeaveModalButton">
            <i class="bi bi-plus-circle"></i>
            CREATE NEW LEAVE REQUEST
        </a>


        <!-- Create Leave Request Modal -->
        <div class="modal fade" id="createLeaveModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Welcome back</h5>
                                <p class="mb-0">Enter your email and password to sign in</p>
                            </div>
                            <div class="card-body">
                                <form role="form text-left">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                    <div class="form-check form-switch d-flex align-items-center">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                        <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Sign in</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-4 text-sm mx-auto">
                                    Don't have an account?
                                    <a href="javascript:;" class="text-info text-gradient font-weight-bold">Sign up</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @else
        <a class="btn bg-gradient-info text-center" data-bs-toggle="modal" data-bs-target="#createLeaveModal" id="createLeaveModalButton">
            <i class="material-icons">add</i>
            CREATE NEW LEAVE REQUEST
        </a>

        <!-- Create Leave Request Modal -->
        <div class="modal fade mt-0" id="createLeaveModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
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
                                            <!-- <option value="" selected disabled></option> -->
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
                                        <button type="submit" class="btn btn-round btn-sm bg-gradient-info btn-lg w-100 mt-4 mb-0">Save</button>
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
                                                Action
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