<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ThrottleRequests;

class CustomThrottleRequests extends ThrottleRequests
{
    /**
     * Get the throttle options for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getOptions($request)
    {
        return [
            'limit' => 10000, // Nombre de requêtes autorisées par seconde
            'expires' => 10, // Durée d'expiration (en secondes)
        ];
    }
}
