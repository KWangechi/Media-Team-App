<x-app-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="users"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navigation titlePage="Users"></x-navbars.navigation>

        <!-- Display error or success message -->
        @if (session('success_message'))
        <div class="toast-container" style="position: absolute; top: 30px; right: 40px;" data-bs-animation="true" data-bs-delay="3000">
            <div class="toast fade show">
                <div class="toast-header">
                    <span class="badge bg-gradient-success mx-2">.</span>
                    <strong class="me-auto"><i class="bi-globe"></i>Success Message</strong>
                    <small>just now</small>
                    <button type="button" class="btn-close btn-sm bg-dark" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('success_message') }}
                </div>
            </div>
        </div>

        @elseif (session('error_message'))
        <div class="toast-container" style="position: absolute; top: 30px; right: 40px;" data-bs-animation="true" data-bs-delay="3000">
            <div class="toast fade show">
                <div class="toast-header">
                    <span class="badge bg-gradient-danger mx-2">.</span>
                    <strong class="me-auto"><i class="bi-globe"></i>Error Message</strong>
                    <small>just now</small>
                    <button type="button" class="btn-close btn-sm bg-dark" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{session('error_message')}}
                </div>
            </div>
        </div>
        @endif

        <!-- search bar -->
        <!-- <form action="{{ route('admin.users.search') }}" method="get">
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
        </form> -->
        @if ($users->isEmpty())
        <div class="text-center mt-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
            </svg>
            <h3 class="mt-5">NO USERS</h3>
            <p class="mt-4 mx-auto">No users have been created yet. Click the link below to create</p>

            <a class="btn bg-gradient-warning mt-3" data-bs-toggle="modal" data-bs-target="#createUserModal" id="createUserModalButton">
                <i class="material-icons">person</i>
                Create a New User
            </a>
        </div>
        @else
        <a class="btn bg-gradient-secondary mx-5 mb-0 mt-3" data-bs-toggle="modal" data-bs-target="#createUserModal" id="createUserModalButton">
            <i class="material-icons">add</i>
            CREATE A NEW USER
        </a>

        <!-- Table -->
        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                Email</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Phone Number</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Role</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Date Joined</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Department</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Last Login Time(Sunday)</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Account Status</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">
                                                <p class="text-sm font-weight-bold mb-0">{{$user->name}}</p>
                                            </td>
                                            <td>
                                                <span class="text-sm font-weight-bold mb-0">{{$user->email}}</span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-weight-bold mb-0">{{$user->phone_number}}</span>
                                            </td>

                                            <td>
                                                <span class="text-sm font-weight-bold mb-0">{{$user->role->name}}</span>
                                            </td>

                                            <td>
                                                <span class="text-sm font-weight-bold mb-0">{{$user->date_joined}}</span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-weight-bold mb-0">{{$user->department}}</span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-weight-bold mb-0">{{$user->login_time}}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if ($user->account_status == 'pending')
                                                <span class="text-xs text-lowercase badge bg-gradient-warning">{{$user->account_status}}</span>
                                                <a href="{{route('admin.users.approve', $user->id)}}" class="my-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve user" data-container="body" data-animation="true">
                                                    <i style="font-size: 1.3rem;" class="fa fa-check-circle-o ps-2 pe-2" aria-hidden="true"></i>
                                                </a>
                                                @else
                                                <span class="text-xs text-lowercase badge bg-gradient-success">{{$user->account_status}}</span>

                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <div class="row text-center mx-auto p-0">
                                                    <div class="col-6 mx-auto">
                                                        <a href="{{ route('admin.users.edit', $user->id) }}" rel="noopener noreferrer">
                                                            <button class="btn btn-link text-secondary mb-0">
                                                                <i class="material-icons px-1">edit</i>
                                                                Edit
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="col-6">
                                                        <form action="{{ route('admin.users.delete',$user->id)}}" method="post">
                                                            @csrf()
                                                            @method('DELETE')

                                                            <button class="btn btn-link text-secondary mb-0 ">
                                                                <i class="material-icons px-1" aria-hidden="true">delete</i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                            </div>
                            </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="mb-2 mt-1">
                    <div class="d-flex pagination justify-content-end pr-3 mb-3">
                        <div class="px-5 text-center">
                            Showing {{count($users)}} of {{$users->total()}} results
                        </div>
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>

        @endif

        <!-- Create Modal -->
        <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Create a New User</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.users.create') }}" method="POST" id="createUserForm">
                                    @csrf

                                    <label class="form-label font-weight-bold">Name</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="text" class="form-control" name="name" id="name" required autofocus>
                                    </div>

                                    <label class="form-label font-weight-bold">Email</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>

                                    <label class="form-label font-weight-bold">Phone Number</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="number" class="form-control" name="phone_number" id="phone_number" required>
                                    </div>

                                    <label class="form-label font-weight-bold">Date Joined</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="date" class="form-control" name="date_joined" id="date_joined">
                                    </div>

                                    <label class="form-label font-weight-bold">Department</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <select class="form-select-md form-control" name="department" id="department" placeholder="--Select department--">
                                            <option value="" disabled selected>--Select an Option--</option>
                                            <option value="Video">Video</option>
                                            <option value="Sound">Sound</option>
                                            <option value="Computer">Computer</option>
                                            <option value="Vmix">VMix</option>
                                        </select>
                                    </div>

                                    <label class="form-label font-weight-bold">Role</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <select class="form-select-md form-control" name="role_id" id="department" placeholder="--Select department--">
                                            <option value="" disabled selected>--Select an Option--</option>
                                            @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label class="form-label font-weight-bold">Password</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>

                                    <label class="form-label font-weight-bold">Confirm Password</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-round btn-md bg-gradient-info w-30 mt-4 mb-0">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</x-app-layout>
