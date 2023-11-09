<x-layout bodyClass="g-sidenav-show bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="user-profile"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navigation titlePage='User Profile'></x-navbars.navigation>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset('/storage/'.auth()->user()->profile->photo) }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm mt-2" height="80px;">
                        </div>
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
                                <h6 class="mb-3">Profile Information</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">

                        <form method="POST" action="{{ route('user.profile.update', [auth()->id(), $profile->id]) }}">
                            @csrf
                            @method('PATCH')

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control border-2 p-2" value='{{ old('email', auth()->user()->email) }}'>
                                    @error('email')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control border-2 p-2" value='{{ old('name', auth()->user()->name) }}'>
                                    @error('name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="number" name="phone" class="form-control border-2 p-2" value='{{ old('phone', auth()->user()->phone_number) }}'>
                                    @error('phone')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="text" name="date_of_birth" class="form-control border-2 p-2" value='{{ old('date_of_birth', auth()->user()->profile->date_of_birth) }}'>
                                    @error('date_of_birth')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="floatingTextarea2">About</label>
                                    <textarea class="form-control border-2 p-2" placeholder=" Say something about yourself" id="floatingTextarea2" name="about" rows="4" cols="50">{{ old('about', auth()->user()->profile->about) }}</textarea>
                                    @error('about')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn bg-gradient-light">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>

</x-layout>
