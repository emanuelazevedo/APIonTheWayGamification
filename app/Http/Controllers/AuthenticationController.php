<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Lcobucci\JWT\Parser;
use App\User;

use App\Http\Requests\UserCreateRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{

    public function register (UserCreateRequest $request)
    {
        //

        $data = $request->only(['name', 'email', 'password']);

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . "." . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('uploads/avatar/' . $filename));

            $data['avatar'] = $filename;
        }

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        return Response([
          'status' => 0,
          'data' => $user,
          'msg' => 'ok'
        ], 200);

    }


    public function login (Request $request) {

        $user = User::where('email', $request->email)->first();

        if ($user) {

            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = "Password missmatch";
                return response($response, 422);
            }

        } else {
            $response = 'User does not exist';
            return response($response, 422);
        }

    }


    public function logout (Request $request) {

        $token = $request->user()->token();
        $token->revoke();

        $response = 'You have been succesfully logged out!';
        return response($response, 200);

    }
}
