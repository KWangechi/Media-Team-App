<!-- If user is already logged in, just redirect to their pages, if not, redirect to login page -->

<x-app-layout bodyClass="g-sidenav-show bg-gray-200">
    <div class="page-header justify-content-center min-vh-100"
        style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <h1 class="text-light text-center">Welcome to Media Team App. Please Sign Up</h1>
        </div>
    </div>
        <x-footers.guest></x-footers.guest>
</x-app-layout>

