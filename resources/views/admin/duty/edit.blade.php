<x-app-layout>
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
            <h3 class="text-center">EDIT DUTY ROSTER</h3>
            <form method="POST" action="{{ route('admin.duty.update', $duty->id) }}">
                @csrf
                @method('PATCH')

                <!-- Member Name -->
                <div class="mt-4">
                                    <x-label for="Week" :value="__('Week')" />

                                    <x-input value="{{ $duty->week }}" class="block mt-1 w-full" id="week" name="week" type="text" autofocus />
                                </div>

                                <!-- Supervisor Name -->
                                <!-- <div class="mt-4">
                                    <x-label for="supervisor_name" :value="__('Supervisor Name')" />

                                    <x-input :value="$duty->supervisor_name" class="block mt-1 w-full" id="supervisor_name" name="supervisor_name" type="text" autofocus placeholder="eg. RKay" />
                                </div> -->

                                <!-- Workstation -->
                                <!-- <div class="mt-4">
                                    <x-label for="workstation" :value="__('Workstation')" />

                                    <x-input id="workstation" :value="$duty->workstation" class="block mt-1 w-full" type="text" name="workstation" required placeholder="eg. Video, VMix" />
                                </div> -->


                                <!-- Duty Assigned -->
                                <!-- <div class="mt-4">
                                    <x-label for="duty_assigned" :value="__('Duty Assigned')" />

                                    <x-input id="duty_assigned" :value="$duty->duty_assigned" class="block mt-1 w-full" type="text" name="duty_assigned" required placeholder="eg. Check on Sound Quality" />
                                </div> -->

                                <!-- Type of Service or Event -->
                                <!-- <div class="mt-4">
                                    <x-label for="type_of_service" :value="__('Type of Service')" />

                                    <select name="type_of_service">
                                        <option value="$duty->type_of_service"> {{ $duty->type_of_service }} </option>
                                        <option value="1st Service">1st Service</option>
                                        <option value="2nd Service">2nd Service</option>
                                        <option value="Gwav Service">GWAV Service</option>
                                        <option value="Wedding">Wedding</option>
                                        <option value="Funeral">Funeral</option>
                                        <option value="Graduation">Graduation</option>

                                    </select>
                                </div> -->

                                <!-- Supervisor signature -->
                                <div class="mt-4">
                                    <x-label for="supervisor_signature" :value="__('Supervisor Signature')" />

                                    <select name="supervisor_signature" class="block mt-2 w-full">

                                        <option value="0">Pending</option>
                                        <option value="1">Signed</option>
                                    </select>
                                </div>

                                <!-- Setup Time -->
                                <div class="mt-4">
                                    <x-label for="setup_time" :value="__('Setup Time')" />

                                    <x-input id="setup_time" :value="$duty->setup_time" class="block mt-1 w-full" type="time" name="setup time" required />
                                </div>

                                <!-- Date Assigned -->
                                <div class="mt-4">
                                    <x-label for="date_assigned" :value="__('Date Assigned')" />

                                    <x-input id="date_assigned" :value="$duty->date_assigned" class="block mt-1 w-full" type="date" name="date_assigned" required />
                                </div>

                                <br>
                <div class="ml-4">
                    <x-button class="ml-4">
                        {{ __('Update') }}
                    </x-button>
                </div>

                <div class="mt-3 mb-150">
                    <a class="btn btn-secondary float-right" href="{{ route('admin.duty.index') }}">Cancel</a>
                </div>

                <!-- <br>
                <br> -->
        </div>
        </form>
    </x-slot>
</x-app-layout>
