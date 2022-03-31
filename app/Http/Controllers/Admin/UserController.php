<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Notifications\UserRegistrationApproved;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::paginate(15);
        $roles = Role::all();

        return view('admin.users', compact(['users', 'roles']));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $search_users = User::query()
            ->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orWhere('phone_number', 'LIKE', '%' . $search . '%')
            ->get();

        // dd('This is a search module');
        // dd($search_users->count());
        // if ($search_users->isEmpty()) {
        //     return view('admin.search')->with('error_message', 'No users found');
        // }

        return view('admin.search', compact('search_users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'date_joined' => $request->date_joined,
            'department' => $request->department,
            'password' => Hash::make($request->password),
        ]);

        User::where('id', $user->id)->update([
            'account_status' => 'approved'
        ]);

        if (!$user) {
            return redirect()->route('users.index')->with('error_message', 'Error!! Please try again');
        }

        return redirect()->route('users.index')->with('success_message', 'User successfully created!!');

        // dd($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);

        return view('admin.edit', compact(['user', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->all());

        if (!$user) {
            return redirect()->route('users.update')->with('error_message', 'Error occurred! Please try again');
        }

        return redirect()->route('users.index')->with('success_message', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users.index')->with('success_message', 'User deleted successfully!!');

    }

    public function deleteSelectedUsers(User $user){
        $user = User::findOrFail($user);
        $user->delete();

        return redirect()->route('users.index')->with('success_message', 'User deleted successfully!!');
    }

    public function approve($id)
    {
        User::where('id', $id)->update(['account_status' => 'approved']);

        $user = User::where('id', $id)->get();
        Notification::send($user, new UserRegistrationApproved());

        return redirect()->route('users.index')->with('success_message', 'User account has been approved successfully');
    }

    public function filterResults()
    {
        $collection = collect([1, 2, 3, 4]);

        $filtered = $collection->filter(function ($value, $key) {
            return $value > 2;
        });

        $filtered->all();
    }
}
