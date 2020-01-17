<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

use App\User;
use App\Models\Plan;
use App\Models\User_transaction;
use App\Models\User_plan;
use App\Models\Config;

class InvestController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    /**
     * Muestra los Planes.
     *
     * @return \Illuminate\Http\Response
     */
    public function plans()
    {
        $data['plans'] = Plan::where('special', '=', '0')->get();
        $special = Plan::where('special', '=', '1')
            ->where('total_plans', '>', 'used_plans')
            ->where('activado', '=', 1);
        $data['specials'] = $special->get();
        $data['total_special'] = $special->sum('total_plans') - $special->sum('used_plans');
        $data['page_title'] = "Planes de Inversion";
        return view('Main.invest.plans')->with($data);
    }

    public function payment(){
        $data['page_title'] = "Depositos/Retiros";
        $data['config'] = Config::find(1);
        return view('Main.invest.payment')->with($data);
    }

    public function history()
    {
        $data['page_title'] = "Historial";
        $data['planes'] = User_plan::select('user_plans.*', 'plans.name as plan')
        ->join('plans', 'plans.id', 'plan_id')
        ->where('user_id', '=', Auth::user()->id)
        ->get();
        $data['referidos'] = User::selectRaw('users.*, bonus')
            ->join('user_plans', 'user_id', 'users.id')
            ->where('first','=', 1)
            ->where('reference', '=', Auth::user()->id)
            ->get();
        return view('Main.invest.history')->with($data);
    }

    public function history_detail(Request $request, $id){
        $data['plan'] = User_plan::select('user_plans.*', 'plans.name as plan')
            ->join('plans', 'plans.id', 'plan_id')
            ->where('user_plans.id', '=', $id)
            ->first();
        $data['page_title'] = "Historial de " . $data['plan']->plan;
        $data['transacciones'] = User_transaction::selectRaw('user_transaction.*, end_at, charge, status')
            ->join('user_plans', 'user_plans.id', 'user_plan_id')
            ->where('user_plan_id', '=', $id)
            ->get();
        return view('Main.invest.history_detail')->with($data);
    }

}
