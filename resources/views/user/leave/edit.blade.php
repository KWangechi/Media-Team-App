<x-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="leaves"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <x-navbars.navigation titlePage="Edit Leaves"></x-navbars.navigation>
        <div class="container">
            <h3 class="text-center">
                <strong>
                    Edit Leave Request
                </strong>
            </h3>

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
            <div class="leave_request_form">
                <form action="{{ route('user.leave.update', [auth()->id(), $leave->id]) }}" method="POST">
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
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">End Date</label>
                            <div class="input-group input-group-outline my-2">
                                <input type="date" name="end_date" class="form-control" value="{{$leave->end_date}}">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-md bg-gradient-info w-10 mt-4 mb-3">Save</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" href="{{ route('user.leaves.index', auth()->user()->id) }}">Cancel</a>
            </div>
        </div>
    </main>
</x-layout>

<script>
    $(document).ready(function() {
        $("#createLeaveModalButton").click(function() {
            $("#createLeaveModal").fadeToggle();
            // console.log('Display the modal')
        })
        $("#closeModalButton").click(function() {
            $(".modal").toggle()
        })
    })
</script>
