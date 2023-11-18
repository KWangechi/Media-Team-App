<x-layout bodyClass="g-sidenav-show bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="users"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100">

        <!-- Navbar -->
        <x-navbars.navigation titlePage='Edit User: {{$user->id}}'></x-navbars.navigation>

        <!-- Display error or success message -->
        @if (session('success_message'))
        <div class="toast-container" style="position: absolute; top: 30px; right: 40px;" data-bs-animation="true" data-bs-delay="3000">
            <div class="toast fade show">
                <div class="toast-header">
                    <span class="badge bg-gradient-success mx-2">.</span>
                    <strong class="me-auto"><i class="bi-globe"></i>Success Message</strong>
                    <small>just now</small>
                    <button type="button" class="btn-close btn-sm bg-dark" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('success_message') }}
                </div>
            </div>
        </div>

        @elseif (session('error_message'))
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

        <h4 class="text-center">EDIT USER</h4>

        <div class="card-body p-3">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label font-weight-bold">Name</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <input type="text" class="form-control" name="name" id="name" required autofocus value="{{$user->name}}">
                    </div>
                </div>

                <div class="col-md-6">

                    <label class="form-label font-weight-bold">Email</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <input type="email" class="form-control" name="email" id="email" required value="{{$user->email}}">
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <label class="form-label font-weight-bold">Phone Number</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <input type="number" class="form-control" name="phone_number" id="phone_number" required value="{{$user->phone_number}}">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label font-weight-bold">Date Joined</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <input type="date" class="form-control" name="date_joined" id="date_joined" value="{{$user->date_joined}}">
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <label class="form-label font-weight-bold">Department</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <select class="form-select-md form-control" name="department" id="department" placeholder="--Select department--">
                            <option value="" disabled selected>--{{$user->department}}--</option>
                            <option value="Video">Video</option>
                            <option value="Sound">Sound</option>
                            <option value="Computer">Computer</option>
                            <option value="Vmix">VMix</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label font-weight-bold">Role</label>
                    <div class="input-group input-group-outline mt-1 mb-3">
                        <select class="form-select-md form-control" name="role_id" id="department" placeholder="--Select department--">
                            <option value="" disabled selected>{{$user->role->name}}</option>
                            @foreach ($roles as $role)
                            <option value="{{$user->role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-sm btn-round bg-gradient-primary mt-4 mb-0">Save Changes</button>
            </div>

        </form>
        </div>
    </main>
</x-layout>
