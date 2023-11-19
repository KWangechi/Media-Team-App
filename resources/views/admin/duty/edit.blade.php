<x-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="admin-schedule-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <x-navbars.navigation titlePage="Edit User Details: {{$member_details->id}}"></x-navbars.navigation>
        <div class="container">
            <h3 class="text-center">
                <strong>
                    Edit User Details
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
            <div class="edit_member_details_form">
                <form action="{{ route('admin.duty.editDutyPersonelDetails', $member_details->id) }}" method="POST" id="updateReportForm">
                    @csrf
                    @method('PATCH')

                    <label class="form-label font-weight-bold">Member Name</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <input type="text" class="form-control" name="member_name" id="member_name" value="{{$member_details->member_name}}" readonly>


                    </div>

                    <label class="form-label font-weight-bold">Workstation</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <select class="form-select-md form-control" name="workstation" id="workstation" placeholder="--Select department--">
                            <option value="" disabled selected>
                                < -- {{$member_details->workstation}} -->
                            </option>
                            <option value="Video">Video</option>
                            <option value="Sound">Sound</option>
                            <option value="Computer">Computer</option>
                            <option value="Vmix">VMix</option>
                        </select>
                    </div>

                    <label class="form-label font-weight-bold">Duty Assigned</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <input type="text" class="form-control" name="duty_assigned" id="duty_assigned" value="{{$member_details->duty_assigned}}">
                    </div>

                    <label class="form-label font-weight-bold">Event Type</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <input type="text" class="form-control" name="event_type" id="event_type" value="{{$member_details->event_type}}">
                    </div>

                    <div class="text-center ">
                        <button type="submit" class="btn btn-round btn-md bg-gradient-info w-10 mt-2 mb-2">update</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a class="btn btn-sm btn-secondary" href="{{ route('admin.duty.index') }}">Cancel</a>
            </div>
        </div>
    </main>
</x-layout>
