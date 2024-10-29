<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            if (!$admin =  User::where('email',$request->username)->orWhere('username',$request->username) ->first())
                return  redirect()->back()->with(['error' => 'user not found']);

            if (!Hash::check($request->password,$admin->password))
                return  redirect()->back()->with(['error' => 'invalid password']);

            session(['admin' => $admin]);
            return redirect()->route('admin-dashboard');
        }

        return view('admin.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
