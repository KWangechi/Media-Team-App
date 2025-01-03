<x-guest-layout>
    <x-auth-card>
        <!-- <x-slot name="logo">
        <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('storage/images/PCEA-church-logo-a-2.png') }}" class="card-img-top" alt="PCEA LOGO" style="width: 70px; height: 85px;">

                    </a>
                </div>
        </x-slot> -->

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show">
                {{ session('message') }}
                <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>
        @endif
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!-- message for account approval -->

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Login time -->
            @if ($day == "Sunday")
            <div class="mt-4">
                <x-label for="login_time" :value="__('Login Time')" />

                <x-input id="login_time" class="block mt-1 w-full" type="text" name="login_time" value="{{$current_time}}" disabled required />
            </div>

            @endif

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>

            </div>

            <div class="block mt-4">
                <p>Don't have an account?
                    <a href="/register">Register Here</a>
                </p>
                </label>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
