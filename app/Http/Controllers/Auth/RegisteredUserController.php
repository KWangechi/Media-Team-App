<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Notifications\ConfirmRegistration;
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
            'title' => 'Welcome to the Media Team Application!!!',
            'body' => 'Registration of your details was successful.',
            'action' => 'Change Password',
            'url' => 'http://127.0.0.1:8000/reset-password/{token}'
        ];

        Notification::send($user, new ConfirmRegistration($message));
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);

        
    }
}