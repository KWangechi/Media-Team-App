<x-app-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="admin-contributions"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <x-navbars.navigation titlePage="Edit Contribution"></x-navbars.navigation>
        <div class="container">
            <h3 class="text-center">
                <strong>
                    Edit Contribution {{$contribution->id}}
                </strong>
            </h3>


            <!-- Display error or success message -->
            @if (session('error_message'))
            <div class="toast-container" style="position: absolute; top: 30px; right: 40px;" data-bs-animation="true" data-bs-delay="3000">
                <div class="toast fade show">
                    <div class="toast-header">
                        <span class="badge bg-gradient-danger mx-2">.</span>
                        <strong class="me-auto"><i class="bi-globe"></i>Error Message</strong>
                        <small>just now</small>
                        <button type="button" class="btn-close btn-sm bg-dark" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        {{session('error_message')}}
                    </div>
                </div>

            </div>

            @endif


            <div class="leave_request_form">
                <form action="{{ route('admin.users.contributions.update', $contribution->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <label class="form-label font-weight-bold">Member name</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <select class="form-select-md form-control" name="user_id" id="user_id">
                            <option value="" disabled selected>--{{$contribution->user->name}}--</option>
                            @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label class="form-label font-weight-bold">Date Contributed</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <input type="date" class="form-control" name="date_contributed" id="date_contributed" value="{{$contribution->date_contributed}}">
                    </div>

                    <label class="form-label font-weight-bold">Amount Contributed(Kshs. )</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <input type="number" class="form-control" name="amount_contributed" id="amount_contributed" value="{{$contribution->amount_contributed}}">
                    </div>

                    <label for="about">Comments</label>
                    <textarea class="form-control border p-3" id="comment" name="comment" rows="3" cols="50">{{$contribution->comment}}</textarea>
                    @error('comments')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <div class="text-center ">
                        <button type="submit" class=" btn btn-round btn-md bg-gradient-primary mt-4 mb-2">Save Changes</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary btn-sm mt-2" href="{{ route('admin.users.contributions') }}">Cancel</a>
            </div>
        </div>
    </main>
</x-app-layout>
