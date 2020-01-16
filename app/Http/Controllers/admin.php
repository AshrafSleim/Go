<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use Alert;
class admin extends Controller
{
    public function showAdminRegisterForm()
    {
        return view('admin.register');
    }
    protected function createAdmin(Request $request)
    {

        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ])->validate();
        \App\Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back();
    }

    public function showAdminLoginForm()
    {
        return view('admin.login');
    }
    protected function loginAdmin(Request $request)
    {
        Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ])->validate();
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect(route('adminHome'));
        }
        Alert::error('your email or password not correct!');

        return back()->withInput($request->only('email'));
    }


    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        return redirect(route('AdminLogin'));
    }


}
