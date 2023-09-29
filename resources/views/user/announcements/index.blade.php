<x-app-layout>
    <x-slot name="slot">

        <div class="container" style="margin-top: 10px;">
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

            <h1 style="margin-top: 10px;">Announcements Page</h1>

            @if (count($announcements) < 0)
             <div>
                No Announcements Yet
        </div>
        @else
        <br>
        @foreach (auth()->user()->notifications as $announcement)
        <div class="mt-2" style="margin-left: 30px;">

            <li>Title: {{$announcement->data['title']}} </li>
            <b><i><li>{{$announcement->type}}</li></i></b>
            <li>Message: {{$announcement->data['body']}} </li>

            <br>
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
                    <x-button class="btn btn-sm w-10">Mark As Read</x-button>
                </a>
                @else
                <a href="{{route('announcement.unreadAnnouncement', [$announcement->id])}}">
                    <button class="btn btn-sm btn-primary">Mark As Unread</button>
                </a>

                @endif
            </div>
        </div>

        </div>
        <br>

        <br>
        <hr>
        <br>

        @endforeach
        @endif



    </x-slot>
</x-app-layout>

<style>

</style>
