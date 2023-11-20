<x-app-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="admin-leaves"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <x-navbars.navigation titlePage="Edit Leave"></x-navbars.navigation>
        <div class="container">
            <h3 class="text-center">
                <strong>
                    Edit Leave Request
                </strong>
            </h3>


            <!-- Display error or success message -->
            @if (session('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-icon align-middle">
                <span class="material-icons text-md">
                    thumb_up_off_alt
                </span>
            </span>
            <span class="alert-text"><strong>Danger!</strong> This is a danger alert—check it out!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @endif


        <div class="leave_request_form">
            <form action="{{ route('admin.leave.update', [auth()->id(), $leave->id]) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row mt-4">
                    <div class="col-md-6">
                        <label class="form-label font-weight-bold">Reason</label>
                        <div class="input-group input-group-outline my-1">
                            <select class="form-select-md form-control" name="reason" id="reason">
                                <option value="{{$leave->reason}}" selected disabled>{{$leave->reason}}</option>
                                <option value="Bereavement">Bereavement</option>
                                <option value="Sickness">Sickness</option>
                                <option value="Personal Reasons">Personal Reasons</option>
                                <option value="Temporary Absence">Temporary Absence</option>
                                <option value="Travelling">Travelling</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label font-weight-bold">Start Date</label>
                        <div class="input-group input-group-outline my-1 ">
                            <input type="date" name="start_date" class="form-control" value="{{$leave->start_date}}">
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label class="form-label">End Date</label>
                        <div class="input-group input-group-outline my-2">
                            <input type="date" name="end_date" class="form-control" value="{{$leave->end_date}}">
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-sm bg-gradient-primary w-10 mt-4 mb-3">Save Changes</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.leave.show', auth()->user()->id) }}">Cancel</a>
        </div>
        </div>
    </main>
</x-app-layout>
