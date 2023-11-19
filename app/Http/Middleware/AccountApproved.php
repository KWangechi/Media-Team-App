<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccountApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        //check if user has been approved
        if(auth()->check()){
            if(auth()->user()->account_status == 'pending'){
                auth()->logout();

                return redirect('login')->with('message', 'Your account needs to be approved by the admin');
            }
        }

        return $next($request);
    }
}
