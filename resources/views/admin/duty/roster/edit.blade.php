<x-app-layout>

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
            <h3 class="text-center">EDIT DUTY ROSTER DETAILS</h3>
            <form method="POST" action="{{ route('admin.duty.roster.update', $duty->id) }}">
                @csrf
                @method('PATCH')

                <!-- Week -->
                <div class="mt-4">
                    <x-label for="week" :value="__('Week')" />

                    <x-input :value="$duty->week" class="block mt-1 w-full" id="week" name="week" type="week" autofocus placeholder="eg. Week 10" />
                </div>

                <!-- Setup Time -->
                <div class="mt-4">
                    <x-label for="setup_time" :value="__('Setup Time')" />

                    <x-input :value="$duty->setup_time" id="setup_time" class="block mt-1 w-full" type="time" name="setup time" required />
                </div>

                <!-- Date Assigned -->
                <div class="mt-4">
                    <x-label for="date_assigned" :value="__('Date Assigned')" />

                    <x-input :value="$duty->date_assigned" id="date_assigned" class="block mt-1 w-full" type="date" name="date_assigned" required />
                </div>


                <br>
                <div class="ml-4">
                    <x-button class="ml-4">
                        {{ __('Update') }}
                    </x-button>
                </div>

                <div class="mt-3 mb-20">
                    <a class="btn btn-secondary float-right mb-lg-0" href="{{ route('admin.duty.index', auth()->user()->id )}}">Cancel</a>
                </div>

        </div>
        </form>
    </x-slot>
</x-app-layout>
