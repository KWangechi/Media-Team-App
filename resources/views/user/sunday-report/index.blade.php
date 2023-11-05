<x-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="sunday-reports"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

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
            <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-airplane" viewBox="0 0 16 16">
                <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849Zm.894.448C7.111 2.02 7 2.569 7 3v4a.5.5 0 0 1-.276.447l-5.448 2.724a.5.5 0 0 0-.276.447v.792l5.418-.903a.5.5 0 0 1 .575.41l.5 3a.5.5 0 0 1-.14.437L6.708 15h2.586l-.647-.646a.5.5 0 0 1-.14-.436l.5-3a.5.5 0 0 1 .576-.411L15 11.41v-.792a.5.5 0 0 0-.276-.447L9.276 7.447A.5.5 0 0 1 9 7V3c0-.432-.11-.979-.322-1.401C8.458 1.159 8.213 1 8 1c-.213 0-.458.158-.678.599Z" />
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
                                        <textarea class="form-control" id="report_comments" name="report_comments" rows="3"></textarea>
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
                                        <textarea class="form-control" id="report_comments" name="report_comments" rows="3"></textarea>
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
                </div>
            </div>
        </div>
        </div>
    </main>
</x-layout>
