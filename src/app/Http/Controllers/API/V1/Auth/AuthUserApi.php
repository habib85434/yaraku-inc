<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthUserApi extends Controller
{
    public function getUserByToken(Request $request)
    {
         try {
             $user = AccessToken::where('token','=', $request->header('token'))->first();
             $response['user'] = User::find($user->user_id);
             return responseOk($response);
         } catch (\Throwable $throwable) {
             Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                 .$throwable->getLine());
             return responseCantProcess();
         }
    }
}

