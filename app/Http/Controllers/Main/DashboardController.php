<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;

use App\User;
use App\Models\User_transaction;
use App\Models\User_plan;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Dashboard";
        //Minipaneles
        $data['comision'] = User_transaction::join('user_plans', 'user_plans.id', 'user_plan_id')
        ->join('plans', 'plans.id', 'plan_id')
        ->where('reference_id', '=', Auth::user()->id)
        ->where('transaction_id', '=', 4)
        ->sum('amount');
        $data['retirado_comision'] = User_transaction::where('user', '=', Auth::user()->id)
        ->where('transaction_id', '=', 3)
        ->sum('amount');
        $data['comision_actual'] = $data['comision'] - $data['retirado_comision'];
        $data['rentabilidad'] = User_plan::join('plans', 'plans.id', 'plan_id')
        ->where('user_id', '=', Auth::user()->id)
        ->where('end_at', '>=', Carbon::now())
        ->sum('rentability');
        $data['ganado'] = User_transaction::join('user_plans', 'user_plans.id', 'user_plan_id')
        ->join('plans', 'plans.id', 'plan_id')
        ->where('user_id', '=', Auth::user()->id)
        ->whereIn('transaction_id', [2, 5 ])
        ->sum('amount');
        $data['retirado'] = User_transaction::join('user_plans', 'user_plans.id', 'user_plan_id')
        ->join('plans', 'plans.id', 'plan_id')
        ->where('user_id', '=', Auth::user()->id)
        ->where('transaction_id', '=', 1)
        ->sum('amount');
        $data['dinero_actual'] = $data['ganado'] - $data['retirado'];
        $data['invertido'] = User_Plan::where('user_id', '=', Auth::user()->id)->sum('charge');
        $data['planes_activos'] = User_plan::select('user_plans.*', 'plans.name as plan', 'plans.days')
        ->join('plans', 'plans.id', 'plan_id')
        ->where('user_id', '=', Auth::user()->id)
        ->where('status', '=', '1')
        ->get();
        $data['referidos'] = User::selectRaw('users.*, bonus')
            ->join('user_plans', 'user_id', 'users.id')
            ->where('first','=', 1)
            ->where('reference', '=', Auth::user()->id)
            ->get();
        $data['planes'] = User_transaction::selectRaw('user_transaction.*, end_at, charge, status, plans.name')
            ->join('user_plans', 'user_plans.id', 'user_plan_id')
            ->join('plans', 'plans.id', 'plan_id')
            ->where('user_id', '=', Auth::user()->id)
            ->where('plans.special', '=', '0')
            ->get();
        $data['especiales'] = User_transaction::selectRaw('user_transaction.*, end_at, charge, status, plans.name, transaction.name as transactionName')
        ->join('user_plans', 'user_plans.id', 'user_plan_id')
        ->join('plans', 'plans.id', 'plan_id')
        ->join('transaction', 'transaction.id', 'transaction_id')
        ->where('user_id', '=', Auth::user()->id)
        ->where('plans.special', '!=', '0')
        ->where('transaction_id', '=', '5')
        ->get();
        $data['comisiones'] = User_transaction::selectRaw('user_transaction.*, end_at, charge, status, plans.name, transaction.name as transactionName')
        ->join('user_plans', 'user_plans.id', 'user_plan_id')
        ->join('plans', 'plans.id', 'plan_id')
        ->where('reference_id', '=', Auth::user()->id)
        ->join('transaction', 'transaction.id', 'transaction_id')
        ->where('transaction_id', '=', '4')
        ->get();
        return view('Main.home')->with($data);
    }
}
