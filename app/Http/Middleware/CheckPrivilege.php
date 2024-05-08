<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class CheckPrivilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            //uniquement pour les utilisateurs backoffice sinon on laisse passer
            if(auth()->user()->user_type->id != 1){
                return $next($request);
            }

            $controller = new Controller();
            $controller_privilleges = $controller->privilleges;
            $user = auth()->user();
            $user_roles = $user->roles;
            $routeName = Route::currentRouteName();
            $route_is_protected = false;
            $protected_privillege = null;
            //check if route is protected
            foreach ($controller_privilleges as $privillege => $allroutes) {
                foreach ($allroutes as $route) {
                    if($route['name'] == $routeName){
                        $route_is_protected = true;
                        foreach ($user_roles as $role) {
                            $privilleges_role = $role->privileges;
                            foreach ($privilleges_role as $pr) {
                                if ($pr['name'] == $privillege and (array_key_exists("function",$route) ? $route["function"]($request) : true)) {
                                    return $next($request);
                                }
                            }
                        }
                        $protected_privillege.='/'.$privillege;
                    }
                }
            }
            if($route_is_protected){
                $response = [
                    'success' => false,
                    'message' => "Vous n'avez pas la permission ($protected_privillege) requise pour effectuer cette action.",
                ];
                return response()->json($response, 201);
            }
            return $next($request);
        }else{
            $response = [
                'success' => false,
                'message' => "You can't use this middleware on unprotected route , place this middleware after auth",
            ];
            return response()->json($response, 201);
        }
    }
}
