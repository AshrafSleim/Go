<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Alert;
use Validator;

class User extends Controller
{
    private $userModel;
    public function __construct(\App\User $userModel)
    {
        $this->userModel = $userModel;
    }
    public function index(Request $request)
    {
        session()->forget('menu');
        session()->put('menu', 'user');
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $users = $query->orderBy('id', 'desc')->paginate(10);
            $users->setPath(URL::current() . "?" . "filter=1" .
                "&name=" . $request->name .
                "&email=" . $request->email .
                "&mobile=" . $request->mobile
                );
        } else {
            $users = \App\User::query()->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.users', compact('users'));
    }

    public function returnSearchResult($request)
    {
        $name               = $request->name;
        $email              = $request->email;
        $mobile             = $request->mobile;
        $users              = \App\User::query();
        $users->where(function ($query) use ($name, $email, $mobile) {
            if ($name) {
                $query->where('name', 'LIKE', ['%' . $name . '%']);
            }
            if ($email) {
                $query->where('email', 'LIKE', ['%' . $email . '%']);
            }
            if ($mobile) {
                $query->where('phone', 'LIKE', ['%' . $mobile . '%']);
            }
            return $query;
        });

        return $users;
    }


    public function getNewDriver(){
        return view('admin.addNewDriver');
    }

    public function postNewDriver(Request $request){
//        dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required |email|max:255',
            'phone' => 'required |numeric |digits_between:8,15',
            'password' => 'required  | min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            if ($this->userModel->checkEmail($request->email)){
                Alert::error('this email is used !');
                return redirect()->back()->withInput($request->input());
            }else{
                $driver=\App\User::create([
                    'name' =>$request->name,
                    'email' =>$request->email,
                    'phone' =>$request->phone,
                    'password' =>Hash::make($request->password),
                ]);
                Alert::success('Successful Added !');
                return redirect()->back();
            }

        }
    }






    public function delete($id)
    {
        \App\User::findOrFail($id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }

}
