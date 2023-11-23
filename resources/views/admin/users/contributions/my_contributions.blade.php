<x-app-layout bodyClass="g-sidenav-show  bg-gray-200 dark-version">
    <x-navbars.sidebar activePage="admin-contributions"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <x-navbars.navigation titlePage="My Contributions"></x-navbars.navigation>

        <!-- Toast notifications -->
        @if (session('success_message'))
        <div class="toast-container" style="position: absolute; top: 30px; right: 40px;" data-bs-animation="true" data-bs-delay="3000">
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

        @if ($contributions->isEmpty())
        <div class="text-center mt-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z" />
            </svg>
            <h3 class="mt-5">NO CONTRIBUTIONS YET</h3>
            <p class="mt-4 mx-auto">You have not contributions yet. Click below to add</p>

            <a class="btn bg-gradient-primary mt-3" href="{{ route('admin.users.contributions') }}">
                <i class="material-icons">payments</i>
                View All Contributions
            </a>
        </div>


        @else
        <a class="btn bg-gradient-primary mt-4 mx-4" href="{{ route('admin.users.contributions') }}">
            <i class="material-icons">payments</i>
            View All Contributions
        </a>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card my-2">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                #Ref</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Date Contributed</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Amount Contributed(Kshs.)</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Comments</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contributions as $contribution)
                                        <tr>
                                        <td class="text-center">
                                                <p class="text-sm font-weight-bold mb-0">{{$contribution->id}}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-sm font-weight-bold mb-0">{{$contribution->date_contributed}}</p>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-sm font-weight-bold mb-0">{{$contribution->amount_contributed}}</span>
                                            </td>
                                            <td class="text-wrap text-center">
                                                <span class="text-sm font-weight-bold mb-0">{{$contribution->comment}}</span>
                                            </td>

                                            <td class="align-middle">
                                                <div class="row text-center mx-auto p-0">
                                                    <div class="col-md-6">
                                                        <a href="{{ route('admin.users.contributions.edit', $contribution->id) }}" rel="noopener noreferrer">
                                                            <button class="btn btn-link text-secondary mb-0">
                                                                <i class="material-icons px-1">edit</i>
                                                                Edit
                                                            </button>
                                                        </a>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <form action="{{ route('admin.users.contributions.delete', $contribution->id) }}" method="post">
                                                            @csrf()
                                                            @method('DELETE')

                                                            <button class="btn btn-link text-secondary mb-0 ">
                                                                <i class="material-icons px-1">delete</i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                            </div>
                            </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="mb-3 mt-2">
                    <div class="d-flex pagination justify-content-end pr-3 mb-3">
                        <div class="px-5 text-center">
                            Showing {{count($contributions)}} of {{$contributions->total()}} results
                        </div>
                        {{$contributions->links()}}
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Create Contribution Modal -->
        <div class="modal fade" id="createContributionModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Add a New Contribution</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.users.contributions.create') }}" method="POST" id="createContributionForm">
                                    @csrf

                                    <label class="form-label font-weight-bold">Member name</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <select class="form-select-md form-control" name="user_id" id="user_id">
                                            <option value="" disabled selected>--Select an Option--</option>
                                            @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label class="form-label font-weight-bold">Date Contributed</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="date" class="form-control" name="date_contributed" id="date_contributed">
                                    </div>

                                    <label class="form-label font-weight-bold">Amount Contributed(Kshs. )</label>
                                    <div class="input-group input-group-outline mt-1 mb-3">
                                        <input type="number" class="form-control" name="amount_contributed" id="amount_contributed">
                                    </div>

                                    <label for="about">Comments</label>
                                    <textarea class="form-control border p-3" id="comment" name="comment" rows="3" cols="50"></textarea>
                                    @error('comments')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror

                                    <div class="text-center ">
                                        <button type="submit" class=" btn btn-round btn-md bg-gradient-info w-30 mt-4 mb-0">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>
</x-app-layout>
