<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
class AuthPassenger extends Controller
{

    private $userModel;
    public function __construct(Passenger $userModel)
    {
        $this->userModel = $userModel;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                => 'required',
            'email'               => 'required|email|string|max:255',
            'password'            => 'required|min:6',
            'c_password'          => 'required|same:password|min:6',
            'phone'              => 'required|numeric|digits_between:8,15',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error','data' => $validator->errors()],200);
        }

        $input             = $request->all();
        $input['password'] = bcrypt($input['password']);
        if ($this->userModel->checkEmail($input['email'])) {
            return response()->json(['status' => 'error','data' => 'This email already registered.You can login.'],200);
        }else{
            $user = Passenger::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'password' => $input['password'],
            ]);

            return response()->json(['status' => 'success', 'data' =>'success register'],200);
        }

    }

    public function login(Request $request)
    {
       \Config::set('auth.guards', ['passenger' => [
            'driver' => 'session',
            'provider' => 'passengers',
           'hash' => false,

       ]]);
        if(Auth::guard('passenger')->attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::guard('passenger')->user();
            $success['token'] =  $user->createToken('passenger')-> accessToken;
            $success['name'] =  $user->name;
            return response()->json(['status' => 'success', 'data' =>$success],200);
        }
        else{
            return response()->json(['status' => 'error','data' => 'Unauthorised'],200);
        }
    }

    public function getUser(){
        $user = Auth::guard('passenger')->user();
        return response()->json(['status' => 'success', 'data' =>$user],200);
    }

    public function logOut(Request $request)
    {
        $request->user()->token()->revoke();
        $response = 'you have been successfully logged out !';
        return response()->json(['status' => 'success', 'data' => $response],200);

    }
}
