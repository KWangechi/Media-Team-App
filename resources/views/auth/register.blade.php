<x-guest-layout>
    <x-auth-card>

                 <x-slot name="logo">
        <div class="shrink-0 flex items-center mt-4">
                    <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('storage/images/PCEA-church-logo-a-2.png') }}" class="card-img-top" alt="PCEA LOGO" style="width: 70px; height: 85px;">

                    </a>
                </div>
        </x-slot>


        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
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
                <select name="department" class="w-100 rounded-md shadow-sm border-gray-300">
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

                <select name="role_id" class="w-100 rounded-md shadow-sm border-gray-300">
                    <option value="">Select the usertype</option>
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

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
