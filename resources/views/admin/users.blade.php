<x-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
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
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                #Ref</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                Email</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Phone Number</th>
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
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div class="mx-auto">
                                                        <h6 class="mb-0 text-sm">{{$user->id}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{$user->name}}</p>
                                            </td>
                                            <td>
                                                <span class="text-sm font-weight-bold mb-0">{{$user->email}}</span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-weight-bold mb-0">{{$user->phone_number}}</span>
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
                                                @else
                                                <span class="text-xs text-lowercase badge bg-gradient-success">{{$user->account_status}}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <div class="row text-center mx-auto p-0">
                                                    <div class="col-6 mx-auto">
                                                        <a href="{{ route('admin.users.edit', $user->id) }}" rel="noopener noreferrer">
                                                            <button class="btn btn-link text-secondary mb-0">
                                                                <i class="fa fa-pen text-xs px-1"></i>
                                                                Edit
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="col-6">
                                                        <form action="{{ route('admin.users.delete',$user->id)}}" method="post">
                                                            @csrf()
                                                            @method('DELETE')

                                                            <button class="btn btn-link text-secondary mb-0 ">
                                                                <i class="fa fa-trash px-1" aria-hidden="true"></i>
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
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title" id="createModalLabel">Create a New User</h5>
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.users.create')}}" method="POST" name="myForm" id="myForm">
                            @csrf

                            <!-- Name -->
                            <div>
                                <x-label for="name" :value="__('Name')" />

                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                            </div>

                            <!-- Phone Number -->
                            <div class="mt-4">
                                <x-label for="phone" :value="__('Phone Number')" />

                                <x-input id="phone_number" class="block mt-1 w-full" type="number" name="phone_number" :value="old('phone_number')" required />
                            </div>

                            <!-- Date Joined -->
                            <div class="mt-4">
                                <x-label for="date_joined" :value="__('Date Joined')" />

                                <x-input id="date_joined" class="block mt-1 w-full" type="date" name="date_joined" :value="old('date_joined')" required />
                            </div>

                            <!-- Department -->
                            <div class="mt-4">
                                <x-label for="deparment" :value="__('Department')" />
                                <select name="department" class="block mt-1 w-full rounded shadow-sm">
                                    <option value="" selected disabled>---Select the department---</option>
                                    <option value="Video">Video</option>
                                    <option value="Sound">Sound</option>
                                    <option value="Computer">Computer</option>
                                    <option value="VMix">VMix</option>
                                </select>
                            </div>

                            <!-- Role -->
                            <div class="mt-4">
                                <x-label for="role" :value="__('Usertype')" />

                                <select name="role_id" class="block mt-1 w-full rounded shadow-sm">
                                    <option value="" selected disabled>---Select the usertype---</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-label for="password" :value="__('Password')" />

                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                            </div>
                            <br>
                            <x-button class="ml-4" id="create">
                                {{ __('Create') }}
                            </x-button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>



        <!-- Pagination -->
        <!-- <div class="row">
            <div class="col offset-md-6">
                {{$users->links()}}
            </div>
        </div> -->
    </main>

</x-app-layout>
