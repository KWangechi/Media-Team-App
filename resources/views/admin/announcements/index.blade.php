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
<a href="{{route('admin.announcement.readAnnouncement')}}">
    <x-button >Mark As Read</x-button>
</a>
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
