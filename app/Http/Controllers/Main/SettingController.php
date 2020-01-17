<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use DB;
use Auth;
use App\User;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
        $this->middleware('verify2fa');
    }

    public function index(){
        $data['page_title'] = "Configuración";
        return view('Main.settings')->with($data);
    }

    public function password(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
      
        $user = User::find(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            DB::beginTransaction();
            try {
                $user->password = Hash::make($request->password);
                $user->save();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
            DB::commit();
        }else{
            return redirect('/settings')->with('error', 'Clave invalida');
        }
        return redirect('/settings')->with('success', 'Cambio de clave exitoso');
    }

    public function btc(Request $request){
        $this->validate($request, [
            'btc' => 'required'
        ]);
      
        $user = User::find(Auth::user()->id);

        DB::beginTransaction();
        try {
            $user->btc = $request->btc;
            $user->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/settings')->with('success', 'Cambio de wallet exitoso');
    }
}
