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
                No report uploaded yet
            </div>

            <a class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#createReportModal" id="createReportModalButton">
                <i class="bi bi-plus-circle"></i>
                CREATE NEW A REPORT</a>

            <!-- Create a Report Modal -->
            <div class="modal" id="createReportModal" tabindex="-1" aria-labelledby="createReportModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createReportModalTitle">Create a new Report</h5>
                            <a class="btn-close" id="closeModalButton" data-bs-dismiss="modal" aria-label="Close"></a>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="createReportForm" action="{{ route('user.sunday-report.create', auth()->user()->id )}}">
                                @csrf

                                <!-- <div class="mt-4">
                                    <x-input class="block mt-1 w-full" id="summary_id" name="summary_id" type="number" hidden />
                                </div> -->

                                <!-- Report Date -->
                                <div class="mt-4">
                                    <x-label for="report_date" :value="__('Report Date')" />

                                    <x-input class="block mt-1 w-full" id="report_date" name="report_date" type="date" autofocus placeholder="eg. 2022-01-01" />
                                </div>


                                <!-- Comments -->
                                <div class="mt-4">
                                    <x-label for="report_comments" :value="__('Report Comments')" />

                                    <x-input id="report_comments" class="block mt-1 w-full" type="text" name="report_comments" required placeholder="eg. Microphones were making noises during the
                                    second service and we need to replace the wires" />
                                </div>

                                <br>
                                <x-button class="ml-4">
                                    {{ __('Save') }}
                                </x-button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
            </div>

            @else
            <a class="btn btn-primary btn-sm text-center float-right" id="createsummaryRosterModalButton">
                <i class="bi bi-plus-circle"></i>
                CREATE A NEW REPORT</a>

            <br>
            <br>

            <!-- card for displaying the summary roster -->
            @foreach ($reports as $report)
            <div class="card border-primary mb-3 mx-auto" style="width: max-content; height: max-content;">
                <div class="card-body">
                    <h1 class="card-title mb-4"><b>Report Date {{$report->report_date}}</b></h1>
                    <hr>
                    <p class="card-text mb-4">Report Comments: {{$report->report_comments}}</p>
                    <hr>

                </div>

                <div class="card-footer text-center row">
                    <div class="col float-left">

                        <a href="{{ route('admin.summary.roster.edit', $summary->id) }}" class="btn btn-secondary">EDIT summary ROSTER</a>
                    </div>

                    <form action="{{ route('admin.summary.roster.delete', $summary->id) }}" method="POST" class="float-right col">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger ml-12">DELETE summary ROSTER</button>
                    </form>
                </div>
            </div>
            @endforeach
            @endif

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
