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

            $postData = $request->all();
            $existUser = User::where('email', '=', $postData['email'])->first();
            if (empty($existUser)) {
                return noContent('The user not found');
            }

            $pssMatch = Hash::check( $postData['password'], $existUser->password);

            if ($pssMatch) {
                $existUser->update(['active' => 1]);
                $this->tokenProcess($existUser->id);
            } else {
                return authFail();
            }

            $response = $this->tokenUser($existUser->id);

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
        $iData['token'] = generateToken($id);
        $iData['validity'] = date('Y-m-d H:i:s', strtotime('+1 day'));

        $exData = AccessToken::where('user_id', '=', $id)->first();

        empty($exData) ? AccessToken::create($iData): $exData->update([
            'token' => $iData['token'],
            'validity' => $iData['validity']]);
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
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '.
                $throwable->getLine());
        }
    }

    public function logout(Request $request)
    {
        try {
            $id = $request->post('id');
            $user = User::where('id', '=', $id)->first();

            AccessToken::where('user_id', '=', $id)->delete();

            return responseOk(null,'Logout successfully');
        } catch ( \Throwable $throwable ) {
            return serverError($throwable->getMessage());
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '.$throwable->getLine());
        }
    }
}

