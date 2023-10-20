<x-app-layout>
<x-sidebar activePage='user-profile'></x-sidebar>
    <x-slot name="slot">
        <br>
        <div class="container">
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
        </div>

        <br>
        <div class="container">
            @if ($profiles->isEmpty())
            <div class="alert alert-info alert-dismissible fade show">
                You have no user profile. Click the button to create one
                <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>
            <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createProfileModal" id="createProfileButton">CREATE A PROFILE</a>

            <!--  Create Profile Modal -->
            <div class="modal fade" id="createProfileModal" tabindex="-1" aria-labelledby="createProfileModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="createModalLabel">Create a Profile</h5>
                            <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user.profile.create', auth()->user()->id) }}" method="POST" enctype="multipart/form-data" name="myForm" id="myForm">
                                @csrf

                                <!-- Name -->
                                <div class="mt-4">
                                    <x-label for="about" :value="__('About')" />

                                    <textarea id="about" class="block mt-1 w-full" type="textarea" name="about" placeholder="Write something short about yourself">

                                </textarea>
                                </div>

                                <div class="mt-4">
                                    <x-label for="date_of_birth" :value="__('Date of Birth')" />

                                    <x-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="photo" :value="__('Profile Photo')" />

                                    <x-input id="photo" class="block mt-1" type="file" name="photo" />
                                </div>
                                <div class="mt-4">
                                    <x-button class="text-center">
                                        {{ __('Save Profile') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            @else
            <!-- Profile Card -->
            @foreach ($profiles as $profile)
            <div class="card mx-auto text-center" style="width: 18rem">
                <div class="card-header">
                    <h3>My Profile</h3>
                </div>
                <div>

                    <img src="{{ asset('storage/'.$profile->photo) }}" class="card-img-top" alt="profile photo">
                </div>
                <div class="card-body">
                    <p class="card-text">{{$profile->about}}</p>
                    <br>
                    <p class="card-text">Date of birth: {{$profile->date_of_birth}}</p>

                    <br>

                    <div class="card-footer">
                        <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateProfileModal" id="updateProfileButton">UPDATE YOUR PROFILE</a>
                    </div>

                    <!-- Update Modal -->
                    <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Update Profile</h5>
                                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('user.profile.update', [auth()->user()->id, $profile->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Name -->
                                        <div class="mt-4">
                                            <x-label for="about" :value="__('About')" />

                                            <textarea id="about" class="block mt-1 w-full" type="textarea" name="about" autofocus>
                                            {{$profile->about}}
                                            </textarea>
                                        </div>

                                        <div class="mt-4">
                                            <x-label for="date_of_birth" :value="__('Date of Birth')" />

                                            <x-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" value="{{$profile->date_of_birth}}" />
                                        </div>

                                        <div class="mt-4">
                                            <x-label for="photo" :value="__('Profile Photo')" />

                                            <x-input id="photo" class="block mt-1" type="file" name="photo" value="{{$profile->photo}}" />
                                        </div>
                                        <div class="mt-4">
                                            <x-button class="text-center">
                                                {{ __('Save') }}
                                            </x-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="{{ route('user.profile.delete', [auth()->user()->id, $profile->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">DELETE PROFILE</button>
                        </form>

                    </div>

                </div>
            </div>
            @endforeach
            @endif
        </div>
    </x-slot>
</x-app-layout>
