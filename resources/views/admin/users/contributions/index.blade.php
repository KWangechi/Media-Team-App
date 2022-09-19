<x-app-layout>
    <x-slot name="slot">
        <div class="container">
            <br>
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

            <!-- check if contribution is empty -->
            @if ($contributions->isEmpty())
            <div class="alert alert-info alert-dismissible">
                No contributions made yet
            </div>

            @else

            <!-- Table -->
            <br>
            <br>
            <table class="table table-responsive table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Amount Contributed</th>
                        <th scope="col">Date Contributed</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($contributions as $contribution)
                    <tr>
                        <td>{{$contribution->id}}</td>
                        <td>{{$contribution->user_id}}</td>
                        <td>{{$contribution->amount_contributed}}</td>
                        <td>{{$contribution->date_contributed}}</td>


        </div>

        @endforeach
        </tr>
        </tbody>
        </table>

        <!-- Pagination -->
        <div class="row">
            <div class="col offset-md-6">
                {{$contributions->links()}}
            </div>
        </div>
        @endif

        </div>
    </x-slot>
</x-app-layout>

<script>
    // let error_input = document.getElementById("#input");
    // let start_date = document.getElementById("#start_date")
    // let end_date = document.getElementById("#end_date")
    // let createcontributionModal = document.querySelector("#createcontributionModalButton")
    // let editcontributionModalTitle = document.querySelector("#createcontributionModalTitle")
    // let editcontributionModalButton = document.querySelector("#createcontributionButton")


    // $(document).ready(function() {
    //     $("#updateProfileButton").click(function() {
    //         $("#updateProfileModal").fadeToggle();
    //     })
    // })
</script>
