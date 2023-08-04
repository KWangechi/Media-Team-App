<x-app-layout>
    <x-slot name="slot">
        <div class="container">


            <br>
            <h1>Announcements Page</h1>
            <br>
            @foreach ($announcements as $announcement)
            <li>{{$announcement->id}}</li>
            <li>{{$announcement->type}}</li>
            <li>{{$announcement->notifiable_type}}</li>
            <li>{{$announcement->data}}</li>

            <br>
            <div class="row">
                <div class="col">
                    <form action="{{route('admin.announcement.delete', [$announcement->id])}}" method="post">
                        @csrf
                        <button class="btn btn-sm btn-danger">Delete</button>
                        @method('DELETE')
                    </form>

                </div>

                <div class="col">

                    @if ($announcement->read_at == null)
                    <a href="{{route('admin.announcement.readAnnouncement', [$announcement->id])}}">
                        <x-button class="btn btn-sm w-10">Mark As Read</x-button>
                    </a>
                    @else
                    <a href="{{route('admin.announcement.unreadAnnouncement', [$announcement->id])}}">
                        <button class="btn btn-sm btn-primary">Mark As Unread</button>
                    </a>

                    @endif
                </div>

            </div>
            <br>

            <br>
            <hr>
            <br>

            @endforeach
        </div>
    </x-slot>
</x-app-layout>

<style>

</style>
