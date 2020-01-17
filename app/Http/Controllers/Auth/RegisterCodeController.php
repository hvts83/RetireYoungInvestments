<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\User;

class RegisterCodeController extends Controller
{
    public function registerCode($code){
        $data['user'] = User::where('code', '=', $code)->first();
        return view('auth/register')->with($data);
    }
}