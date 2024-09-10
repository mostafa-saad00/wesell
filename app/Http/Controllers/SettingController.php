<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        return view('user.dashboard', compact('user'));
    }

    public function profile()
    {
        $user = Auth::user();

        return view('user.setting.profile', compact('user'));
    }

    public function wallet()
    {
        $user = Auth::user();

        return view('user.setting.wallet', compact('user'));
    }

   
}
