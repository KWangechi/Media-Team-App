<x-app-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="notifications"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navigation titlePage="Unread Notifications"></x-navbars.navigation>


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


            @if (auth()->user()->unreadNotifications->isEmpty())
                <div class="text-center mt-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-envelope-open" viewBox="0 0 16 16">
                        <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l5.75 3.45L8 8.917l1.25.75L15 6.217V5.4a1 1 0 0 0-.53-.882l-6-3.2ZM15 7.383l-4.778 2.867L15 13.117V7.383Zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734ZM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2Z" />
                    </svg>
                    <h3 class="mt-5">NO ANNOUNCEMENTS YET</h3>
                    <p class="mt-4">Your inbox is empty. Announcements will be displayed here once they're sent</p>

                    <a class="btn bg-gradient-warning mt-3" href="{{ route('user.announcements.all') }}">
                        <!-- <i class="material-icons">drafts</i> -->
                        View all messages
                    </a>

                </div>
                @else

                <!-- marking notifications as read -->
                <a class="btn bg-gradient-secondary mx-4 mb-1" href="{{ route('announcement.markAllAsRead') }}">
                    <i class="material-icons">drafts</i>
                    MARK ALL NOTIFICATIONS AS READ
                </a>

                @foreach (auth()->user()->unreadNotifications as $announcement)

                <div class="card my-3">
                    <div class="row mb-3 mt-5 mx-auto">
                        @if (auth()->user()->profile)
                        <div class="col-lg-2">
                            <img src="{{ asset('/storage/'.auth()->user()->profile->photo) }}" alt="" class=" rounded-circle shadow-4-strong" width="70px;" height="70px;">
                        </div>
                        @else
                        <i style="font-size: 2.0rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                        @endif

                        <div class="col">
                            <div class="row">
                                <p class="wrap"><b>{{$announcement->data['subject']}}</b></p>
                                <p>{{$announcement->data['body']}} </p>
                                <p>{{$announcement->created_at}}</p>
                            </div>
                        </div>
                    </div>

                    <hr class="w-70 mx-auto mt-0">

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
