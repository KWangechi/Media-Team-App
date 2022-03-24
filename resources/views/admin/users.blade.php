<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot> -->

    <x-slot name="slot">
        <div class="container text-centre">
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
            <a class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#createModal" id="createModalButton">CREATE NEW USER</a>

            <!-- Create Modal -->
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="createModalLabel">Create a New User</h5>
                            <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('users')}}" method="POST" name="myForm" id="myForm">
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
                                    <select name="department">
                                        <option value="">Select the department</option>
                                        <option value="Video">Video</option>
                                        <option value="Sound">Sound</option>
                                        <option value="Computer">Computer</option>
                                        <option value="VMix">VMix</option>
                                    </select>
                                </div>

                                <!-- Role -->
                                <div class="mt-4">
                                    <x-label for="role" :value="__('Usertype')" />

                                    <select name="role_id">
                                        <option value="">Select the usertype</option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Account Status -->
                                <!-- <input id="account_status" type="hidden" name="account_status" value="approved"/> -->

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
                        <th scope="col">Login Time(Sunday)</th>
                        <th scope="col">Account Status</th>
                        <th scope="col">EDIT</th>
                        <th scope="col">DELETE</th>

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
                        <td>
                            @if ($user->account_status == 'pending')
                            <a href="{{ route('users.approve', $user->id) }}" class="btn btn-primary btn-sm">Approve</a>
                            @else
                            {{$user->account_status}}
                            @endif
                        </td>
                        <td>
                            <a href="{{route('users.edit', $user->id)}}"class="btn btn-primary btn-sm">EDIT</a>
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id ) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">DELETE </button>
                            </form>
                            @endforeach
                    </tr>
                </tbody>
            </table>
        </div>


    </x-slot>
</x-app-layout>