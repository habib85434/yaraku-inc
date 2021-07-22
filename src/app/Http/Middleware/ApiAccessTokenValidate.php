<?php

namespace App\Http\Middleware;

use App\Models\AccessToken;
use Closure;
use Illuminate\Http\Request;

class ApiAccessTokenValidate
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
        $token = $request->header('api_key');

        if (empty($token)) {return responseUnauthorized();}

        $key = AccessToken::where('token', '=', $token)->first();

        if (empty($key)) { return responseUnauthorized(); }

        return $next($request);
    }
}
