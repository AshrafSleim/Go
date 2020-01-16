<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthDriver extends Controller
{
    public function login(Request $request)
    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['name'] =  $user->name;
            return response()->json(['status' => 'success', 'data' =>$success],200);
        }
        else{
            return response()->json(['status' => 'error','data' => 'Unauthorised'],200);
        }
    }

    public function getUser(){
        $user = Auth::guard('api')->user();
        return response()->json(['status' => 'success', 'data' =>$user],200);
    }
    public function logOut(Request $request)
    {
        $request->user()->token()->revoke();
        $response = 'you have been successfully logged out !';
        return response()->json(['status' => 'success', 'data' => $response],200);

    }

}
