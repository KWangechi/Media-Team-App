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
                        <div class="leave_request_form">
                            <form action="{{ route('user.leave.create', auth()->user()->id) }}" method="POST" id="createLeaveForm" enctype="multipart/form-data">
                                @csrf

                                <!-- Reason -->
                                <div class="mt-4">
                                    <x-label for="reason" :value="__('Reason')" />
                                    <select name="reason">
                                        <option value="">Select the reason</option>
                                        <option value="Sickness">Sickness</option>
                                        <option value="Bereavement">Bereavement</option>
                                        <option value="Travelling">Travelling</option>
                                        <option value="Personal Reasons">Personal Reasons(Prefer not to say)</option>
                                    </select>
                                </div>

                                <!-- Start Date -->
                                <div class="mt-4">
                                    <x-label for="start_date" :value="__('Start Date')" />

                                    <x-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" required />
                                </div>

                                <!-- End Date -->
                                <div class="mt-4">
                                    <x-label for="end_date" :value="__('End Date')" />

                                    <x-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" required />
                                </div>
                                <br>
                                <x-button class="ml-4" id="createLeaveRequest" type="submit">
                                    {{ __('Save') }}
                                </x-button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" href="{{ route('user.leaves.index', auth()->user()->id) }}">Cancel</a>
                        </div>
        </div>
    </x-slot>
</x-app-layout>

<script>
    $(document).ready(function() {
        $("#createLeaveModalButton").click(function() {
            $("#createLeaveModal").fadeToggle();
            // console.log('Display the modal')
        })
        $("#closeModalButton").click(function() {
            $(".modal").toggle()
        })
    })
</script>
