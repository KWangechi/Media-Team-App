<x-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="sunday-reports"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <x-navbars.navigation titlePage="Edit Report"></x-navbars.navigation>
        <div class="container">
            <h3 class="text-center">
                <strong>
                    Edit Report
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
            <div class="edit_report_form">
                <form action="{{ route('user.sunday-report.update', [auth()->user()->id, $report->id] )}}" method="POST" id="updateReportForm">
                    @csrf
                    @method('PATCH')

                    <label class="form-label font-weight-bold">WorkStation</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <select class="form-select-md form-control" name="workstation" id="workstation">
                            <option value="{{ $report->workstation }}" disabled selected>--{{ $report->workstation }}--</option>
                            <option value="VMix">VMix</option>
                            <option value="Sound">Sound</option>
                            <option value="Stage Management">Stage Management</option>
                            <option value="Video">Video</option>
                        </select>
                    </div>

                    <label class="form-label font-weight-bold">Report Date</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <input type="date" class="form-control" name="report_date" id="report_date" value="{{$report->report_date}}">
                    </div>

                    <label class="form-label font-weight-bold">Event Type</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <input type="text" class="form-control" name="event_type" id="event_type" value="{{$report->event_type}}">
                    </div>

                    <label class="form-label font-weight-bold">Comments</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <textarea class="form-control" id="comments" name="comments" rows="3" value="{{$report->comments}}"></textarea>
                    </div>

                    <div class="text-center ">
                        <button type="submit" class="btn btn-round btn-md bg-gradient-info w-10 mt-2 mb-2">update</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" href="{{ route('user.sunday-report.index', auth()->user()->id) }}">Cancel</a>
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
