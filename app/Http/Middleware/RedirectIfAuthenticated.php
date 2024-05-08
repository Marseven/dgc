<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Google2FA;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $authUser = User::find(Auth::user()->id);

                if (Auth::user()->user_type->id == 2 and Auth::user()->provider['status'] == 'blocked') {
                    Google2FA::logout();
                    Auth::logout();
                    return back();
                }

                if (Auth::user() && Session::get('personnalToken') == null) {

                    $personnalToken = $authUser->createToken("an_web", ['*'], now()->addDay())->plainTextToken;
                    Session::put('personnalToken', $personnalToken);

                    if ($authUser->user_type->id == 1) {
                        return redirect(route('dashboard'));
                    } else {
                        return redirect(route('home'));
                    }
                }

                if ($authUser->user_type->id == 1) {
                    return redirect(route('dashboard'));
                } else {
                    return redirect(route('home'));
                }
            }
        }

        return $next($request);
    }
}
