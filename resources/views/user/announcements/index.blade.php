<x-app-layout>
    <x-slot name="slot">
        <div class="container">
            <br>
<h1>Announcements Page</h1>
@foreach ($announcements as $announcement)
<li>{{$announcement->id}}</li>
<li>{{$announcement->type}}</li>
<li>{{$announcement->notifiable_type}}</li>
<li>{{$announcement->data}}</li>


@endforeach
        </div>
    </x-slot>
</x-app-layout>

<style>

</style>
