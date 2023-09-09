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

            <!-- check if there are any reports -->
            @if ($reports->count() < 1)
            <div class="alert alert-info alert-dismissible">
                No report uploaded yet
            </div>

            <a class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#createReportModal" id="createReportModalButton">
                <i class="bi bi-plus-circle"></i>
                CREATE A NEW REPORT</a>

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

                                <!-- Report Date -->
                                <div class="mt-4">
                                    <x-label for="report_date" :value="__('Report Date')" />

                                    <x-input class="block mt-1 w-full" id="report_date" name="report_date" type="date" autofocus placeholder="eg. 2022-01-01" />
                                </div>

                                <!-- Event Title -->
                                <div class="mt-4">
                                    <x-label for="event_type" :value="__('Event Type')" />

                                    <x-input id="event_type" class="block mt-1 w-full" type="text" name="event_type" required placeholder="eg. Second Service" />
                                </div>

                                <!-- WorkStation -->
                                <div class="mt-4">
                                    <x-label for="workstation" :value="__('Workstation')" />

                                    <x-input id="workstation" class="block mt-1 w-full" type="text" name="workstation" required placeholder="eg. VMix" />
                                </div>

                                <!-- Comments -->
                                <div class="mt-4">
                                    <x-label for="report_comments" :value="__('Report Comments')" />

                                    <x-textarea id="report_comments" class="block mt-1 w-full" type="text" name="report_comments" required placeholder="eg. Microphones were making noises during the second service and we need to replace the wires" />
                                </div>

                                <br>
                                <x-button class="ml-4 btn-primary">
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
            <a class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#createReportModal" id="createReportModalButton">
                <i class="bi bi-plus-circle"></i>
                CREATE A NEW REPORT</a>

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

                                <!-- Report Date -->
                                <div class="mt-4">
                                    <x-label for="report_date" :value="__('Report Date')" />

                                    <x-input class="block mt-1 w-full" id="report_date" name="report_date" type="date" autofocus placeholder="eg. 2022-01-01" />
                                </div>

                                <!-- Event Title -->
                                <div class="mt-4">
                                    <x-label for="event_type" :value="__('Event Type')" />

                                    <x-input id="event_type" class="block mt-1 w-full" type="text" name="event_type" required placeholder="eg. Second Service" />
                                </div>

                                <!-- WorkStation -->
                                <div class="mt-4">
                                    <x-label for="workstation" :value="__('Workstation')" />

                                    <x-input id="workstation" class="block mt-1 w-full" type="text" name="workstation" required placeholder="eg. VMix" />
                                </div>

                                <!-- Comments -->
                                <div class="mt-4">
                                    <x-label for="comments" :value="__('Report Comments')" />

                                    <x-textarea id="report_comments" class="block mt-1 w-full" type="text" name="report_comments" required placeholder="eg. Microphones were making noises during the second service and we need to replace the wires" />
                                </div>

                                <br>
                                <x-button class="ml-4 btn-primary">
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


            <!-- card for displaying the summary roster -->
            <div class="row row-cols-1 row-cols-md-2 g-4" style="margin-top: 40px;">
            @foreach ($reports as $report)
                <div class="col">
                    <div class="card border-primary mb-2">
                        <div class="card-header">
                            <b>{{$report->report_date}}: </b>{{$report->event_type}}
                        </div>
                        <div class="card-body">
                            <p class="card-text mb-4"><b>Report Comments: </b></p>
                            <p class="mt-0 mb-1">{{$report->comments}}</p>


                        </div>

                        <div class="card-footer col-12">
                            <a href="{{ route('user.sunday-report.edit', [auth()->user()->id, $report->id]) }}" class="btn btn-secondary btn-sm col float-left my-auto">EDIT</a>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
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
