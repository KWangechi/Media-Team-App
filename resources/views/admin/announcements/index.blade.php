<x-app-layout>
    <x-slot name="slot">
        <div class="container">
            <br>
            <!-- Display error or success message -->
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

            <!-- insert a filter for the announcements -->
            <form action="{{ route('admin.announcements.filterByEventLocation')}}" method="get">
                <div class="mt-4">
                    <select name="filter" id="filter">
                        <!-- <option value="...">Filter by</option> -->
                        <option value="event_date">Event Date</option>
                        <option value="event_location">Event Location</option>
                    </select>
                </div>

                <div class="mt-4">
                    <button class="btn btn-primary">
                        Filter
                    </button>
                </div>
            </form>
            <!-- check if announcement is empty -->
            @if ($announcements->isEmpty())
            <div class="alert alert-info alert-dismissible">
                No announcements made yet
            </div>

            <a class="btn btn-primary btn-sm text-center float-right" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal" id="createAnnouncementModalButton">
                <i class="bi bi-plus-circle"></i>
                CREATE NEW ANNOUNCEMENT
            </a>

            <!-- Create announcement Request Modal when Empty-->

            <div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-labelledby="createAnnouncementModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="createAnnouncementModalTitle">Create a New Announcement Request</h5>
                            <a class="btn-close" id="closeModalButton" data-bs-dismiss="modal" aria-label="Close"></a>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.announcement.create') }}" method="POST" id="createAnnouncementForm">
                                @csrf

                                <!-- Title -->
                                <div class="mt-4">
                                    <x-label for="title" :value="__('Title')" />

                                    <x-input id="title" class="block mt-1 w-full" type="text" name="title" required />
                                </div>

                                <!-- Content -->
                                <div class="mt-4">
                                    <x-label for="content" :value="__('Content')" />

                                    <!-- <textarea required /> -->
                                    <x-textarea name="content" id="content" required>

                                    </x-textarea>

                                </div>

                                <!-- Event Location -->
                                <div class="mt-4">
                                    <x-label for="event_location" :value="__('Event Location')" />

                                    <x-input id="event_location" class="block mt-1 w-full" type="text" name="event_location" required />
                                </div>

                                <!-- Event Date -->
                                <div class="mt-4">
                                    <x-label for="event_date" :value="__('Event Date')" />

                                    <x-input id="event_date" class="block mt-1 w-full" type="date" name="event_date" required />
                                </div>

                                <!-- Event Time -->
                                <div class="mt-4">
                                    <x-label for="event_time" :value="__('Event Time')" />

                                    <x-input id="event_time" class="block mt-1 w-full" type="time" name="event_time" required />
                                </div>

                                <br>
                                <x-button class="ml-4" id="createAnnouncementButton">
                                    {{ __('Save') }}
                                </x-button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
            </div>

            @else
            <a class="btn btn-primary btn-sm text-center float-right" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal" id="createAnnouncementModalButton">
                <i class="bi bi-plus-circle"></i>
                CREATE NEW ANNOUNCEMENT
            </a>

            <!-- Create announcement Request Modal -->
            <div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-labelledby="createAnnouncementModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="createAnnouncementModalTitle">Create a New Announcement Request</h5>
                            <a class="btn-close" id="closeModalButton" data-bs-dismiss="modal" aria-label="Close"></a>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.announcement.create') }}" method="POST" id="createAnnouncementForm">
                                @csrf

                                <!-- Title -->
                                <div class="mt-4">
                                    <x-label for="title" :value="__('Title')" />

                                    <x-input id="title" class="block mt-1 w-full" type="text" name="title" required />
                                </div>

                                <!-- Content -->
                                <div class="mt-4">
                                    <x-label for="content" :value="__('Content')" />

                                    <!-- <textarea required /> -->
                                    <x-textarea name="content" id="content" required>

                                    </x-textarea>

                                </div>

                                <!-- Event Location -->
                                <div class="mt-4">
                                    <x-label for="event_location" :value="__('Event Location')" />

                                    <x-input id="event_location" class="block mt-1 w-full" type="text" name="event_location" required />
                                </div>

                                <!-- Event Date -->
                                <div class="mt-4">
                                    <x-label for="event_date" :value="__('Event Date')" />

                                    <x-input id="event_date" class="block mt-1 w-full" type="date" name="event_date" required />
                                </div>

                                <!-- Event Time -->
                                <div class="mt-4">
                                    <x-label for="event_time" :value="__('Event Time')" />

                                    <x-input id="event_time" class="block mt-1 w-full" type="time" name="event_time" required />
                                </div>

                                <br>

                                <x-button class="ml-4" id="createAnnouncementButton">
                                    {{ __('Save') }}
                                </x-button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <br>
            <br>
            <!-- <table class="table table-responsive table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Event Location</th>
                        <th scope="col">Event Date</th>
                        <th scope="col">Event Time</th> -->
            <!-- <th scope="col">EDIT</th>
                        <th scope="col">DELETE</th> -->
            <!--
                    </tr>
                </thead>
                <tbody>
                    @foreach ($announcements as $announcement)
                    <tr>
                        <td>{{$announcement->id}}</td>
                        <td>{{$announcement->title}}</td>
                        <td>{{$announcement->content}}</td>
                        <td>{{$announcement->event_location}}</td>
                        <td>{{$announcement->event_date}}</td>
                        <td>{{$announcement->event_time}}</td>


                        <td>
                            <div>
                                <a class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#updateAnnouncementModal" id="updateAnnouncementButton" data-id="{{$announcement->id}}">EDIT</a>
                            </div>

                            @endforeach
                    </tr>
                </tbody>
            </table> -->

            <!-- Pagination -->
            <!-- <div class="row">
                <div class="col offset-md-6">
                    {{$announcements->links()}}
                </div>
            </div> -->

            <!-- Card style -->
            @foreach ($announcements as $announcement)
            <div class="card rounded-5" style="width: 60%; height: 250px; margin: auto; border: 1px solid black;">
                <h5 class="card-header">{{$announcement->title}}</h5>
                <div class="card-body">
                    <h5 class="card-title">{{$announcement->updated_at}}</h5>
                    <hr>
                    <br>
                    <p class="card-text">{{$announcement->content}}</p>
                    <div class="row">
                        <p>{{$announcement->event_location}}</p>
                        <p>{{$announcement->event_date}}</p>
                        <p>{{$announcement->event_time}}</p>
                    </div>

                    <!-- <img src="..." class="rounded-5" alt="..."> -->

                </div>
            </div>
            <br>

            @endforeach

            @endif

        </div>
    </x-slot>
</x-app-layout>

<script>
</script>
