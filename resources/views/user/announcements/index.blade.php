<x-app-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="notifications"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navigation titlePage="Notifications"></x-navbars.navigation>

        <!-- <h4 class="text-center mt-3">Announcements Page</h4> -->
        <div class="container-fluid py-4">
            <div class="card">
                <div class="col-lg-8 col-md-10">
                    @if (session('success_message'))
                    <div class="alert alert-success alert-dismissible text-white" role="alert">
                        <span class="text-sm">{{ success_message }}</span>
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    @elseif (session('error_message'))
                    <div class="alert alert-success alert-dismissible text-white" role="alert">
                        <span class="text-sm">{{ error_message }}</span>
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (count($announcements) < 0) <div>
                        No Announcements Yet
                </div>
                @else
                @foreach (auth()->user()->notifications as $announcement)
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <img src="{{ asset('/storage/'.auth()->user()->profile->photo) }}" alt="" class=" rounded-circle shadow-4-strong" width="70px;" height="70px;">
                        </div>

                        <div class="col">
                            <div class="row">
                                <p class="text-nowrap"><b>{{$announcement->data['subject']}}</b></p>
                                <p>{{$announcement->data['body']}} </p>
                                <p>{{$announcement->created_at}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <form action="{{route('announcement.delete', [$announcement->id])}}" method="post">
                                @csrf
                                <button class="btn btn-sm btn-danger">Delete</button>
                                @method('DELETE')
                            </form>

                        </div>

                        <div class="col">
                            @if ($announcement->read_at == null)
                            <a href="{{route('announcement.readAnnouncement', [$announcement->id])}}">
                                <x-button class="btn btn-sm hover:bg-teal-200">Mark As Read</x-button>
                            </a>
                            @else
                            <a href="{{route('announcement.unreadAnnouncement', [$announcement->id])}}">
                                <x-button class="btn btn-sm btn-primary hover:bg-red-600">Mark As Unread</x-button>
                            </a>

                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </main>


    <br>

    <br>
    <hr>
    <br>

    @endforeach
    @endif


</x-app-layout>
<style>

</style>
