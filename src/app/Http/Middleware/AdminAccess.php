<?php

namespace App\Http\Middleware;

use App\Models\AccessToken;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AdminAccess
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

        $user = User::where('id', '=', $key->user_id)->first();


        if (empty($user) || $user->user_type != 'ADMIN') {
            return responseUnauthorized();
        }

        return $next($request);
    }
}
