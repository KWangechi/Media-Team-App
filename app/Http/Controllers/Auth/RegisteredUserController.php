<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Notifications\ConfirmRegistration;
use App\Notifications\RegistrationApproval;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::where('id', '!=', User::ROLE_ADMIN)->get();
        
        return view('auth.register', compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => 'required',
            'date_joined' => 'required',
            'department' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'role_id'=> $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'date_joined' => $request->date_joined,
            'department' => $request->department,
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user));

        $message = [
            'title' => 'New User Registration',
            'body' => 'A new user has registered',
            'action' => 'Login to approve their account',
        ];

        $admin = User::where('role_id', User::ROLE_ADMIN)->get();

        // Notification::send($user, new ConfirmRegistration($message));
        Auth::login($user);

        //send message to admin for account approval
        Notification::send($admin, new RegistrationApproval($user, $message));


        return redirect('login');

    }
}