<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (\Session::has('admin')) {
            return redirect()->route('admin-dashboard')->with('success', 'Welcome back to ' . strtoupper(env('APP_NAME')));
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            $admin = User::where('email', $request->username)
                ->orWhere('username', $request->username)
                ->first();

            if (!$admin) {
                return redirect()->back()->with('error', 'User not found');
            }

            if (!Hash::check($request->password, $admin->password)) {
                return redirect()->back()->with('error', 'Invalid password');
            }

            session(['admin' => $admin]);
            return redirect()->route('admin-dashboard');
        }

        return view('admin.login');
    }

    public function logout()
    {
        \Session::forget('admin');
        Auth::logout();

        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
