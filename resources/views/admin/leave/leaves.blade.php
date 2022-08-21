<x-app-layout>
    <x-slot name="slot">
        <div class="container">
            <br>
            <a class="btn btn-primary float-right" href="{{ route('admin.leave.show', auth()->user()->id) }}">
                VIEW MY LEAVES
            </a>
            @if (session('success_message'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success_message') }}
                <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>

            @elseif (session('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" >
                {{ session('error_message') }}
                <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>
            @endif

            <!-- check if leave is empty -->
            @if ($leaves->isEmpty())
                <div class="alert alert-info alert-dismissible">
                    No leave requests
                </div>
            @else
            <!-- Table -->
            <br>
            <br>
            <table class="table table-responsive table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leaves as $leave)
                    <tr>
                        <td>{{$leave->id}}</td>
                        <td>{{$leave->user_id}}</td>
                        <td>{{$leave->reason}}</td>
                        <td>{{$leave->start_date}}</td>
                        <td>{{$leave->end_date}}</td>

                        @if ($leave->status == 'pending')
                        <td>
                            <form action="{{ route('admin.leaves.approve', [$leave->user_id, $leave->id]) }}" method="POST">
                                @csrf

                                <button id="approveLeaveButton" class="btn btn-primary btn-sm">Approve Leave Request</button>

                            </form>
                            <br>
                            
                            <form action="{{ route('admin.leaves.reject', [$leave->user_id, $leave->id]) }}" method="POST">
                                @csrf

                                <button class="btn btn-danger btn-sm">Reject Leave Request</button>
                            </form>
                        </td>
                            @elseif($leave->status == 'approved')
                            <td style="color: green;">
                                {{$leave->status}}
                                <i class="bi bi-check-circle"></i>
                        </td>
                        @else
                        <td style="color: red;">
                                {{$leave->status}}
                                <i class="bi bi-x-circle"></i>
                        </td>
                            @endif
                            @endforeach
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="row">
                <div class="col offset-md-6">
                    {{$leaves->links()}}
                </div>
            </div>
            @endif

        </div>
    </x-slot>
</x-app-layout>
