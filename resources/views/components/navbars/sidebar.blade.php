@props(['activePage'])

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-2 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('dashboard') }} ">
            <img src="{{ asset('/storage/images/') }}/PCEA-church-logo-a-2.png" class="navbar-brand-img rounded" alt="main_logo" height="550px;">
            <span class="ms-2 font-weight-bold text-white">Media Team App</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'user-profile' ? 'active bg-gradient-primary' : '' }} " href="{{ route('user.profile', auth()->id()) }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">My Profile</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Navigation</h6>
            </li>

            @if (auth()->user()->role_id == 1)
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-primary' : '' }} " href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'users' ? ' active bg-gradient-primary' : '' }}  " href="{{ route('admin.users.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">group</i>
                    </div>
                    <span class="nav-link-text ms-1">Team Members</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'admin-duty-roster' ? ' active bg-gradient-primary' : '' }}  " href="{{ route('admin.duty.index', auth()->user()->id) }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">event_note</i>
                    </div>
                    <span class="nav-link-text ms-1">Duty Roster</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'admin-sunday-report' ? ' active bg-gradient-primary' : '' }}  " href="{{ route('user.sunday-report.index', auth()->user()->id) }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">description</i>
                    </div>
                    <span class="nav-link-text ms-1">Sunday Reports</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'leaves' ? ' active bg-gradient-warning' : '' }}  " href="{{ route('admin.leaves.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">flight</i>
                    </div>
                    <span class="nav-link-text ms-1">Leaves</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'contributions' ? ' active bg-gradient-warning' : '' }}  " href="{{ route('user.leaves.index', auth()->user()->id) }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">payments</i>
                    </div>
                    <span class="nav-link-text ms-1">Contributions</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'notifications' ? ' active bg-gradient-warning' : '' }}  " href="{{ route('admin.announcements') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">notifications</i>
                    </div>
                    <span class="nav-link-text ms-1">Notifications</span>
                    <span class="badge rounded-pill badge-notification bg-danger">
                        {{count(auth()->user()->unreadNotifications)}}
                    </span>
                </a>
            </li>

            @else
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'duty-roster' ? ' active bg-gradient-warning' : '' }}  " href="{{ route('user.duty.index', auth()->id()) }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">event_note</i>
                    </div>
                    <span class="nav-link-text ms-1">Duty Roster</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'sunday-report' ? ' active bg-gradient-warning' : '' }}  " href="{{ route('user.sunday-report.index', auth()->user()->id) }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">description</i>
                    </div>
                    <span class="nav-link-text ms-1">Sunday Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'leaves' ? ' active bg-gradient-warning' : '' }}  " href="{{ route('user.leaves.index', auth()->user()->id) }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">flight</i>
                    </div>
                    <span class="nav-link-text ms-1">Leaves</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'notifications' ? ' active bg-gradient-warning' : '' }}  " href="{{ route('user.announcements') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">notifications</i>
                    </div>
                    <span class="nav-link-text ms-1">Notifications</span>
                    @if (count(auth()->user()->unreadNotifications) > 0)
                    <span class="badge rounded-pill badge-notification bg-danger mx-lg">
                        {{ count(auth()->user()->unreadNotifications) }}
                    </span>    
                    @endif
                </a>
            </li>
            @endif

        </ul>
    </div>
</aside>