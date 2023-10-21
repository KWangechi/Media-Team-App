<x-app-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="notifications"></x-navbars.sidebar>

        <div class="container">
        <x-navbars.navigation titlePage="Notifications"></x-navbars.navigation>

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

            <!-- search bar -->
            <form action="{{ route('admin.users.search') }}" method="get">

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
            <br>
            <br>
            <br>
            <div class="row float-right">
                <a class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#createModal" id="createModalButton">
                    <i class="bi bi-plus-circle"></i>
                    CREATE NEW USER
                </a>
            </div>

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

            <!-- Table -->
            <br>
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
                        <th scope="col">Last Login Time(Sunday)</th>
                        <th scope="col">Account Status</th>
                        <th scope="colgroup">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>{{$user->date_joined}}</td>
                        <td>{{$user->department}}</td>
                        <td>{{$user->login_time}}</td>

                        @if ($user->account_status == 'pending')
                        <td>
                            <a href="{{ route('admin.users.approve', $user->id) }}" class="btn btn-primary btn-sm">Approve</a>
                        </td>
                        @else
                        <td style="color: green">
                            {{$user->account_status}}
                            <i class="bi bi-check-circle"></i>
                        </td>
                        @endif

                        <td>
                            <a href="{{route('admin.users.edit', $user->id)}}">
                                <i class="bi bi-pencil btn btn-secondary btn-sm"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.users.destroy', $user->id ) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <!-- <i class="bi bi-trash3 btn btn-danger btn-sm">

                                </i> -->
                                <button class="bi bi-trash3 btn btn-danger btn-sm"></button>
                            </form>
                        </td>
                            @endforeach
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="row">
                <div class="col offset-md-6">
                    {{$users->links()}}
                </div>
            </div>
        </div>

</x-app-layout>
