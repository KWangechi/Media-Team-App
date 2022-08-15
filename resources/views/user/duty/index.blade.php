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

            <!-- Table -->
            <br>
            <br>

            <table class="table table-responsive table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Member Name</th>
                        <th scope="col">Supervisor Name</th>
                        <th scope="col">Workstation</th>
                        <th scope="col">Duty Assigned</th>
                        <th scope="col">Type of Service</th>
                        <th scope="col">Supervisor Signature</th>
                        <th scope="col">Setup Time</th>
                        <th scope="col">Date Assigned</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($duties as $duty)
                    <tr>
                        <td>{{$duty->id}}</td>
                        <td>{{$duty->member_name}}</td>
                        <td>{{$duty->supervisor_name}}</td>
                        <td>{{$duty->workstation}}</td>
                        <td>{{$duty->duty_assigned}}</td>
                        <td>
                            {{$duty->type_of_service}}
                        </td>

                        <td>
                            {{$duty->supervisor_signature}}
                        </td>
                        <td>
                            {{$duty->setup_time}}
                        </td>
                        <td>
                            {{$duty->date_assigned}}
                        </td>

        </div>

        @endforeach
        </tr>
        </tbody>
        </table>

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
