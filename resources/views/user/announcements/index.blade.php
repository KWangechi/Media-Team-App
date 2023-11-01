<x-app-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="notifications"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navigation titlePage="Notifications"></x-navbars.navigation>

        <!-- <h4 class="text-center mt-3">Announcements Page</h4> -->
        <div class="container-fluid py-4">
            <!-- Toast notifications -->
            @if (session('success_message'))
            <div class="toast-container" style="position: absolute; top: 20px; right: 40px;" data-bs-animation="true" data-bs-delay="3000">
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


            @if ($announcements->isEmpty()) <div>
                No Announcements Yet
                @else


                @foreach (auth()->user()->unreadNotifications as $announcement)
                <!-- <div class="card my-5 ml-5">
                    <div class="card-body"> -->
                <div class="card my-3">
                    <div class="row mb-3 mt-5 mx-auto">
                        <div class="col-lg-2">
                            <img src="{{ asset('/storage/'.auth()->user()->profile->photo) }}" alt="" class=" rounded-circle shadow-4-strong" width="70px;" height="70px;">
                        </div>

                        <div class="col">
                            <div class="row">
                                <p class="wrap"><b>{{$announcement->data['subject']}}</b></p>
                                <p>{{$announcement->data['body']}} </p>
                                <p>{{$announcement->created_at}}</p>
                            </div>
                        </div>
                    </div>

                    <hr class="w-70 mx-auto">

                    <div class="btn-group mx-14">
                        <!-- <div class=""> -->
                            <form action="{{route('announcement.delete', [$announcement->id])}}" method="post">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger mx-12">Delete</button>
                            </form>
                        <!-- </div> -->

                        <!-- <div class="col-6 w-60"> -->
                            @if ($announcement->read_at == null)
                            <a href="{{ route('announcement.readAnnouncement', [$announcement->id]) }}" class="btn btn-sm hover:bg-teal-200">
                                <button class="btn btn-sm btn-info">Mark As Read</button>
                                <!-- Mark As Read -->
                            </a>
                            @else
                            <a href="{{route('announcement.unreadAnnouncement', [$announcement->id])}}">
                                <x-button class="btn btn-sm btn-primary hover:bg-red-600">Mark As Unread</x-button>
                            </a>
                            @endif
                        <!-- </div> -->
                    </div>


                </div>
                @endforeach
                @endif
</x-app-layout>
<style>

</style>
