<x-app-layout>
    <x-slot name="slot">
        <div class="container">
            <br>
            <!-- Display error or success message -->
            @if ($search_contributions->isNotEmpty())
            <div class="alert alert-success alert-dismissible fade show text-center">
                Found {{ $search_contributions->count() }} result(s) !!!
                <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>

            @else
            <div class="alert alert-danger alert-dismissible fade show">
               No such record found!!!!
                <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>
            @endif
            <br>

            <!-- search bar -->
            <form action="{{ route('admin.users.contributions.search') }}" method="get">

                <div>
                    <i class="bi bi-filter"></i>
                    <x-input id="filter" type="text" name="filter" placeholder="Filter" />


                </div>
                <div class="row float-right">
                    <div class="col">
                        <x-input id="search" type="text" name="search" placeholder="Search" />
                    </div>
                    <div class="col">
                        <button class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Table -->
            <br>
            <br>
            <table class="table table-responsive table-bordered text-center table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Amount Contributed(Kshs.)</th>
                        <th scope="col">Date Contributed</th>
                        <th scope="col">Comment</th>
                        <th scope="col-group">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($search_contributions as $contribution)
                    <tr>
                        <td>{{$contribution->id}}</td>
                        <td>{{$contribution->user_id}}</td>
                        <td>{{$contribution->amount_contributed}}</td>
                        <td>{{$contribution->date_contributed}}</td>
                        <td>{{$contribution->comment}}</td>
                        <td>
                            <div class="row row-cols-auto">
                                <div class="col-sm">
                                    <button class="btn btn-secondary btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <div class="col-sm">
                                    <form action="{{ route('admin.users.contributions.edit', $contribution->id) }}" method="GET">

                                        <button class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="col-sm">
                                    <form action="{{route('admin.users.contributions.delete', $contribution->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
        </div>

        @endforeach
        </tbody>
        </table>

        <!-- Pagination -->
        <div class="row">
            <div class="col offset-md-6">
                {{$search_contributions->links()}}
            </div>
        </div>
        </div>
    </x-slot>
</x-app-layout>

<script>
</script>
