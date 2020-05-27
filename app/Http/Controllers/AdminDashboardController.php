<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditProfileRequest;

class AdminDashboardController extends Controller
{
    public function viewProfile(Request $request)
    {
        $user = User::with('blogpost')->where('name', $request->name)->get();

        return view('profile', compact('user'));
    }
}
