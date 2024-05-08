<?php

namespace App\Http\Middleware;

use App\Models\SecurityObject;
use App\Models\SecurityRole;
use App\Models\UserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()) {
            $user = Auth::user();
            if ($user->user_type->id == 1) {
                return $next($request);
            }
        }

        return redirect('/login')->with('error', "Veuillez vous connecter s'il vous plaît.");
    }
}
