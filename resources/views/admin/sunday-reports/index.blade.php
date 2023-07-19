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
            @if ($reports->isEmpty())
            <div class="alert alert-info alert-dismissible">
                No reports uploaded yet
            </div>

            @else
            <table class="table table-responsive table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Member Name</th>
                        <th scope="col">Event Title</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Report Date</th>
                        <th scope="col">Workstation</th>
                        <th scope="colgroup">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                    <tr>
                        <td>{{$report->id}}</td>
                        <td>{{$report->user->name}}</td>
                        <td>{{$report->event_type}}</td>
                        <td>{{$report->user->phone_number}}</td>
                        <td>{{$report->report_date}}</td>
                        <td>Sound Stage Management</td>
                        <!-- <td>{{$report->workstation}}</td> -->
                        <td>
                            <a href="{{route('admin.users.sunday-reports.downloadAsPDF', $report->id)}}" class="btn btn-primary btn-sm">

                            </a>
                        </td>
                            @endforeach
                    </tr>
                </tbody>
            </table>

            <!-- card for displaying the summary roster for each staff member -->

            @endif

            <!-- Pagination -->
            <div class="row">
                <div class="col offset-md-6 mb-3">
                    {{$reports->links()}}
                </div>
            </div>

        </div>
    </x-slot>
</x-app-layout>

<script>
    let createsummaryRosterModal = document.querySelector("#createReportModal")

    let editMemberDetails = document.querySelector("#editMemberDetails")
    let createMemberDetails = document.querySelector('#createMemberDetails')

    // createsummaryRosterModalButton.addEventListener('click', function(){
    //     $("#createsummaryRosterModal").fadeToggle();
    // })

    // editMemberDetails.addEventListener('click', function(e) {
    //     // console.log(editMemberDetails.innerText);
    //     $("#staticBackdrop").modal('toggle');
    // })


    $(document).ready(function() {
        $("#createsummaryRosterModalButton").on('click', function() {
            $("#createsummaryRosterModal").modal('toggle');



        })

    })
</script>
<style>

</style>