<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\User;
use App\Models\User_transaction;

class ReferalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    /**
     * Muestra los referidos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Referidos";
        $data['referidos'] = User::selectRaw('users.*, plans.name as "plan", bonus')
            ->join('user_plans', 'user_id', 'users.id')
            ->join('plans', 'plans.id', 'plan_id')
            ->where('first','=', 1)
            ->where('reference', '=', Auth::user()->id)
            ->get();
        $comision = User_transaction::join('user_plans', 'user_plans.id', 'user_plan_id')
        ->join('plans', 'plans.id', 'plan_id')
        ->where('reference_id', '=', Auth::user()->id)
        ->where('transaction_id', '=', 4)
        ->sum('amount');
        $retirado_comision = User_transaction::where('user', '=', Auth::user()->id)
        ->where('transaction_id', '=', 3)
        ->sum('amount');
        $data['comision'] = $comision - $retirado_comision;
        return view('Main.referal.index')->with($data);
    }

    public function tools(){
        $data['page_title'] = "Herramientas";
        $data['code'] = Auth::user()->code;
        return view('Main.referal.tools')->with($data);
    }
}
