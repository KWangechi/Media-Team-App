<x-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot> -->
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
            <h3 class="text-center">EDIT USER</h3>
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf

                <!-- Name -->
                <div class="mt-4">
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$user->name}}" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}" required />
                </div>

                <!-- Phone Number -->
                <div class="mt-4">
                    <x-label for="phone" :value="__('Phone Number')" />

                    <x-input id="phone_number" class="block mt-1 w-full" type="number" name="phone_number" value="{{$user->phone_number}}" required />
                </div>

                <!-- Date Joined -->
                <div class="mt-4">
                    <x-label for="date_joined" :value="__('Date Joined')" />

                    <x-input id="date_joined" class="block mt-1 w-full" type="date" name="date_joined" value="{{$user->date_joined}}" required />
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

                <br>
                <div class="ml-4">
                    <x-button class="ml-4">
                        {{ __('Update') }}
                    </x-button>
                </div>

                <div class="mt-3 mb-150">
                    <a class="btn btn-secondary float-right" href="{{ route('admin.users.index') }}">Cancel</a>
                </div>
                <!-- <br>
                <br> -->
        </div>
        </form>
    </x-slot>
</x-app-layout>
