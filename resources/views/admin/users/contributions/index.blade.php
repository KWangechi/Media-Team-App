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

            <a class="btn btn-primary btn-sm text-center float-right" data-bs-toggle="modal" data-bs-target="#createLeaveModal" id="createLeaveModalButton">
                <i class="bi bi-plus-circle"></i>
                CREATE NEW CONTRIBUTION
            </a>

            <!-- search bar -->
            <form action="{{ route('admin.users.contributions.search') }}" method="get">

                <div>
                    <x-input id="filter" type="text" name="filter" placeholder="Filter" />

                </div>
                <div class="row float-right">
                    <div class="col">
                        <x-input id="search" type="text" name="search" placeholder="Search" />
                    </div>
                    <div class="col">
                        <button class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- check if contribution is empty -->
            @if ($contributions->isEmpty())
            <div class="alert alert-info alert-dismissible">
                No contributions made yet
            </div>

            <!-- Create Contributions Modal -->
            <div class="modal fade" id="createLeaveModal" tabindex="-1" aria-labelledby="createLeaveModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="createContributionTitle">Create a New Contribution</h5>
                            <a class="btn-close" id="closeModalButton" data-bs-dismiss="modal" aria-label="Close"></a>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.users.contributions.create') }}" method="POST" id="createContributionForm">
                                @csrf

                                <!-- Name of Member who contributed -->
                                <div class="mt-4">
                                    <x-label for="member_name" :value="__('Member Name')" />
                                    <select name="user_id">

                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{$user->name}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <!-- Amount Contributed -->
                                <div class="mt-4">
                                    <x-label for="amount_contributed" :value="__('Contribution Amount')" />

                                    <x-input id="amount_contributed" class="block mt-1 w-full" type="number" name="amount_contributed" required />
                                </div>

                                <!-- Contribution Date -->
                                <div class="mt-4">
                                    <x-label for="date_contributed" :value="__('Contribution Date')" />

                                    <x-input id="date_contributed" class="block mt-1 w-full" type="date" name="date_contributed" required />
                                </div>

                                <!-- Comment -->
                                <div class="mt-4">
                                    <x-label for="comment" :value="__('Comment')" />

                                    <x-input id="comment" class="block mt-1 w-full" type="text" name="comment" required />
                                </div>


                                <br>
                                <x-button class="ml-4" id="createContributionButton">
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
            <!-- <a class="btn btn-primary btn-sm text-center float-right" data-bs-toggle="modal" data-bs-target="#createLeaveModal" id="createLeaveModalButton">
                <i class="bi bi-plus-circle"></i>
                CREATE NEW CONTRIBUTION
            </a> -->

            <!-- Create Contributions Modal -->
            <div class="modal fade" id="createLeaveModal" tabindex="-1" aria-labelledby="createLeaveModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="createContributionTitle">Create a New Contribution</h5>
                            <a class="btn-close" id="closeModalButton" data-bs-dismiss="modal" aria-label="Close"></a>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.users.contributions.create') }}" method="POST" id="createContributionForm">
                                @csrf

                                <!-- Name of Member who contributed -->
                                <div class="mt-4">
                                    <x-label for="member_name" :value="__('Member Name')" />
                                    <select name="user_id">

                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{$user->name}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <!-- Amount Contributed -->
                                <div class="mt-4">
                                    <x-label for="amount_contributed" :value="__('Contribution Amount')" />

                                    <x-input id="amount_contributed" class="block mt-1 w-full" type="number" name="amount_contributed" required />
                                </div>

                                <!-- Contribution Date -->
                                <div class="mt-4">
                                    <x-label for="date_contributed" :value="__('Contribution Date')" />

                                    <x-input id="date_contributed" class="block mt-1 w-full" type="date" name="date_contributed" required />
                                </div>

                                <!-- Comment -->
                                <div class="mt-4">
                                    <x-label for="comment" :value="__('Comment')" />

                                    <x-input id="comment" class="block mt-1 w-full" type="text" name="comment" required />
                                </div>


                                <br>
                                <x-button class="ml-4" id="createContributionButton">
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

            <!-- Table -->
            <br>
            <br>
            <table class="table table-responsive table-bordered table-striped text-center table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Amount Contributed(Kshs.)</th>
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
                    </tr>
        </div>

        @endforeach
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
