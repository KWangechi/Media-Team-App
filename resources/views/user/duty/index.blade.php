<x-app-layout>
    <x-slot name="slot">
        <div class="container">
            <br>

            <!-- check if leave is empty -->
            @if ($duties->isEmpty())
            <div class="alert alert-info alert-dismissible">
                The duty roster is not yet uploaded
            </div>

            @else
            @foreach ($duties as $duty)
            <div class="card border-primary mb-3 mx-auto" style="width: max-content; height: max-content;">
                <div class="card-body">
                    <h1 class="card-title mb-4"><b>Week: {{$duty->week}} {{$duty->id}}</b></h1>
                    <hr>
                    <p class="card-text mb-3 mt-2">Date assigned: {{$duty->date_assigned}}</p>
                    <hr>
                    <p class="card-text mb-3 mt-2">Setup Time: {{$duty->setup_time}}</p>
                    <hr>

                    <!-- Table View for the other members -->
                    <!-- put a table view in a card body -->
                    <div class="card mb-3 mt-4" style="width: max-content; height: max-content; align-items: center;">
                        <!-- <table> -->
                        <table class="table table-responsive table-striped text-center table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Member Name</th>
                                    <th scope="col">Workstation</th>
                                    <th scope="col">Duty Assigned</th>
                                    <th scope="col">Type of Event</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($duty->members as $new_duty)

                                <tr>
                                    <td>{{$new_duty->member_name }}</td>
                                    <td>{{$new_duty->workstation}}</td>
                                    <td>{{$new_duty->duty_assigned}}</td>
                                    <td>{{$new_duty->event_type}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <!-- Pagination -->


        @endif

        </div>
    </x-slot>
</x-app-layout>

<script>
    let createDutyRosterModal = document.querySelector("#createDutyRosterModal")
    let createDutyRosterModalButton = document.querySelector("#createDutyRosterModalButton")

    // createDutyRosterModalButton.addEventListener('click', function(){
    //     $("#createDutyRosterModal").fadeToggle();
    // })

    $(document).ready(function() {
        $("#createDutyRosterModalButton").on('click', function() {
            $("#createDutyRosterModal").modal('toggle');

            // console.log('Clicked the create duty roster modal');
        })

        // $("#closeModalButton").on('click', function(){
        //     $("#createDutyRosterModal").remove();
        // })
    })
</script>
