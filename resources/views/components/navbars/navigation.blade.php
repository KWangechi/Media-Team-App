@props(['titlePage'])

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $titlePage }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">{{ $titlePage }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                    <label class="form-label">Type here...</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <form method="GET" action="{{ route('logout') }}" class="d-none" id="logout-form">
                @csrf
            </form>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                        @if (auth()->user()->profile)
                        <img src="{{ asset('/storage/'.auth()->user()->profile->photo) }}" alt="" class=" rounded-circle shadow-4-strong" width="30px;" height="30px;">
                        @else
                        <i style="font-size: 2.0rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                        @endif

                        {{auth()->user()->name}}

                        <span class="d-sm-inline my-2 d-none px-1" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i size="font-size: 2.2rem;" class="fa fa-sign-out" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>

                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer fa-lg"></i>
                        @if (count(auth()->user()->unreadNotifications) > 0)
                        <span class="badge bg-danger rounded-circle p-1 translate-middle position-absolute start-100">
                            {{ count(auth()->user()->unreadNotifications) }}
                            <span class="visually-hidden">unread messages</span>
                            @endif
                        </span>
                    </a>

                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        @foreach (auth()->user()->unreadNotifications as $notification)
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="{{route('user.announcements')}}">
                                <div class="d-flex py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            @if ($notification->read_at === null)
                                            <span class=font-weight-bold">
                                                {{ $notification->data['subject']}}
                                            </span>
                                            <span class="badge bg-info rounded-pill ml-3"> </span>
                                            <p class="mt-1 mb-0">{{$notification->created_at}}</p>

                                            @else
                                            <p>No New Notifications</p>
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
