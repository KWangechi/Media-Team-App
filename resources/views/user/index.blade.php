<x-app-layout bodyClass="g-sidenav-show bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="profile"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navigation titlePage='User Profile'></x-navbars.navigation>
        <!-- End Navbar -->

        @if (session('success_message'))
        <div class="toast-container" style="position: absolute; top: 10px; right: 40px;" data-bs-animation="true" data-bs-delay="2000">
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
        <div class="toast-container" style="position: absolute; top: 20px; right: 40px;" data-bs-animation="true" data-bs-delay="3000">
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

        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto px-4">
                        @if (auth()->user()->profile)
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset('/storage/'.auth()->user()->profile->photo) }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm mt-2" height="80px;">
                        </div>
                        @else
                        <i style="font-size: 4.5rem;" class="material-icons ps-2 pe-2 text-center">
                            account_circle
                        </i>
                        @endif
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ auth()->user()->name }}
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                Team Member
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h5 class="mb-3 mt-2">Profile Information</h5>
                            </div>
                        </div>
                    </div>

                    @if ($profile)
                    <div class="card-body p-3">
                        <form method="POST" action="{{ route('user.profile.update', [auth()->id(), $profile->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Email address</label>
                                    <div class="input-group input-group-outline mt-1 mb-3 col-md-6">
                                        <input type="email" name="email" class="form-control border-2 p-2" value='{{ old('email', auth()->user()->email) }}' readonly>
                                        @error('email')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <div class="input-group input-group-outline mt-1 mb-3 col-md-6">
                                        <input type="text" name="name" class="form-control border-2 p-2" value='{{ old('name', auth()->user()->name) }}' readonly>
                                        @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <div class="input-group input-group-outline mt-1 mb-3 col-md-6">
                                        <input type="number" name="phone" class="form-control border-2 p-2" value='{{ old('phone', auth()->user()->phone_number) }}'>
                                        @error('phone')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Date of Birth</label>
                                    <div class="input-group input-group-outline mt-1 mb-3 col-md-6">
                                        <input type="date" name="date_of_birth" class="form-control border-2 p-2" value='{{ old('date_of_birth', auth()->user()->profile->date_of_birth) }}'>
                                        @error('date_of_birth')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4 mb-3">
                                <div class="col-md-6">
                                    <label for="profilePhoto" class="form-label">Profile Photo</label>
                                    <div class="input-group input-group-outline mt-2 mb-3 col-md-6">
                                        <input class="form-control border px-3" type="file" id="photo" name="photo">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="about">About</label>
                                <textarea class="form-control border p-3" id="about" name="about" rows="4" cols="50">{{ old('about', auth()->user()->profile->about) }}</textarea>
                                @error('about')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm bg-gradient-info text-center mx-auto">Save Changes</button>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm bg-gradient-danger mx-8" data-bs-toggle="modal" data-bs-target="#deleteProfileModal-{{$profile->id}}">
                                Delete Profile
                            </button>

                            <div class="modal fade" id="deleteProfileModal-{{$profile->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card card-plain">
                                                <div class="card-header pb-0 text-left">
                                                    <h5 class="">Delete Profile</h5>
                                                </div>
                                                <div class="card-body text-lg">
                                                    <i style="font-size: 2.5rem;" class="material-icons placeholder-opacity-10">
                                                        warning</i>
                                                    <span class="mt-0">
                                                        Are you sure you want to delete this? Action can't be reversed
                                                    </span>
                                                </div>
                                                <div class="card-footer mx-4">
                                                    <button type="button" class="btn btn-sm btn-secondary text-white ml-auto" data-bs-dismiss="modal">Close</button>
                                                    <a href="{{route('user.profile.delete', [auth()->id(), $profile->id])}}" class="btn btn-sm btn-danger">
                                                        Delete
                                                    </a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            </button>
                        </form>
                    </div>
                    @else
                    <div class="text-center mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                        <h5 class="mt-3">NO PROFILE YET</h5>
                        <p class="mt-4 mx-auto">You have no profile</p>

                        <a class="btn bg-gradient-warning mt-3 mb-6" data-bs-toggle="modal" data-bs-target="#createProfileModal" id="createProfileModalButton">
                            <i class="material-icons">person</i>
                            Create a Profile
                        </a>
                    </div>

                    <div class="modal fade" id="createProfileModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                            <h5 class="">Create a Profile</h5>
                                        </div>
                                        <div class="card-body">
                                            <!-- Modal for creating a profile -->
                                            <form method="POST" action="{{ route('user.profile.create', auth()->id()) }}" enctype="multipart/form-data">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Date of Birth</label>
                                                        <div class="input-group input-group-outline mt-1 mb-3 col-md-6">
                                                            <input type="date" name="date_of_birth" class="form-control border-2 p-2">
                                                            @error('date_of_birth')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="profilePhoto" class="form-label">Profile Photo</label>
                                                        <div class="input-group input-group-outline mt-2 mb-3 col-md-6">
                                                            <input class="form-control border px-3" type="file" id="photo" name="photo">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <label for="about">About</label>
                                                    <textarea class="form-control border p-3" id="about" name="about" rows="4" cols="50"></textarea>
                                                    @error('about')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-sm bg-gradient-info text-center">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
