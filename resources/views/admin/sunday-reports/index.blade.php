<x-app-layout>
    <x-slot name="slot">
        <div class="container">
            <br>

            <!-- Display error or success message -->
            @if (session('success_message'))
            <div class="alert alert-success alert-dismissible fade show mx-auto text-center" style="max-width: 700px;">
                {{ session('success_message') }}
                <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>

            @elseif (session('error_message'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error_message') }}
                <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>
            @endif

            <!-- check if leave is empty -->
            @if ($all_reports->isEmpty())
            <div class="alert alert-info alert-dismissible">
                No reports uploaded yet
            </div>

            @else
            <div class="row">
                <div class="col float-right">
                    <x-input id="dateFilter" class="block mt-1 w-12" type="date" name="dateFilter" placeholder="Filter By date" />
                </div>
                <div class="col float-right">

                    <x-input id="nameFilter" class="block mt-1 w-12" type="text" name="nameFilter" placeholder="Filter By name" />
                </div>
                <div class="col float-right">

                    <x-input id="workstationFilter" class="block mt-1 w-12" type="text" name="workstationFilter" placeholder="Filter By workstation" />

                    <!-- <select name="filter" id="filter" for="member_name" style="border-radius: 10px;">
                        <option value="" selected disabled>Filter By Name</option>
                        <option value="member_name">Member Name</option>
                        <option value="event_type">Event Title</option>
                        <option value="report_date">Report Date</option>
                        <option value="workstation">Workstation</option>

                    </select> -->
                </div>

                <div class="col">
                    <a href="/#" class="btn btn-secondary btn-sm float-right mt-2">
                        <i class="bi bi-files"></i>
                        View Previous Reports
                    </a>
                </div>

                <div class="col">
                    <a href="{{route('admin.users.sunday-reports.downloadAsPDF')}}" class="btn btn-primary btn-sm mt-2">
                        <i class="bi bi-file-earmark-arrow-down"></i>
                        DOWNLOAD FULL REPORT</a>
                </div>


            </div>

            <table class="table table-responsive table-bordered table-striped align-middle mt-3 p-5">
                <thead class="align-middle h-1">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Member Name</th>
                        <th scope="col">Last Login Time</th>
                        <th scope="col">Event Title</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Workstation</th>
                        <th scope="col">Report Date</th>
                        <th scope="col">Comments</th>
                    </tr>
                </thead>
                <tbody style="word-wrap: break-word;">
                    @foreach ($all_reports as $report)
                    <tr>
                        <td>{{$report->id}}</td>
                        <td>{{$report->user->name}}</td>
                        <td>{{$report->user->login_time}}</td>
                        <td>{{$report->event_type}}</td>
                        <td>{{$report->user->phone_number}}</td>
                        <td>{{$report->workstation}}</td>
                        <td>{{$report->report_date}}</td>
                        <td style="word-wrap: break-word;min-width: 160px;max-width: 190px;">{{$report->comments}}</td>

                        @endforeach
                    </tr>
                </tbody>
            </table>


            <!-- card for displaying the summary roster for each staff member -->

            @endif
            <!-- Pagination -->
            <div class="row">
                <div class="col offset-md-6 mb-3 mt-4">
                    {{$all_reports->links()}}
                </div>
            </div>

        </div>
    </x-slot>
</x-app-layout>

<script>
    let createsummaryRosterModal = document.querySelector("#createReportModal")

    let editMemberDetails = document.querySelector("#editMemberDetails")
    let createMemberDetails = document.querySelector('#createMemberDetails')


    $(document).ready(function() {
        $("#createsummaryRosterModalButton").on('click', function() {
            $("#createsummaryRosterModal").modal('toggle');

        })

    })
</script>
<style>

</style>
