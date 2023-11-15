<x-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">

    <x-navbars.sidebar activePage="sunday-reports"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

        <!-- Navbar -->
        <x-navbars.navigation titlePage="Sunday Reports"></x-navbars.navigation>

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

        @if ($reports->isEmpty())
        <div class="text-center mt-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
            </svg>
            <h3 class="mt-5">NO REPORTS YET</h3>
            <p class="mt-4 mx-auto">You have no reports. Click the link below to create</p>

            <a class="btn bg-gradient-warning mt-3" data-bs-toggle="modal" data-bs-target="#createLeaveModal" id="createLeaveModalButton">
                <i class="material-icons">drafts</i>
                Create a New Report
            </a>
        </div>

        <!-- Create Leave Request Modal -->
        <div class="modal fade" id="createLeaveModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Create a New Report</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.sunday-report.create', auth()->user()->id )}}" method="POST" id="createReportForm">
                                    @csrf

                                    <label class="form-label font-weight-bold">WorkStation</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <select class="form-select-md form-control" name="workstation" id="workstation">
                                            <option value="" disabled selected>--Select an Option--</option>
                                            <option value="VMix">VMix</option>
                                            <option value="Sound">Sound</option>
                                            <option value="Stage Management">Stage Management</option>
                                            <option value="Video">Video</option>
                                        </select>
                                    </div>

                                    <label class="form-label font-weight-bold">Report Date</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="date" class="form-control" name="report_date" id="report_date">
                                    </div>

                                    <label class="form-label font-weight-bold">Event Type</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="text" class="form-control" name="event_type" id="event_type">
                                    </div>

                                    <label class="form-label font-weight-bold">Comments</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                                    </div>
                                    <div class="text-center ">
                                        <button type="submit" class=" btn btn-round btn-md bg-gradient-info w-30 mt-2 mb-0">Save</button>
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
            CREATE NEW REPORT
        </a>

        <!-- Create Leave Request Modal -->
        <div class="modal fade" id="createLeaveModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Create a New Report</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.sunday-report.create', auth()->user()->id )}}" method="POST" id="createReportForm">
                                    @csrf

                                    <label class="form-label font-weight-bold">WorkStation</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <select class="form-select-md form-control" name="workstation" id="workstation">
                                            <option value="" disabled selected>--Select an Option--</option>
                                            <option value="VMix">VMix</option>
                                            <option value="Sound">Sound</option>
                                            <option value="Stage Management">Stage Management</option>
                                            <option value="Video">Video</option>
                                        </select>
                                    </div>

                                    <label class="form-label font-weight-bold">Report Date</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="date" class="form-control" name="report_date" id="report_date">
                                    </div>

                                    <label class="form-label font-weight-bold">Event Type</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="text" class="form-control" name="event_type" id="event_type">
                                    </div>

                                    <label class="form-label font-weight-bold">Comments</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                                    </div>
                                    <div class="text-center ">
                                        <button type="submit" class="text-white btn btn-round btn-md bg-gradient-info w-30 mt-4 mb-0">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Container for the table -->
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
                                                Workstation</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                Report Date</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                Event Type</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Comments</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reports as $report)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div class="mx-auto">
                                                        <h6 class="mb-0 text-sm">{{$report->workstation}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{$report->report_date}}</p>
                                            </td>
                                            <td>
                                                <span class="text-sm font-weight-bold mb-0">{{$report->event_type}}</span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-weight-bold mb-0">{{$report->comments}}</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="row text-center mx-auto p-0">
                                                    <div class="col-6 mx-auto">
                                                        <a href="{{ route('user.sunday-report.edit', [auth()->id(), $report->id]) }}" rel="noopener noreferrer">
                                                            <button class="btn btn-link text-secondary mb-0">
                                                                <i class="fa fa-pen text-xs px-1"></i>
                                                                Edit
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="col-6">
                                                        <form action="{{ route('user.sunday-report.delete', [auth()->id(), $report->id]) }}" method="post">
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
                            Showing {{count($reports)}} of {{$reports->total()}} results
                        </div>
                        {{$reports->links()}}
                    </div>
                </div>
            </div>
        </div>

        @endif

    </main>
</x-layout>
