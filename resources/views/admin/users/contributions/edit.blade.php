<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contributions') }}
        </h2>
    </x-slot>
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
            <h3 class="text-center">EDIT CONTRIBUTION DETAILS</h3>
            <form method="POST" action="{{ route('admin.users.contributions.update', $contribution->id) }}">
                @csrf
                @method('PATCH')

                <!-- Name -->
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

                                    <x-input id="amount_contributed" class="block mt-1 w-full" type="number" name="amount_contributed" value="{{ $contribution->amount_contributed }}" required />
                                </div>

                                <!-- Contribution Date -->
                                <div class="mt-4">
                                    <x-label for="date_contributed" :value="__('Contribution Date')" />

                                    <x-input id="date_contributed" class="block mt-1 w-full" type="date" name="date_contributed" value="{{ $contribution->date_contributed }}" required />
                                </div>

                                <!-- Comment -->
                                <div class="mt-4">
                                    <x-label for="comment" :value="__('Comment')" />

                                    <x-input id="comment" class="block mt-1 w-full" type="text" name="comment" value="{{ $contribution->comment }}" required />
                                </div>

                                <br>
                <div class="ml-4">
                    <x-button class="ml-4">
                        {{ __('Update') }}
                    </x-button>
                </div>

                <div class="mt-3 mb-150">
                    <a class="btn btn-secondary float-right" href="{{ route('admin.users.contributions') }}">Cancel</a>
                </div>
                <!-- <br>
                <br> -->
        </div>
        </form>
    </x-slot>
</x-app-layout>
