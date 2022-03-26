<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot> -->

    <x-slot name="slot">
        <!-- display message if search results are found -->
        <br>
        <div class="container text-center">
            @if ($search_users->isNotEmpty())
            <div class="alert alert-info alert-dismissible fade show">
                Found {{ $search_users->count() }} result(s)
                <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>
            <br>

            <table class="table table-responsive table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Date Joined</th>
                        <th scope="col">Department</th>
                        <th scope="col">Login Time(Sunday)</th>
                        <th scope="col">Account Status</th>
                        <th scope="col">EDIT</th>
                        <th scope="col">DELETE</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($search_users as $search_user)
                    <tr>
                        <td>{{$search_user->id}}</td>
                        <td>{{$search_user->name}}</td>
                        <td>{{$search_user->email}}</td>
                        <td>{{$search_user->phone_number}}</td>
                        <td>{{$search_user->date_joined}}</td>
                        <td>{{$search_user->department}}</td>
                        <td>{{$search_user->login_time}}</td>
                        <td>
                            @if ($search_user->account_status == 'pending')
                            <a href="{{ route('users.approve', $search_user->id) }}" class="btn btn-primary btn-sm">Approve</a>
                            @else
                            {{$search_user->account_status}}
                            @endif
                        </td>
                        <td>
                            <a href="{{route('users.edit', $search_user->id)}}" class="btn btn-primary btn-sm">EDIT</a>
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $search_user->id ) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">DELETE </button>
                            </form>
                            @endforeach
                    </tr>
                </tbody>
            </table>
            @else
            <div class="alert alert-danger alert-dismissible fade show">
                No users found
                <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>
            @endif
        </div>
    </x-slot>
</x-app-layout>