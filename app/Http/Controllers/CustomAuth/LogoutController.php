<?php

namespace App\Http\Controllers\CustomAuth;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    protected function logout()
    {

        session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
