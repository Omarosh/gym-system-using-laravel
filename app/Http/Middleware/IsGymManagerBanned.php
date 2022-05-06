<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GymManger;
use App\Models\User;

class IsGymManagerBanned
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
        // dd('lol');
        if (Auth::check()) {
            $userRole=Auth::user()->roles->pluck('name')[0];

            if ($userRole == 'gym_manager') {
                $gym_manager_Id=Auth::user()->id;
                $logged_gym_manager = GymManger::where('user_id', $gym_manager_Id)->first();
                $isbanned =$logged_gym_manager['status'] ;
   

                if ($isbanned) {
                    return redirect()->route('bannedGymManager');
                } else {
                    return $next($request);
                }
            }
            return $next($request);
        } else {
            return $next($request);
        }
    }
}
