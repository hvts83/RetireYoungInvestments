<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TwoFactorController extends Controller
{
    public function verifyTwoFactor(Request $request)
    {
        $request->validate([
            '2fa' => 'required',
        ]);

        if($request->input('2fa') == Auth::user()->token_2fa){            
            $user = Auth::user();
            $user->token_2fa_expiry = \Carbon\Carbon::now()->addMinutes(config('session.lifetime'));
            $user->save();       
            return redirect($request->input('uri'));
        } else {
            return redirect('/2fa')->with('message', 'Incorrect code.');
        }
    }

    public function showTwoFactorForm($uri)
    {
        $data['page_title'] = "Verificación de acceso";
        $data['uri'] = $uri;
        return view('Main.two_factor')->with($data);
    }  
}
