<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validation = $this->validation($request);
            if ( $validation->fails() ) {
                return validationWithDetailsError($validation->errors());
            }

            $pData = $request->all();
            $eData = User::where('email', '=', $pData['email'])->first();
            if (empty($eData)) {
                return noContent('The user not found');
            }

            $pssMatch = Hash::check( $pData['password'], $eData->password);

            if ($pssMatch) {
                $eData->update(['active' => 1]);
                $this->tokenProcess($eData->id);
            } else {
                return authFail();
            }

            $response = $this->tokenUser($eData->id);

            return authSuccess($response);

        } catch ( \Throwable $throwable ) {
            return serverError($throwable->getMessage());
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '.$throwable->getLine());
        }
    }

    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'                     => 'required|email',
            'password'                  => 'required|max:190|min:8'
        ]);

        return $validator;
    }

    public function tokenProcess($id)
    {
        $iData['user_id'] = $id;
        $iData['validity'] = $id;
        $iData['token'] = generateToken($id);
        $iData['validity'] = date('Y-m-d', strtotime('+1 day'));

        $exData = AccessToken::where('user_id', '=', $id)->first();

        empty($exData) ? AccessToken::create($iData): $exData->update(['token' => $iData['token']]);
    }

    public function tokenUser($id)
    {
        try {
                $data = AccessToken::
                with('user')
                ->where('user_id', '=', $id)->first();

                $rData ['token'] = $data->token;
                $rData ['validity'] = $data->validity;
                $rData ['user'] = $data->user;

                return $rData;

        } catch ( \Throwable $throwable ) {
            return serverError($throwable->getMessage());
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '.$throwable->getLine());
        }
    }

    public function logout(Request $request)
    {
        try {
            $id = $request->post('id');
            $user = User::where('id', '=', $id)->first();

//            if ($user->active == 0) {
//                return alreadyExist('The user is not logged in yet');
//            }
//
//            $user->update(['active' => 0]);

            AccessToken::where('user_id', '=', $id)->delete();

            return responseOk(null,'Logout successfully');
        } catch ( \Throwable $throwable ) {
            return serverError($throwable->getMessage());
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '.$throwable->getLine());
        }
    }
}

