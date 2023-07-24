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
            <h3 class="text-center">EDIT MEMBER DETAILS ROSTER</h3>
            <form method="POST" action="{{ route('admin.duty.updateDutyPersonelDetails', $member_details->id) }}">
                @csrf
                @method('PATCH')

                <div class="mt-4">
                <x-label for="Duty ID" :value="__('Duty ID')" />
                    <x-input value=" {{ $member_details->duty_id }}" class="block mt-1 w-full" id="duty_id" name="duty_id" type="number" disabled />
                </div>
                <!-- Member Name -->
                <div class="mt-4">
                    <x-label for="Member Name" :value="__('Member Name')" />

                    <x-input value="{{ $member_details->member_name }}" class="block mt-1 w-full" id="member_name" name="member_name" type="text" autofocus />
                </div>

                <!-- Workstation -->
                <div class="mt-4">
                    <x-label for="workstation" :value="__('Workstation')" />

                    <x-input id="workstation" :value="$member_details->workstation" class="block mt-1 w-full" type="text" name="workstation" required placeholder="eg. Video, VMix" />
                </div>

                <!-- Duty Aassigned -->
                <div class="mt-4">
                    <x-label for="duty_assigned" :value="__('Duty Assigned')" />
                    <x-input :value="$member_details->duty_assigned" id="duty_assigned" class="block mt-1 w-full" type="text" name="duty_assigned" required placeholder="eg. Check on Sound Quality" />
                </div>


                <!-- Type of Service or Event -->
                <div class="mt-4">
                    <x-label for="Event Type" :value="__('Event Type')" />

                    <select name="event_type">
                        <option value="{{ $member_details->event_type }}"> {{ $member_details->event_type }} </option>
                        <option value="1st Service">1st Service</option>
                        <option value="2nd Service">2nd Service</option>
                        <option value="Gwav Service">GWAV Service</option>
                        <option value="Wedding">Wedding</option>
                        <option value="Funeral">Funeral</option>
                        <option value="Graduation">Graduation</option>

                    </select>
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
