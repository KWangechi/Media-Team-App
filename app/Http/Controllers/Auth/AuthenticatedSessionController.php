<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    public $now;
    public $current_time;
    public $day;
    

    public function __construct(){
        $this->now = Carbon::now();
        $this->current_time = $this->now->setTimezone('Africa/Nairobi');
        $this->day = $this->now->dayName;

    }
   
    
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //check if current logged in user is on duty for this Sunday
        // $duty = Duty::where('user_id', auth()->user()->id)->get();
        // dd($duty->assigned);
        return view('auth.login')->with(['current_time' => $this->current_time, 'day' => $this->day]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request, User $user)
    {
        User::where('id', $user->id)->update([
            'login_time'=> $this->current_time
        ]);

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
