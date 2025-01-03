<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = \App\Models\User::all()->first();

        return view('admin.dashboard', [
            'user' => $user
        ]);
    }
}
