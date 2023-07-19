<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('storage/images/PCEA-church-logo-a-2.png') }}" class="card-img-top" alt="PCEA LOGO" style="width: 40px; height: 65px;">

                    </a>
                </div>

                <!-- Navigation Links -->
                <!-- if the user is an admin -->
                @if(auth()->user()->role_id == 1)
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index') || request()->routeIs('admin.users.edit', Auth::user()->id) || request()->routeIs('admin.users.search', Auth::user()->id) ">
                        {{ __('Users') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.leaves.index', auth()->user()->id)" :active="request()->routeIs('admin.leaves.index')">
                        {{ __('Leaves') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.duty.index', auth()->user()->id)" :active="request()->routeIs('admin.duty.index') || request()->routeIs('admin.duty.edit')">
                        {{ __('Duty Roster') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.users.contributions', auth()->user()->id)" :active="request()->routeIs('admin.users.contributions') || request()->routeIs('admin.users.contributions.search') || request()->routeIs('admin.users.contributions.edit')">
                        {{ __('Contributions') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.users.sunday-reports.index')" :active="request()->routeIs('admin.users.sunday-reports.index')">
                        {{ __('Sunday Reports') }}
                    </x-nav-link>

                </div>
                @else
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('user.sunday-report.index', auth()->user()->id)" :active="request()->routeIs('user.sunday-report.index')">
                        {{ __('Sunday Report') }}
                    </x-nav-link>

                    <x-nav-link :href="route('user.profile', auth()->user()->id)" :active="request()->routeIs('user.profile')">
                        {{ __('Profile') }}
                    </x-nav-link>
                    <x-nav-link :href="route('user.leaves.index', auth()->user()->id)" :active="request()->routeIs('user.leaves.index')">
                        {{ __('Leaves') }}
                    </x-nav-link>

                    <x-nav-link :href="route('user.duty.index', auth()->user()->id)" :active="request()->routeIs('user.duty.index')">
                        {{ __('Duty Roster') }}
                    </x-nav-link>
                </div>
                @endif

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('user.profile', auth()->user()->id)">
                            <i class="bi bi-person"></i>
                            {{ __('My Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('admin.announcements')">
                            <i class="bi bi-bell"></i>
                            {{ __('Announcements') }}

                            @if ((2==3) )
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-1-circle-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383h1.312Z" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-5-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-8.006 4.158c1.74 0 2.924-1.119 2.924-2.806 0-1.641-1.178-2.584-2.56-2.584-.897 0-1.442.421-1.612.68h-.064l.193-2.344h3.621V4.002H5.791L5.445 8.63h1.149c.193-.358.668-.809 1.435-.809.85 0 1.582.604 1.582 1.57 0 1.085-.779 1.682-1.57 1.682-.697 0-1.389-.31-1.53-1.031H5.276c.065 1.213 1.149 2.115 2.72 2.115Z" />
                            </svg>
                            @endif

                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="bi bi-power"></i>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                        <!-- <x-dropdown-link :href="route('user.profile', auth()->user()->id)">
                            {{ __('My Leaves') }}
                        </x-dropdown-link> -->
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                {{ __('Users') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
